<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Product;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Генерация sitemap.xml для всех языков';

    public function handle()
    {
        $this->info('Начинаем генерацию sitemap...');

        $baseUrl = rtrim(config('app.url'), '/');
        $sitemap = Sitemap::create();
        $locales = ['ru', 'ro', 'en'];

        // 1. Главная
        foreach ($locales as $locale) {
            $sitemap->add(
                Url::create("{$baseUrl}/{$locale}")
                    ->setPriority(1.0)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            );
        }

        // 2. Статические страницы
        $staticPages = ['about', 'contact', 'privacy'];
        foreach ($staticPages as $page) {
            foreach ($locales as $locale) {
                $sitemap->add(
                    Url::create("{$baseUrl}/{$locale}/{$page}")
                        ->setPriority(0.8)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                );
            }
        }

        // 3. Товары
        $products = Product::with(['translations', 'images'])
            ->where('is_active', true)
            ->get();

        $this->info("Найдено товаров в БД: " . $products->count());

        $productCount = 0;
        $productWithImagesCount = 0;

        foreach ($products as $product) {
            $mainImage = $product->images()
                ->where('is_main', true)
                ->first()
                ?? $product->images()->orderBy('sort_order')->first();

            foreach ($locales as $locale) {
                $translation = $product->translations->where('language', $locale)->first();

                if ($translation && $translation->slug) {
                    $url = Url::create("{$baseUrl}/{$locale}/product/{$translation->slug}")
                        ->setPriority(0.6)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setLastModificationDate($product->updated_at);

                    if ($mainImage && $mainImage->path) {
                        $imageUrl = "{$baseUrl}/storage/{$mainImage->path}";
                        $url->addImage($imageUrl, $translation->name);
                        $productWithImagesCount++;
                    }

                    $sitemap->add($url);
                    $productCount++;
                }
            }
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info("🎉 Sitemap успешно создан: public/sitemap.xml");
        $this->info("Всего URL в sitemap: " . count($sitemap->getTags()));
        $this->info("✓ Товары добавлены: {$productCount}");
        $this->info("✓ Из них с реальными фото: {$productWithImagesCount}");

        return Command::SUCCESS;
    }
}
