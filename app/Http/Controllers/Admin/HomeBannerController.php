<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HomeBanner\StoreHomeBannerRequest;
use App\Http\Requests\Admin\HomeBanner\UpdateHomeBannerRequest;
use App\Models\HomeBanner;
use App\Services\HomeBannerService;
use Inertia\Inertia;

class HomeBannerController extends Controller
{
    public function __construct(private HomeBannerService $service) {}

    public function index()
    {
        return Inertia::render('Admin/HomeBanners/Index', [
            'banners' => $this->service->listWithTranslations(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/HomeBanners/Create');
    }

    public function store(StoreHomeBannerRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.home-banners.index')
            ->with('success', 'Баннер создан');
    }

    public function edit(int $id)
    {
        $banner = HomeBanner::with('translations')->findOrFail($id);

        return Inertia::render('Admin/HomeBanners/Edit', [
            'banner' => $banner,
        ]);
    }

    public function update(UpdateHomeBannerRequest $request, int $id)
    {
        $banner = HomeBanner::with('translations')->findOrFail($id);
        $this->service->update($banner, $request->validated());

        return redirect()->route('admin.home-banners.index')
            ->with('success', 'Баннер обновлён');
    }

    public function destroy(int $id)
    {
        $banner = HomeBanner::with('translations')->findOrFail($id);
        $this->service->delete($banner);

        return redirect()->route('admin.home-banners.index')
            ->with('success', 'Баннер удалён');
    }
}
