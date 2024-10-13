<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
</head>
<body>
    <h1>Your One-Time Password (OTP)</h1>
    <p>Do not share this to anyone.</p>
    <h2><?php echo e($otp); ?></h2>
    <p>Note: This OTP is only valid for 5 minutes.</p>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/emails/otp.blade.php ENDPATH**/ ?>