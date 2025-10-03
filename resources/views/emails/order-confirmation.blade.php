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
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="success-icon">✅</div>
            <h1 style="margin: 0; font-size: 28px;">Спасибо за заказ!</h1>
            <p style="margin: 10px 0 0 0; font-size: 16px;">Ваш заказ успешно принят</p>
        </div>

        <div style="text-align: center; margin-bottom: 30px;">
            <p style="font-size: 16px; color: #666;">
                Здравствуйте, <strong>{{ $order['customer']['name'] }}</strong>!<br>
                Мы получили ваш заказ и уже приступили к его приготовлению.
            </p>
        </div>

        {{-- Товары --}}
        <div class="section">
            <h2>🛒 Ваш заказ</h2>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th style="text-align: center;">Кол-во</th>
                        <th style="text-align: right;">Сумма</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order['items'] as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td style="text-align: center;">{{ $item['quantity'] }}</td>
                            <td style="text-align: right;">
                                <strong>{{ $item['price'] * $item['quantity'] }} {{ $order['currency'] }}</strong>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total-box">
                <div style="font-size: 14px; color: #D4AF37; margin-bottom: 10px;">ИТОГО К ОПЛАТЕ</div>
                <div class="total-amount">{{ $order['totalWithDelivery'] }} {{ $order['currency'] }}</div>
                <div style="font-size: 12px; color: #999; margin-top: 5px;">
                    (включая доставку {{ $order['deliveryCost'] }} {{ $order['currency'] }})
                </div>
            </div>
        </div>

        {{-- Доставка --}}
        <div class="section">
            <h2>🚚 Информация о доставке</h2>
            @if ($order['delivery']['method'] === 'pickup')
                <div style="background: #fff3e0; border-left: 4px solid #ff9800; padding: 15px; border-radius: 5px;">
                    <strong>Самовывоз</strong><br>
                    Адрес: ул. Пушкина, д. 10<br>
                    Время работы: 10:00 - 22:00
                </div>
            @else
                <div class="info-row">
                    <span class="label">Адрес доставки:</span>
                </div>
                <div style="background: white; padding: 15px; border-radius: 5px; margin-top: 10px;">
                    <strong>{{ $order['delivery']['address'] }}, {{ $order['delivery']['houseNumber'] }}</strong>
                    @if ($order['delivery']['addressType'] === 'apartment')
                        <br>Кв. {{ $order['delivery']['apartmentNumber'] }},
                        Подъезд {{ $order['delivery']['entrance'] }},
                        Этаж {{ $order['delivery']['floor'] }}
                    @endif
                </div>
            @endif

            <div class="info-row" style="margin-top: 15px;">
                <span class="label">Способ оплаты:</span>
                <span class="value">
                    <strong>{{ $order['payment'] === 'cash' ? 'Наличными' : 'Картой' }}</strong>
                </span>
            </div>
        </div>

        {{-- Контактная информация --}}
        <div class="contact-info">
            <strong>📞 Если у вас возникли вопросы:</strong><br>
            Телефон: <a href="tel:+37312345678" style="color: #4caf50;">+373 12 345 678</a><br>
            Email: <a href="mailto:info@sushiko.md" style="color: #4caf50;">info@sushiko.md</a>
        </div>

        <div class="footer">
            <p><strong>Sushiko.md</strong> - свежие суши с доставкой</p>
            <p>Спасибо, что выбрали нас! 🍱</p>
            <p style="margin-top: 15px; font-size: 11px;">
                Письмо отправлено {{ now()->format('d.m.Y в H:i') }}
            </p>
        </div>
    </div>
</body>

</html>
