<!DOCTYPE html>
<html>
<head>
    <title>Welcome to {{ config('app.name') }}</title>
</head>
<body>
<h1>Welcome, {{ $user->name }}!</h1>
<p>Thank you for registering at {{ config('app.name') }}.</p>
<p>We’re excited to have you on board!</p>
<p>If you have any questions, feel free to contact us at {{ config('mail.from.address') }}.</p>
<p>Best regards.</p>
</body>
</html>
