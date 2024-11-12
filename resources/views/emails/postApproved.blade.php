<!DOCTYPE html>
<html>
    <head>
        <title>Post Approved</title>
    </head>
    <body>
        <p>Dear {{ $post->user->name }},</p>
        <p>Your post "{{ $post->concern }}" has been approved!</p>
        <p>Thank you for your contribution.</p>
    </body>
</html>
