<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Promotion\StorePromotionRequest;
use App\Http\Requests\Admin\Promotion\UpdatePromotionRequest;
use App\Models\Product;
use App\Models\Promotion;
use App\Services\PromotionService;

class AdminPromotionController extends Controller
{
    public function __construct(private readonly PromotionService $service) {}

    public function index()
    {
        $promotions = Promotion::with(['product.translation', 'giftProduct.translation'])
            ->orderBy('priority')
            ->orderByDesc('id')
            ->paginate(50);

        return inertia('Admin/Promotions/IndexPromotions', [
            'promotions' => $promotions,
        ]);
    }

    public function create()
    {
        $products = Product::with('translation')->orderByDesc('id')->limit(500)->get();

        return inertia('Admin/Promotions/CreatePromotion', [
            'products' => $products,
            'types' => ['discount', 'gift'],
        ]);
    }

    public function store(StorePromotionRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Акция создана');
    }

    public function edit(int $id)
    {
        $promotion = Promotion::with(['product.translation', 'giftProduct.translation'])
            ->findOrFail($id);

        $products = Product::with('translation')->orderByDesc('id')->limit(500)->get();

        return inertia('Admin/Promotions/EditPromotion', [
            'promotion' => $promotion,
            'products' => $products,
            'types' => ['discount', 'gift'],
        ]);
    }

    public function update(UpdatePromotionRequest $request, int $id)
    {
        $promotion = Promotion::findOrFail($id);

        $this->service->update($promotion, $request->validated());

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Акция обновлена');
    }

    public function destroy(int $id)
    {
        Promotion::findOrFail($id)->delete();

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Акция удалена');
    }
}
