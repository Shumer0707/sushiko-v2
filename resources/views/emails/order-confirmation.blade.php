<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подтверждение заказа</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #D4AF37;
            padding: 30px;
            border-radius: 10px 10px 0 0;
            text-align: center;
            margin: -30px -30px 30px -30px;
        }

        .success-icon {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .section {
            margin-bottom: 25px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
        }

        h2 {
            color: #D4AF37;
            margin-top: 0;
            font-size: 18px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }

        .label {
            font-weight: bold;
            color: #666;
        }

        .value {
            color: #333;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: white;
        }

        .items-table th {
            background: #1a1a1a;
            color: #D4AF37;
            padding: 12px;
            text-align: left;
        }

        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .total-box {
            background: #1a1a1a;
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-top: 20px;
        }

        .total-amount {
            font-size: 32px;
            font-weight: bold;
            color: #D4AF37;
        }

        .contact-info {
            background: #e8f5e9;
            border-left: 4px solid #4caf50;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #eee;
            color: #999;
            font-size: 13px;
        }
    </style>

<body>
    <div class="container">
        <div class="header">
            <div class="success-icon">✅</div>
            <h1 style="margin: 0; font-size: 28px;">
                {{ __('mail.order_email_title') }}
            </h1>
            <p style="margin: 10px 0 0 0; font-size: 16px;">
                {!! __('mail.order_email_hello', [
                    'name' => '<strong>' . e($order['customer']['name']) . '</strong>',
                ]) !!}<br>
                {{ __('mail.order_email_intro') }}
            </p>
            <p style="margin: 10px 0 0 0; font-size: 16px;">
                {{ __('mail.order_email_id') }}{{ $order['order_id'] }}
            </p>
        </div>

        <div style="text-align: center; margin-bottom: 30px;">
            <p style="font-size: 12px; color: #666;">
                {{ __('mail.order_email_note_confirm') }}<br>
                {{ __('mail.order_email_note_call') }}
            </p>
        </div>
        @php
            $currency = $order['currency'] ?? 'MDL';

            $isDiscount = fn($item) => !empty($item['has_promotion']) &&
                ($item['promotion_type'] ?? null) === 'discount';
            $isGift = fn($item) => !empty($item['has_promotion']) && ($item['promotion_type'] ?? null) === 'gift';

            $salePrice = fn($item) => (float) ($item['price'] ?? 0); // то, что реально продаём
            $basePrice = fn($item) => (float) ($item['base_price'] ?? ($item['price'] ?? 0));

            $giftText = function ($item) {
                if (empty($item['gift_product']['name'])) {
                    return null;
                }
                $qty = $item['gift_product']['quantity'] ?? 1;
                return $item['gift_product']['name'] . ' × ' . $qty;
            };
        @endphp
        {{-- Товары --}}
        <div class="section">
            <h2>🛒 {{ __('mail.order_email_block_order') }}</h2>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>{{ __('mail.order_email_item') }}</th>
                        <th style="text-align: center;">{{ __('mail.order_email_quantity') }}</th>
                        <th style="text-align: right;">{{ __('mail.order_email_sum') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order['items'] as $item)
                        @php
                            $qty = (int) ($item['quantity'] ?? 1);
                            $sale = $salePrice($item);
                            $base = $basePrice($item);
                            $line = $sale * $qty;
                            $gift = $giftText($item);
                        @endphp

                        <tr>
                            <td>
                                {{ $item['name'] }}

                                @if ($isGift($item) && $gift)
                                    <div style="margin-top:4px; color:#F43F5E; font-weight:bold;">
                                        🎁 + {{ $gift }}
                                    </div>
                                @endif
                            </td>

                            <td style="text-align: center;">{{ $qty }}</td>

                            <td style="text-align: right; white-space:nowrap;">
                                @if ($isDiscount($item) && $base > $sale)
                                    <div style="font-size:12px; color:#D4AF37; text-decoration:line-through;">
                                        {{ number_format($base, 0, '.', '') }} {{ $currency }}
                                    </div>
                                    <strong style="color:#F43F5E;">
                                        {{ number_format($sale, 0, '.', '') }} {{ $currency }}
                                    </strong>
                                @else
                                    <strong>{{ number_format($sale, 0, '.', '') }} {{ $currency }}</strong>
                                @endif

                                <div style="font-size:12px; color:#999; margin-top:2px;">
                                    = {{ number_format($line, 0, '.', '') }} {{ $currency }}
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="total-box">
                <div style="font-size: 14px; color: #D4AF37; margin-bottom: 10px;">
                    {{ __('mail.order_email_total_title') }}
                </div>
                <div class="total-amount">
                    {{ $order['totalWithDelivery'] }} {{ $order['currency'] }}
                </div>
                <div style="font-size: 12px; color: #999; margin-top: 5px;">
                    {{ __('mail.order_email_total_delivery_included', [
                        'amount' => $order['deliveryCost'],
                        'currency' => $order['currency'],
                    ]) }}
                </div>
            </div>
        </div>

        {{-- Доставка --}}
        <div class="section">
            <h2>🚚 {{ __('mail.order_email_delivery_info') }}</h2>
            @if ($order['delivery']['method'] === 'pickup')
                <div style="background: #fff3e0; border-left: 4px solid #ff9800; padding: 15px; border-radius: 5px;">
                    <strong>{{ __('mail.order_email_delivery_pickup') }}</strong><br>
                    {{ __('mail.order_email_delivery_pickup_address') }}<br>
                    {{ __('mail.order_email_delivery_pickup_hours') }}
                </div>
            @else
                <div class="info-row">
                    <span class="label">{{ __('mail.order_email_delivery_address_label') }}</span>
                </div>
                <div style="background: white; padding: 15px; border-radius: 5px; margin-top: 10px;">
                    <strong>{{ $order['delivery']['address'] }}, {{ $order['delivery']['houseNumber'] }}</strong>
                    @if ($order['delivery']['addressType'] === 'apartment')
                        @php
                            $details = [];

                            if (!empty($order['delivery']['apartmentNumber'] ?? null)) {
                                $details[] = __('mail.order_email_delivery_address_apartment', [
                                    'apartment' => $order['delivery']['apartmentNumber'],
                                ]);
                            }

                            if (!empty($order['delivery']['entrance'] ?? null)) {
                                $details[] = __('mail.order_email_delivery_address_entrance', [
                                    'entrance' => $order['delivery']['entrance'],
                                ]);
                            }

                            if (!empty($order['delivery']['floor'] ?? null)) {
                                $details[] = __('mail.order_email_delivery_address_floor', [
                                    'floor' => $order['delivery']['floor'],
                                ]);
                            }

                            if (!empty($order['delivery']['intercom'] ?? null)) {
                                $details[] = __('mail.order_email_delivery_address_intercom', [
                                    'intercom' => $order['delivery']['intercom'],
                                ]);
                            }
                        @endphp

                        @if (!empty($details))
                            <br>
                            {{ implode(', ', $details) }}
                        @endif
                    @endif

                </div>
            @endif

            <div class="info-row" style="margin-top: 15px;">
                <span class="label">{{ __('mail.order_email_payment_method') }}</span>
                <span class="value">
                    <strong>
                        {{ $order['payment'] === 'cash' ? __('mail.order_email_payment_cash') : __('mail.order_email_payment_card') }}
                    </strong>
                </span>
            </div>
        </div>

        {{-- Контактная информация --}}
        <div class="contact-info">
            <strong>📞 {{ __('mail.order_email_questions') }}</strong><br>
            {{ __('mail.order_email_phone') }}
            <a href="tel:{{ config('shop.phone_shop') }}"
                style="color: #4caf50;">{{ config('shop.phone_shop') }}</a><br>
            {{ __('mail.order_email_email') }}
            <a href="mailto:{{ config('shop.email_shop') }}"
                style="color: #4caf50;">{{ config('shop.email_shop') }}</a>
        </div>

        <div class="footer">
            <p><strong>{{ __('mail.order_email_footer_slogan') }}</strong></p>
            <p>{{ __('mail.order_email_footer_thanks') }}</p>
            <p style="margin-top: 15px; font-size: 11px;">
                {{ __('mail.order_email_footer_sent_at', [
                    'datetime' => now()->format('d.m.Y H:i'),
                ]) }}
            </p>
        </div>
    </div>
</body>

</html>
