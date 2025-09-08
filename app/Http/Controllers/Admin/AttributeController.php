<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Attribute\StoreAttributeRequest;
use App\Http\Requests\Admin\Attribute\UpdateAttributeRequest;
use App\Models\ProductAttribute;
use App\Models\AttributeTranslation;
use App\Services\AttributeService;
use Inertia\Inertia;

class AttributeController extends Controller
{
    public function __construct(
        protected AttributeService $service
    ) {}

    public function index()
    {
        $attributes = ProductAttribute::with('translations')->orderBy('sort_order')->get();

        return Inertia::render('Admin/Attributes/Index', [
            'attributes' => $attributes
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Attributes/Create');
    }

    public function store(StoreAttributeRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()->route('admin.attributes.index')
            ->with('success', 'Атрибут успешно добавлен');
    }

    public function edit(ProductAttribute $attribute)
    {
        $attribute->load('translations');

        return Inertia::render('Admin/Attributes/Edit', [
            'attribute' => $attribute
        ]);
    }

    public function update(UpdateAttributeRequest $request, ProductAttribute $attribute)
    {
        $this->service->update($attribute, $request->validated());

        return redirect()->route('admin.attributes.index')
            ->with('success', 'Атрибут успешно обновлён');
    }

    public function destroy(ProductAttribute $attribute)
    {
        $attribute->delete();

        return redirect()->route('admin.attributes.index')
            ->with('success', 'Атрибут удалён');
    }
}
