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

        $sitemap = Sitemap::create();
        $locales = ['ru', 'ro', 'en'];

        // 1. Главная страница
        foreach ($locales as $locale) {
            $sitemap->add(
                Url::create("/{$locale}")
                    ->setPriority(1.0)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setLastModificationDate(now())
            );
        }
        $this->info('✓ Главная страница добавлена');

        // 2. Статические страницы
        $staticPages = ['about', 'contact'];

        foreach ($staticPages as $page) {
            foreach ($locales as $locale) {
                $sitemap->add(
                    Url::create("/{$locale}/{$page}")
                        ->setPriority(0.8)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                );
            }
        }
        $this->info('✓ Статические страницы добавлены');

        // 3. Товары с картинками
        $products = Product::with(['translations', 'images'])
            ->where('is_active', true)
            ->get();

        $this->info("Найдено товаров в БД: " . $products->count());

        $productCount = 0;
        $productWithImagesCount = 0; // 🔥 Счётчик товаров с реальными фото

        foreach ($products as $product) {
            foreach ($locales as $locale) {
                $translation = $product->translations
                    ->where('language', $locale)
                    ->first();

                if ($translation && $translation->slug) {
                    // Создаём URL товара
                    $url = Url::create("/{$locale}/product/{$translation->slug}")
                        ->setPriority(0.6)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setLastModificationDate($product->updated_at);

                    // 🔥 ФИЛЬТРУЕМ: добавляем только реальные картинки
                    // Проверяем есть ли у товара загруженное фото (не дефолтное)
                    $mainImage = $product->images()
                        ->where('is_main', true)
                        ->first()
                        ?? $product->images()->orderBy('sort_order')->first();

                    // Если есть реальная картинка - добавляем её
                    if ($mainImage && $mainImage->path) {
                        $imageUrl = asset('storage/' . $mainImage->path);
                        $url->addImage($imageUrl, $translation->name);
                        $productWithImagesCount++;
                    }
                    // Если картинки нет - просто не добавляем блок <image:image>

                    $sitemap->add($url);
                    $productCount++;
                }
            }
        }

        $this->info("✓ Товары добавлены: {$productCount}");
        $this->info("✓ Из них с реальными фото: {$productWithImagesCount}");

        // 4. Сохраняем в файл
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('🎉 Sitemap успешно создан: public/sitemap.xml');
        $this->info("Всего URL в sitemap: " . count($sitemap->getTags()));

        return Command::SUCCESS;
    }
}
