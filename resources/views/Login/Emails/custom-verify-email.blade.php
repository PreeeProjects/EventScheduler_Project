<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Welcome to Pharmabot!</title>
    <style>
        body {
            font-family: 'Verdana';
            background-color: #f9fafb;
            color: #333;
            padding: 20px;
        }

        .email-container {
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        h2 {
            color: #e3342f;
        }

        .button {
            display: inline-block;
            background: rgb(4, 105, 9);
            color: #f9fafb;
            padding: 14px 28px;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 20px;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
            color: #aaa;
        }

        p {
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>🎉 Hey {{ $user->first_name }}!</h2>
        <p>Thanks for signing up with <strong>Pharmabot</strong>! We're thrilled to have you join us.</p>
        <p>To get started, please verify your email address by clicking the button below:</p>

        <p style="text-align: center;">
            <a href="{{ $url }}" class="button">Verify Email Address</a>
        </p>

        <p>If you didn’t create this account, no worries — you can safely ignore this email.</p>

        <div class="footer">
            &copy; {{ date('Y') }} Pharmabot Development. All rights reserved.
        </div>
    </div>
</body>

</html>
