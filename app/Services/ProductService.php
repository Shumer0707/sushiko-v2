<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\ProductTranslation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    protected string $categoryFilterSessionKey = 'admin.products.category_id';

    /**
     * Формируем и сохраняем/читаем фильтры (через Request + Session)
     */
    public function resolveFilters(Request $request): array
    {
        $sessionKey = $this->categoryFilterSessionKey;
        $categoryId = null;

        if ($request->has('category_id')) {
            // пользователь меняет фильтр
            $raw = $request->input('category_id');

            if ($raw === '' || $raw === null) {
                // выбор "Все" → очищаем фильтр
                $request->session()->forget($sessionKey);
                $categoryId = null;
            } else {
                $categoryId = (int) $raw ?: null;
                $request->session()->put($sessionKey, $categoryId);
            }
        } else {
            // просто зашли на страницу → берём последнее значение из сессии
            $categoryId = $request->session()->get($sessionKey);
        }

        return [
            'category_id' => $categoryId,
        ];
    }

    /**
     * Список товаров с учётом фильтров
     */
    public function list(array $filters = [])
    {
        return Product::with([
            'translation',
            'images' => fn($q) => $q->orderByDesc('is_main')->orderBy('sort_order'),
            'attributeValues.attribute.translations',
        ])
            ->when(
                !empty($filters['category_id']),
                fn($q) => $q->where('category_id', $filters['category_id'])
            )
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Категории для селекта фильтра
     */
    public function getFilterCategories()
    {
        return Category::with('translation')
            ->orderBy('sort_order')
            ->get(['id']);
    }

    public function create(array $data): Product
    {
        return DB::transaction(function () use ($data) {
            $product = Product::create([
                'brand_id'   => $data['brand_id'] ?? null,
                'category_id' => $data['category_id'] ?? null,
                'sku'        => $data['sku'],
                'price'      => $data['price'] ?? 0,
                'currency'   => $data['currency'] ?? 'MDL',
                'is_active'  => $data['is_active'] ?? true,
                'sort_order' => $data['sort_order'] ?? 0,
            ]);

            $this->upsertTranslations($product, $data['translations'] ?? []);

            // атрибуты
            $this->syncAttributes($product, $data['attributes'] ?? []);

            // картинки (массив файлов) + основной
            $created = $this->storeImages($product, $data['images'] ?? []);
            $this->markMainImage($product, $data['main_image_id'] ?? null, $created);

            return $product->load([
                'translations',
                'translation',
                'images',
                'attributeValues.attribute.translations'
            ]);
        });
    }

    public function update(Product $product, array $data): Product
    {
        return DB::transaction(function () use ($product, $data) {
            $product->fill([
                'brand_id'   => $data['brand_id'] ?? $product->brand_id,
                'category_id' => $data['category_id'] ?? $product->category_id,
                'sku'        => $data['sku'] ?? $product->sku,
                'price'      => $data['price'] ?? $product->price,
                'currency'   => $data['currency'] ?? $product->currency,
                'is_active'  => $data['is_active'] ?? $product->is_active,
                'sort_order' => $data['sort_order'] ?? $product->sort_order,
            ])->save();

            if (!empty($data['translations'])) {
                $this->upsertTranslations($product, $data['translations']);
            }

            // атрибуты
            $this->syncAttributes($product, $data['attributes'] ?? []);

            // новая порция картинок
            $created = $this->storeImages($product, $data['images'] ?? []);
            // удаление картинок по id
            if (!empty($data['delete_image_ids']) && is_array($data['delete_image_ids'])) {
                $this->deleteImagesByIds($product, $data['delete_image_ids']);
            }
            // назначение главной
            $this->markMainImage($product, $data['main_image_id'] ?? null, $created);

            // пересортировка (опционально массив вида [image_id => sort_order])
            if (!empty($data['images_sort']) && is_array($data['images_sort'])) {
                $this->reorderImages($product, $data['images_sort']);
            }

            return $product->load([
                'translations',
                'translation',
                'images',
                'attributeValues.attribute.translations'
            ]);
        });
    }

    public function delete(Product $product): void
    {
        DB::transaction(function () use ($product) {
            foreach ($product->images as $img) {
                $this->deleteFile($img->path);
            }
            $product->delete();
        });
    }

    /* ----------------- helpers ----------------- */

    private function upsertTranslations(Product $product, array $translations): void
    {
        foreach (['ru', 'ro', 'en'] as $lang) {
            $name  = data_get($translations, "$lang.name", '');
            $slug  = data_get($translations, "$lang.slug");
            $short = data_get($translations, "$lang.short_description");
            $full  = data_get($translations, "$lang.full_description");

            if (!$slug && $name) {
                $slug = Str::slug($name);
            }

            ProductTranslation::updateOrCreate(
                ['product_id' => $product->id, 'language' => $lang],
                [
                    'name' => $name,
                    'slug' => $slug,
                    'short_description' => $short,
                    'full_description'  => $full,
                ]
            );
        }
    }

    private function syncAttributes(Product $product, array $attributes): void
    {
        // $attributes: [ attribute_id => [value_id1, value_id2], ... ]
        $pivotData = [];
        foreach ($attributes as $attributeId => $valueIds) {
            foreach ((array)$valueIds as $valueId) {
                $pivotData[$valueId] = ['attribute_id' => $attributeId];
            }
        }
        $product->attributeValues()->sync($pivotData);
    }

    private function storeImages(Product $product, array $files): array
    {
        $created = [];
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $path = $file->store('products', 'public');
                $created[] = $product->images()->create([
                    'path'       => $path,
                    'is_main'    => false,
                    'sort_order' => $product->images()->max('sort_order') + 1,
                ]);
            }
        }
        return $created;
    }

    private function deleteImagesByIds(Product $product, array $ids): void
    {
        $images = $product->images()->whereIn('id', $ids)->get();
        foreach ($images as $img) {
            $this->deleteFile($img->path);
            $img->delete();
        }
    }

    private function reorderImages(Product $product, array $map): void
    {
        foreach ($map as $id => $order) {
            $product->images()->whereKey($id)->update(['sort_order' => (int)$order]);
        }
    }

    private function markMainImage(Product $product, $mainImageId = null, array $created = []): void
    {
        if (!$mainImageId && !empty($created)) {
            $mainImageId = $created[0]->id ?? null;
        }
        if (!$mainImageId) return;

        $product->images()->update(['is_main' => false]);
        $product->images()->whereKey($mainImageId)->update(['is_main' => true]);
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
