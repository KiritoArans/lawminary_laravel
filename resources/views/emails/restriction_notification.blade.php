<!DOCTYPE html>
<html>
    <head>
        <title>Account Restriction Notification</title>
    </head>
    <body>
        <h1>Hello, {{ $username }}</h1>
        @if ($isBlocked)
            <p>Your account is blocked.</p>
        @else
            <p>
                Your account has been restricted for {{ $restrictDays }} day/s.
            </p>
        @endif
        <p>Please contact support if you have any questions.</p>
    </body>
</html>
