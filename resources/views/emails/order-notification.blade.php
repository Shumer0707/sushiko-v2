<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новый заказ</title>
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
            background: #1a1a1a;
            color: #D4AF37;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            text-align: center;
            margin: -30px -30px 20px -30px;
        }

        .section {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .section:last-child {
            border-bottom: none;
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
        }

        .items-table th {
            background: #f8f8f8;
            padding: 10px;
            text-align: left;
            border-bottom: 2px solid #ddd;
        }

        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .total {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            color: #D4AF37;
            margin-top: 20px;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-delivery {
            background: #e3f2fd;
            color: #1976d2;
        }

        .badge-pickup {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .badge-cash {
            background: #e8f5e9;
            color: #388e3c;
        }

        .badge-card {
            background: #fff3e0;
            color: #f57c00;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0;">🍱 НОВЫЙ ЗАКАЗ</h1>
            <p style="margin: 5px 0 0 0;">Sushiko.md</p>
        </div>

        {{-- Информация о клиенте --}}
        <div class="section">
            <h2>👤 Клиент</h2>
            <div class="info-row">
                <span class="label">Имя:</span>
                <span class="value">{{ $order['customer']['name'] }}</span>
            </div>
            <div class="info-row">
                <span class="label">Телефон:</span>
                <span class="value"><strong>{{ $order['customer']['phone'] }}</strong></span>
            </div>
            @if (!empty($order['customer']['email']))
                <div class="info-row">
                    <span class="label">Email:</span>
                    <span class="value">{{ $order['customer']['email'] }}</span>
                </div>
            @endif
        </div>

        {{-- Доставка --}}
        <div class="section">
            <h2>🚚 Доставка</h2>
            <div class="info-row">
                <span class="label">Способ получения:</span>
                <span>
                    @if ($order['delivery']['method'] === 'pickup')
                        <span class="badge badge-pickup">Самовывоз</span>
                    @else
                        <span class="badge badge-delivery">Доставка</span>
                    @endif
                </span>
            </div>

            @if ($order['delivery']['method'] === 'delivery')
                <div class="info-row">
                    <span class="label">Тип адреса:</span>
                    <span class="value">
                        {{ $order['delivery']['addressType'] === 'house' ? 'Частный дом' : 'Многоквартирный' }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="label">Адрес:</span>
                    <span class="value">
                        {{ $order['delivery']['address'] }}, {{ $order['delivery']['houseNumber'] }}
                    </span>
                </div>

                @if ($order['delivery']['addressType'] === 'apartment')
                    <div class="info-row">
                        <span class="label">Квартира:</span>
                        <span class="value">{{ $order['delivery']['apartmentNumber'] }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Подъезд:</span>
                        <span class="value">{{ $order['delivery']['entrance'] }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Этаж:</span>
                        <span class="value">{{ $order['delivery']['floor'] }}</span>
                    </div>
                @endif
            @endif
        </div>

        {{-- Товары --}}
        <div class="section">
            <h2>🛒 Состав заказа</h2>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th style="text-align: center;">Кол-во</th>
                        <th style="text-align: right;">Цена</th>
                        <th style="text-align: right;">Сумма</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order['items'] as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td style="text-align: center;">{{ $item['quantity'] }}</td>
                            <td style="text-align: right;">{{ $item['price'] }} {{ $order['currency'] }}</td>
                            <td style="text-align: right;">
                                <strong>{{ $item['price'] * $item['quantity'] }} {{ $order['currency'] }}</strong>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 15px; padding-top: 15px; border-top: 2px solid #ddd;">
                <div class="info-row">
                    <span class="label">Стоимость товаров:</span>
                    <span class="value">{{ $order['total'] }} {{ $order['currency'] }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Доставка:</span>
                    <span class="value">{{ $order['deliveryCost'] }} {{ $order['currency'] }}</span>
                </div>
                <div class="total">
                    ИТОГО: {{ $order['totalWithDelivery'] }} {{ $order['currency'] }}
                </div>
            </div>
        </div>

        {{-- Оплата --}}
        <div class="section">
            <h2>💳 Оплата</h2>
            <div class="info-row">
                <span class="label">Способ оплаты:</span>
                <span>
                    @if ($order['payment'] === 'cash')
                        <span class="badge badge-cash">Наличными</span>
                    @else
                        <span class="badge badge-card">Картой</span>
                    @endif
                </span>
            </div>
        </div>

        {{-- Комментарий --}}
        @if (!empty($order['comment']))
            <div class="section">
                <h2>💬 Комментарий</h2>
                <p style="background: #f8f8f8; padding: 15px; border-radius: 5px; margin: 10px 0;">
                    {{ $order['comment'] }}
                </p>
            </div>
        @endif

        <div
            style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 2px solid #eee; color: #999; font-size: 12px;">
            <p>Письмо отправлено автоматически с сайта Sushiko.md</p>
            <p>{{ now()->format('d.m.Y H:i') }}</p>
        </div>
    </div>
</body>

</html>
