<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Http\Requests\Admin\Category\IndexCategoryRequest;
use App\Http\Requests\Admin\Category\DestroyCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $service) {}

    public function index(IndexCategoryRequest $request)
    {
        return Inertia::render('Admin/Categories/Index', [
            'categories' => $this->service->listWithTranslations(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Categories/Create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('admin.categories.index')->with('success', 'Категория создана');
    }

    public function edit($id)
    {
        $category = Category::with('translations')->findOrFail($id);
        return Inertia::render('Admin/Categories/Edit', ['category' => $category]);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $this->service->update($category, $request->validated());
        return redirect()->route('admin.categories.index')->with('success', 'Категория обновлена');
    }

    public function destroy(DestroyCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $this->service->delete($category);
        return redirect()->route('admin.categories.index')->with('success', 'Категория удалена');
    }
}
