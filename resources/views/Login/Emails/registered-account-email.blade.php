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
                <h1 style="color: #2c3e50; margin-bottom: 10px;">👋 Hello, {{ $name }}!</h1>
                <p style="color: #555; font-size: 16px; line-height: 1.6;">
                    You have successfully registered your account.
                </p>
                <p style="color: #555; font-size: 16px; line-height: 1.6;">
                    Our team will notify you via email once your account has been reviewed and approved or declined by
                    the administrator
                </p>
                <p style="margin-top: 30px; font-weight: bold; color: #3498db;">Stay tuned!</p>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f0f0f0; text-align: center; padding: 15px; font-size: 12px; color: #999;">
                &copy; {{ date('Y') }} Event Scheduler. All rights reserved.
            </td>
        </tr>
    </table>

</body>

</html>