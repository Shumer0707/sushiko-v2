<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderNotificationMail;

class OrderController extends Controller
{
    public function store(CheckoutRequest $request)
    {
        $orderData = $request->validated();
        $managerEmail = config('mail.manager_email', 'manager@sushiko.md');

        try {
            // Отправляем письмо менеджеру
            Mail::to($managerEmail)->send(new OrderNotificationMail($orderData));

            // Если клиент указал email - отправляем ему подтверждение
            if (!empty($orderData['customer']['email'])) {
                Mail::to($orderData['customer']['email'])
                    ->send(new OrderConfirmationMail($orderData));
            }

            // Возвращаем Inertia back (редирект на ту же страницу)
            return back()->with('success', __('common.order_success'));

        } catch (\Exception $e) {
            Log::error('Order submission failed', [
                'error' => $e->getMessage(),
                'order_data' => $orderData,
            ]);

            // При ошибке тоже возвращаем Inertia back с сообщением об ошибке
            return back()->withErrors(['general' => __('common.order_error')]);
        }
    }
}
