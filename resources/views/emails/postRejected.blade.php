<!DOCTYPE html>
<html>
    <head>
        <title>Post Rejected</title>
    </head>
    <body>
        <p>Dear {{ $post->user->name }},</p>
        <p>
            Unfortunately, your post titled "{{ $post->concern }}" has been
            rejected.
        </p>
        <p>Reason: {{ $reason }}</p>
        <p>
            We encourage you to review the feedback and resubmit if appropriate.
        </p>
    </body>
</html>
