<!DOCTYPE html>
<html>
<head>
    <title>Here is Your New Requested OTP</title>
    <style>
        /* Add your email styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .logo {
            max-width: 150px;
            display: block;
            margin: 0 auto;
        }
        .message {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- <img class="logo" src="https://dashboard.esxcapitalgrowth.com/public/assets/images/bit-blockdigital_images/logomain.png" alt="Company Logo"> --}}
        <div class="message">
            <h2>Here is Your New Requested OTP</h2>
            <p>Hello {{ $user->fullname }},</p>
            <p>You recently requested a new One-Time Password (OTP) to verify your account. Please find your OTP below:</p>
            <h3 style="text-align: center; background-color: #f0f0f0; padding: 10px; border-radius: 5px;">{{ $otp }}</h3>
            <p>This OTP is valid for the next 10 minutes. If you did not request this, please ignore this email or contact our support team immediately.</p>
            <p>Thank you for choosing us. We are here to assist you!</p>
            <p>Sincerely,<br> X TESLA DIGITAL STOCKS INV. </p>
        </div>
    </div>
</body>
</html>
