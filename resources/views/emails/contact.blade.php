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

        .field {
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-left: 4px solid #d4af37;
            border-radius: 4px;
        }

        .label {
            font-weight: bold;
            color: #d4af37;
            margin-bottom: 5px;
        }

        .value {
            color: #333;
        }

        .message-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>{{ __('common.email_contact_title') }}</h2>
    </div>

    <div class="content">
        <div class="field">
            <div class="label">{{ __('common.email_name_label') }}</div>
            <div class="value">{{ $data['name'] }}</div>
        </div>

        <div class="field">
            <div class="label">{{ __('common.email_email_label') }}</div>
            <div class="value">{{ $data['email'] }}</div>
        </div>

        @if (isset($data['phone']) && $data['phone'])
            <div class="field">
                <div class="label">{{ __('common.email_phone_label') }}</div>
                <div class="value">{{ $data['phone'] }}</div>
            </div>
        @endif

        <div class="field">
            <div class="label">{{ __('common.email_message_label') }}</div>
            <div class="message-box">{{ $data['message'] }}</div>
        </div>
    </div>
</body>

</html>
