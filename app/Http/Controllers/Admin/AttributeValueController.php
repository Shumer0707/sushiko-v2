<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttributeValue\StoreAttributeValueRequest;
use App\Http\Requests\Admin\AttributeValue\UpdateAttributeValueRequest;
use App\Models\ProductAttribute;
use App\Models\AttributeValue;
use App\Services\AttributeValueService;
use Inertia\Inertia;

class AttributeValueController extends Controller
{
    public function __construct(private AttributeValueService $service) {}

    public function index(ProductAttribute $attribute)
    {
        return Inertia::render('Admin/AttributeValues/Index', [
            'attribute' => $attribute->load('translation'),
            'values'    => $this->service->listByAttribute($attribute->id),
        ]);
    }

    public function create(ProductAttribute $attribute)
    {
        return Inertia::render('Admin/AttributeValues/Create', [
            'attribute' => $attribute->load('translation'),
        ]);
    }

    public function store(StoreAttributeValueRequest $request, ProductAttribute $attribute)
    {
        $this->service->create($attribute->id, $request->validated());
        return redirect()
            ->route('admin.attribute-values.index', $attribute)
            ->with('success', 'Значение добавлено');
    }

    public function edit(ProductAttribute $attribute, AttributeValue $value)
    {
        // защитим от чужих id в URL
        abort_unless($value->attribute_id === $attribute->id, 404);

        return Inertia::render('Admin/AttributeValues/Edit', [
            'attribute' => $attribute->load('translation'),
            'value'     => $value->load('translations'),
        ]);
    }

    public function update(UpdateAttributeValueRequest $request, ProductAttribute $attribute, AttributeValue $value)
    {
        abort_unless($value->attribute_id === $attribute->id, 404);

        $this->service->update($value, $request->validated());

        return redirect()
            ->route('admin.attribute-values.index', $attribute)
            ->with('success', 'Значение обновлено');
    }

    public function destroy(ProductAttribute $attribute, AttributeValue $value)
    {
        abort_unless($value->attribute_id === $attribute->id, 404);

        $this->service->delete($value);

        return redirect()
            ->route('admin.attribute-values.index', $attribute)
            ->with('success', 'Значение удалено');
    }
}
