<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\BrandTranslation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandService
{
    public function listWithTranslations()
    {
        return Brand::with(['translations', 'translation'])->orderBy('sort_order')->get();
    }

    public function create(array $data): Brand
    {
        return DB::transaction(function () use ($data) {
            $logo = $this->storeLogo($data['logo'] ?? null);

            $brand = Brand::create([
                'logo'       => $logo,
                'is_active'  => $data['is_active'] ?? true,
                'sort_order' => $data['sort_order'] ?? 0,
            ]);

            $this->upsertTranslations($brand, $data['translations']);

            return $brand->load(['translations', 'translation']);
        });
    }

    public function update(Brand $brand, array $data): Brand
    {
        return DB::transaction(function () use ($brand, $data) {
            if (!empty($data['logo'])) {
                $this->deleteOldLogo($brand->logo);
                $brand->logo = $this->storeLogo($data['logo']);
            }

            $brand->is_active  = $data['is_active'] ?? $brand->is_active;
            $brand->sort_order = $data['sort_order'] ?? $brand->sort_order;
            $brand->save();

            $this->upsertTranslations($brand, $data['translations']);

            return $brand->load(['translations', 'translation']);
        });
    }

    public function delete(Brand $brand): void
    {
        DB::transaction(function () use ($brand) {
            $this->deleteOldLogo($brand->logo);
            $brand->delete();
        });
    }

    private function storeLogo(?UploadedFile $file): ?string
    {
        return $file ? $file->store('brands', 'public') : null;
    }

    private function deleteOldLogo(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function upsertTranslations(Brand $brand, array $translations): void
    {
        foreach (['ru','ro','en'] as $lang) {
            $name = data_get($translations, "$lang.name", '');
            $slug = data_get($translations, "$lang.slug");
            if (!$slug && $name) {
                $slug = Str::slug($name);
            }

            BrandTranslation::updateOrCreate(
                ['brand_id' => $brand->id, 'language' => $lang],
                ['name' => $name, 'slug' => $slug]
            );
        }
    }
}
