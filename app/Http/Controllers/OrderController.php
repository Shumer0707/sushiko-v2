<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderNotificationMail;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function store(CheckoutRequest $request)
    {
        // Валидированные данные из формы
        $data = $request->validated();
        $managerEmail = config('mail.manager_email', 'manager@sushiko.md');

        DB::beginTransaction();

        try {
            // 1) Сохраняем заказ
            $order = Order::create([
                'customer_name'        => $data['customer']['name'],
                'customer_phone'       => $data['customer']['phone'],
                'customer_email'       => $data['customer']['email'] ?? null,

                'delivery_method'      => $data['delivery']['method'],
                'address_type'         => $data['delivery']['addressType'] ?? null,
                'address'              => $data['delivery']['address'] ?? null,
                'house_number'         => $data['delivery']['houseNumber'] ?? null,
                'apartment_number'     => $data['delivery']['apartmentNumber'] ?? null,
                'entrance'             => $data['delivery']['entrance'] ?? null,
                'floor'                => $data['delivery']['floor'] ?? null,
                'intercom'             => $data['delivery']['intercom'] ?? null,

                'payment'              => $data['payment'],
                'comment'              => $data['comment'] ?? null,

                'total'                => $data['total'],
                'delivery_cost'        => $data['deliveryCost'],
                'total_with_delivery'  => $data['totalWithDelivery'],
                'currency'             => $data['currency'],

                // статус по умолчанию
                'status'               => 'new',
            ]);

            // 2) Сохраняем позиции заказа
            foreach ($data['items'] as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['id'] ?? null, // если хочешь привязку к товарам
                    'name'       => $item['name'],
                    'price'      => $item['price'],
                    'quantity'   => $item['quantity'],
                    'total'      => $item['price'] * $item['quantity'],
                ]);
            }

            // 3) Готовим данные для писем и добавляем id заказа
            $orderData = $data;
            $orderData['order_id'] = $order->id;

            // Письмо менеджеру
            Mail::to($managerEmail)->send(new OrderNotificationMail($orderData));

            // Письмо клиенту (если указал email)
            if (!empty($orderData['customer']['email'])) {
                Mail::to($orderData['customer']['email'])
                    ->send(new OrderConfirmationMail($orderData));
            }

            DB::commit();

            // Можно передать order_id во flash, чтобы показать на фронте
            return back()->with([
                'success'  => __('common.order_success'),
                'order_id' => $order->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Order submission failed', [
                'error' => $e->getMessage(),
                'data'  => $data,
            ]);

            return back()->withErrors(['general' => __('common.order_error')]);
        }
    }
}
