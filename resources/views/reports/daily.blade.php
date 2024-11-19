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
            .section-title {
                font-size: 18px;
                font-weight: bold;
                margin-top: 20px;
            }
            .data-item {
                margin-left: 20px;
                line-height: 1.5;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <img src="{{ $logo }}" alt="Logo" />
            <p class="title">{{ $title }}</p>
            <p>{{ $date }}</p>
        </div>
        <div class="content">
            <p class="section-title">Summary of Today's Activity:</p>
            <div class="data-item">
                <p>Pending Posts: {{ $content['pendingPosts'] }}</p>
                <p>Pending Accounts: {{ $content['pendingAccounts'] }}</p>
                <p>
                    Accounts Created Today:
                    {{ $content['accountsCreatedToday'] }}
                </p>
                <p>
                    Forums Created Today: {{ $content['forumsCreatedToday'] }}
                </p>
            </div>
        </div>
    </body>
</html>
