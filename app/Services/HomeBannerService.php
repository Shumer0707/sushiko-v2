<?php

namespace App\Services;

use App\Models\HomeBanner;
use App\Models\HomeBannerTranslation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeBannerService
{
    public function listWithTranslations()
    {
        return HomeBanner::with(['translations', 'translation'])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    }

    public function create(array $data): HomeBanner
    {
        return DB::transaction(function () use ($data) {
            $banner = HomeBanner::create([
                'is_active' => $data['is_active'] ?? true,
                'sort_order' => $data['sort_order'] ?? 0,
                'link' => $data['link'] ?? null,
                'open_in_new_tab' => $data['open_in_new_tab'] ?? false,
            ]);

            $this->upsertTranslations($banner, $data['translations']);

            return $banner->load(['translations', 'translation']);
        });
    }

    public function update(HomeBanner $banner, array $data): HomeBanner
    {
        return DB::transaction(function () use ($banner, $data) {
            $banner->update([
                'is_active' => $data['is_active'] ?? $banner->is_active,
                'sort_order' => $data['sort_order'] ?? $banner->sort_order,
                'link' => $data['link'] ?? null,
                'open_in_new_tab' => $data['open_in_new_tab'] ?? false,
            ]);

            $this->upsertTranslations($banner, $data['translations']);

            return $banner->load(['translations', 'translation']);
        });
    }

    public function delete(HomeBanner $banner): void
    {
        DB::transaction(function () use ($banner) {
            foreach ($banner->translations as $translation) {
                $this->deleteImage($translation->image_desktop);
                $this->deleteImage($translation->image_mobile);
            }

            $banner->delete();
        });
    }

    private function upsertTranslations(HomeBanner $banner, array $translations): void
    {
        foreach (['ru', 'ro', 'en'] as $lang) {
            $current = $banner->translations->firstWhere('language', $lang)
                ?? HomeBannerTranslation::where('home_banner_id', $banner->id)->where('language', $lang)->first();

            $desktopPath = $current?->image_desktop;
            $mobilePath = $current?->image_mobile;

            $newDesktop = data_get($translations, "{$lang}.image_desktop");
            $newMobile = data_get($translations, "{$lang}.image_mobile");

            if ($newDesktop instanceof UploadedFile) {
                $this->deleteImage($desktopPath);
                $desktopPath = $newDesktop->store('home-banners', 'public');
            }

            if ($newMobile instanceof UploadedFile) {
                $this->deleteImage($mobilePath);
                $mobilePath = $newMobile->store('home-banners', 'public');
            }

            HomeBannerTranslation::updateOrCreate(
                ['home_banner_id' => $banner->id, 'language' => $lang],
                [
                    'title' => data_get($translations, "{$lang}.title"),
                    'description' => data_get($translations, "{$lang}.description"),
                    'button_text' => data_get($translations, "{$lang}.button_text"),
                    'image_desktop' => $desktopPath,
                    'image_mobile' => $mobilePath,
                ]
            );
        }
    }

    private function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
