<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title }}</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            .header {
                text-align: center;
                margin-bottom: 20px;
            }
            .header img {
                width: 100px;
            }
            .title {
                font-size: 24px;
                font-weight: bold;
            }
            .content {
                margin-top: 20px;
                font-size: 16px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            @if (! empty($logo))
                <img src="{{ $logo }}" alt="Logo" />
            @endif

            <p class="title">{{ $title }}</p>
            <p>{{ $date }}</p>
        </div>
        <div class="content">
            <p>{{ $content }}</p>
        </div>
    </body>
</html>
