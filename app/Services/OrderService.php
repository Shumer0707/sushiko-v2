<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderService
{
    /**
     * Возвращает данные для списка заказов:
     * - коллекция с пагинацией
     * - текущая сортировка
     * - текущие фильтры
     */
    public function getListData(Request $request): array
    {
        // сортировка
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        if (! in_array($sortField, ['id', 'created_at'], true)) {
            $sortField = 'created_at';
        }
        if (! in_array($sortDirection, ['asc', 'desc'], true)) {
            $sortDirection = 'desc';
        }

        // фильтры
        $dateFrom = $request->input('date_from');
        $dateTo   = $request->input('date_to');
        $search   = trim($request->input('search', ''));     // имя / телефон / сумма
        $orderId  = trim($request->input('order_id', ''));   // отдельное поле для ID

        $query = Order::with(['items'])->withCount('items');

        // фильтр по датам
        if (!empty($dateFrom)) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        if (!empty($dateTo)) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        // точный фильтр по ID
        if ($orderId !== '' && ctype_digit($orderId)) {
            $query->where('id', (int) $orderId);
        }

        // общий поиск по имени, телефону и сумме (без ID)
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_phone', 'like', "%{$search}%");

                if (is_numeric($search)) {
                    $q->orWhere('total_with_delivery', (float) $search);
                }
            });
        }

        $orders = $query
            ->orderBy($sortField, $sortDirection)
            ->paginate(50)
            ->withQueryString();

        $sort = [
            'field'     => $sortField,
            'direction' => $sortDirection,
        ];

        $filters = [
            'date_from' => $dateFrom,
            'date_to'   => $dateTo,
            'search'    => $search,
            'order_id'  => $orderId,
        ];

        return compact('orders', 'sort', 'filters');
    }
}
