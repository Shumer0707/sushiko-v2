<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\StoreBrandRequest;
use App\Http\Requests\Admin\Brand\UpdateBrandRequest;
use App\Models\Brand;
use App\Services\BrandService;
use Inertia\Inertia;

class BrandController extends Controller
{
    public function __construct(private BrandService $service) {}

    public function index()
    {
        return Inertia::render('Admin/Brands/Index', [
            'brands' => $this->service->listWithTranslations(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Brands/Create');
    }

    public function store(StoreBrandRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('admin.brands.index')->with('success', 'Бренд создан');
    }

    public function edit($id)
    {
        $brand = Brand::with('translations')->findOrFail($id);
        return Inertia::render('Admin/Brands/Edit', ['brand' => $brand]);
    }

    public function update(UpdateBrandRequest $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $this->service->update($brand, $request->validated());
        return redirect()->route('admin.brands.index')->with('success', 'Бренд обновлён');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $this->service->delete($brand);
        return redirect()->route('admin.brands.index')->with('success', 'Бренд удалён');
    }
}
