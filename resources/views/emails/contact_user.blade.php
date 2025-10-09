<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #d4af37;
            padding: 30px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            background: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 0 0 8px 8px;
        }

        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #d4af37;
        }

        .message-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #d4af37;
            margin: 20px 0;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #d4af37;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>{{ __('common.email_user_title') }}</h2>
    </div>

    <div class="content">
        <div class="greeting">
            {{ __('common.email_user_greeting') }}, {{ $data['name'] }}!
        </div>

        <p>{{ __('common.email_user_text') }}</p>

        <div class="message-box">
            <strong>{{ __('common.email_user_your_message') }}</strong>
            <p style="margin-top: 10px;">{{ $data['message'] }}</p>
        </div>

        <div class="footer">
            {{ __('common.email_user_footer') }}
        </div>
    </div>
</body>

</html>
