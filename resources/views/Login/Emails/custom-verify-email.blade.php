<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Verify Your Email</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        .email-container {
            background: #fff;
            border-radius: 8px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .button {
            display: inline-block;
            background: #e3342f;
            color: #fff;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>Hello {{ $user->first_name }}!</h2>
        <p>Thanks for signing up! Please click the button below to verify your email address and complete your
            registration.</p>

        <p style="text-align: center;">
            <a href="{{ $url }}" class="button">Verify Email Address</a>
        </p>

        <p>If you didn’t create this account, you can safely ignore this email.</p>

        <div class="footer">
            &copy; {{ date('Y') }} Pharmabot Development. All rights reserved.
        </div>
    </div>
</body>

</html>
