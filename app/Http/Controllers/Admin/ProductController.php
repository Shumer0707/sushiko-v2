<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function __construct(private ProductService $service) {}

    public function index(Request $request)
    {
        $filters = $this->service->resolveFilters($request);

        return Inertia::render('Admin/Products/Index', [
            'products'   => $this->service->list($filters),
            'categories' => $this->service->getFilterCategories(),
            'filters'    => $filters,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Products/Create', [
            'brands'     => Brand::with('translation')->orderBy('sort_order')->get(['id']),
            'categories' => Category::with('translation')->orderBy('sort_order')->get(['id']),
            'attributes' => ProductAttribute::with(['translation', 'values.translation'])
                ->orderBy('sort_order')
                ->get(),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('admin.products.index')->with('success', 'Товар создан');
    }

    public function edit($id)
    {
        $product = Product::with([
            'translations',
            'images',
            'attributeValues.attribute.translations',
            'attributeValues.translations'
        ])->findOrFail($id);

        return Inertia::render('Admin/Products/Edit', [
            'product'    => $product,
            'brands'     => Brand::with('translation')->orderBy('sort_order')->get(['id']),
            'categories' => Category::with('translation')->orderBy('sort_order')->get(['id']),
            'attributes' => ProductAttribute::with(['translation', 'values.translation'])
                ->orderBy('sort_order')
                ->get(),
        ]);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->service->update($product, $request->validated());

        return redirect()->route('admin.products.index')->with('success', 'Товар обновлён');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->service->delete($product);

        return redirect()->route('admin.products.index')->with('success', 'Товар удалён');
    }
}
