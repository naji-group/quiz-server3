<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    <p>Hello,</p>
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <p>Click the button below to reset your password:</p>
    <p>
        <a href="{{ route('client.password.reset',  ['token' => $token, 'email' => $email]) }}" style="display: inline-block; padding: 10px 20px; font-size: 16px; color: white; background-color: #007bff; text-decoration: none; border-radius: 5px;">
            Reset Password
        </a>
    </p>
    <p>If you did not request a password reset, no further action is required.</p>
    <p>Regards,<br>Your Application Team</p>
</body>
</html>
