<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html {
            color-scheme: light only;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
            -webkit-font-smoothing: antialiased;
            color: #1f2937;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 25px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border-top: 4px solid #6366f1;
        }

        .container::before {
            content: "";
            display: block;
            height: 4px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            margin: -25px -25px 20px -25px;
        }

        .header {
            text-align: left;
            margin-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 15px;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
            letter-spacing: 2px;
            font-family: 'Segoe UI', sans-serif;
        }

        .otp {
            font-size: 32px;
            font-weight: bold;
            padding: 15px;
            background-color: #eef2ff;
            display: inline-block;
            border-radius: 6px;
            margin: 20px 0;
            letter-spacing: 4px;
            color: #1e3a8a;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        .content {
            font-size: 15px;
            color: #374151;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .footer {
            font-size: 13px;
            color: #6b7280;
            text-align: left;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }

        .button {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff;
            padding: 12px 20px;
            text-decoration: none;
            font-size: 15px;
            border-radius: 5px;
            margin-top: 15px;
            transition: background-color 0.3s ease;
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }

        .button:hover {
            background-color: #4338ca;
        }

        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 20px;
                margin: 0 5px;
            }

            .logo,
            .otp {
                text-align: center;
                display: block;
            }

            .button {
                width: 100%;
                text-align: center;
                box-sizing: border-box;
            }
        }
    </style>
</head>

<body>
    <span style="display:none; visibility:hidden;">Your IMS OTP Code - valid for 10 minutes.</span>

    <div class="container">
        <div class="header">
            <div class="logo">
                <span style="color:#6366f1;">IMS</span> <span style="color:#4b5563; font-weight:normal;">Scholarships</span>
            </div>
        </div>

        <div class="content">
            <h2 style="color:#1f2937; font-size:20px;">Admin Login OTP</h2>
            <p>Use the following OTP to authenticate your login request:</p>

            <div style="text-align:center;">
                <div class="otp">{{ $otp }}</div>
            </div>

            <p><strong>Note:</strong> This OTP will expire in 10 minutes. Do not share this code with anyone.</p>
        </div>

        <div class="footer">
            <p>You received this email because you're registered as an Admin on the IMS Scholarships system. If this wasn't you, please contact our support team immediately.</p>

            <a href="https://www.imsscholarships.com" class="button">Visit IMS Scholarships</a>

            <p style="margin-top:15px; font-style: italic;">Need help? Contact us at <a href="mailto:support@imsscholarships.com" style="color:#4f46e5; text-decoration: none;">support@imsscholarships.com</a></p>

            <p style="margin-top:10px;">&copy; {{ date('Y') }} IMS Scholarships. All rights reserved.</p>
        </div>
    </div>
</body>

</html>