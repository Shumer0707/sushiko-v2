<?php

namespace App\Services;

use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryService
{
    public function listWithTranslations()
    {
        return Category::with(['translations', 'translation'])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    }

    public function create(array $data): Category
    {
        return DB::transaction(function () use ($data) {
            $imagePath = $this->storeImage($data['image'] ?? null);

            $category = Category::create([
                'parent_id' => $data['parent_id'] ?? null,
                'image'     => $imagePath,
                'sort_order' => $data['sort_order'] ?? 0,
            ]);

            $this->upsertTranslations($category, $data['translations']);
            $this->clearNavigationCache();

            return $category->load(['translations', 'translation']);
        });
    }

    public function update(Category $category, array $data): Category
    {
        return DB::transaction(function () use ($category, $data) {
            if (!empty($data['image'])) {
                $this->deleteOldImage($category->image);
                $category->image = $this->storeImage($data['image']);
            }

            $category->parent_id = $data['parent_id'] ?? null;
            $category->sort_order = $data['sort_order'] ?? 0;
            $category->save();

            $this->upsertTranslations($category, $data['translations']);
            $this->clearNavigationCache();

            return $category->load(['translations', 'translation']);
        });
    }

    public function delete(Category $category): void
    {
        DB::transaction(function () use ($category) {
            $this->deleteOldImage($category->image);
            $category->delete();
            $this->clearNavigationCache();
        });
    }

    private function storeImage(?UploadedFile $file): ?string
    {
        return $file ? $file->store('categories', 'public') : null;
    }

    private function deleteOldImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function clearNavigationCache(): void
    {
        foreach (['ru', 'ro', 'en'] as $locale) {
            Cache::forget("navigation_categories_{$locale}");
        }
    }


    private function upsertTranslations(Category $category, array $translations): void
    {
        foreach (['ru', 'ro', 'en'] as $lang) {
            $name = data_get($translations, "$lang.name", '');
            $slug = data_get($translations, "$lang.slug");
            if (!$slug && $name) {
                $slug = Str::slug($name);
            }

            CategoryTranslation::updateOrCreate(
                ['category_id' => $category->id, 'language' => $lang],
                ['name' => $name, 'slug' => $slug]
            );
        }
    }
}
