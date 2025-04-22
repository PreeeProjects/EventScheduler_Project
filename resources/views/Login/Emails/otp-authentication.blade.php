<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome Email</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f6f6f6; padding: 20px;">

    <table width="100%" cellpadding="0" cellspacing="0"
        style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); overflow: hidden;">
        <tr>
            <td style="padding: 30px 20px; text-align: center;">
                <h1 style="color: #2c3e50; margin-bottom: 10px;">👋 Great Day, {{ $name }}!</h1>
                <p style="color: #555; font-size: 16px; line-height: 1.6;">
                    Forgot your password? Don't worry! Here's your OTP Code to reset your password:
                </p>
                <h3
                    style="background: #f1f1f1; display: inline-block; padding: 10px 20px; color: #333; letter-spacing: 2px;">
                    {{ $code }}
                </h3>
                <p style="color: #555; font-size: 14px; margin-top: 20px;">
                    Please use this code to reset your password. The code is valid for a limited time only.
                </p>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f0f0f0; text-align: center; padding: 15px; font-size: 12px; color: #999;">
                &copy; {{ date('Y') }} Laravel Project. All rights reserved.
            </td>
        </tr>
    </table>

</body>

</html>