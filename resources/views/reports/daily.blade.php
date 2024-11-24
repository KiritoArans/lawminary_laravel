<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title }}</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                line-height: 1.5;
            }
            .container {
                width: 80%;
                margin: auto;
                padding: 20px;
            }
            .header {
                text-align: center;
                margin-bottom: 30px;
                padding-bottom: 10px;
                border-bottom: 2px solid #f1f1f1;
            }
            .header img {
                width: 80px;
                margin-bottom: 10px;
            }
            .title {
                font-size: 28px;
                font-weight: bold;
                margin-top: 5px;
            }
            .date {
                font-size: 18px;
                color: #555;
            }
            .content {
                margin-top: 30px;
                font-size: 16px;
            }
            .content h3 {
                margin-bottom: 15px;
                font-size: 20px;
                font-weight: bold;
                color: #333;
            }
            .content table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 30px;
            }
            .content table,
            .content th,
            .content td {
                border: 1px solid #ddd;
                padding: 12px;
            }
            .content th {
                background-color: #f8f8f8;
                font-weight: bold;
                text-align: left;
            }
            .content td {
                text-align: left;
            }
            .footer {
                text-align: center;
                margin-top: 50px;
                font-size: 14px;
                color: #888;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <img src="{{ $logo }}" alt="Company Logo" />
                <p class="title">{{ $title }}</p>
                <p class="date">{{ $date }}</p>
            </div>
            <div class="content">
                <h3>Summary of Today's Activity</h3>
                <table>
                    <tr>
                        <th>Metric</th>
                        <th>Value</th>
                    </tr>
                    <tr>
                        <td>Pending Posts</td>
                        <td>{{ $pendingPosts }}</td>
                    </tr>
                    <tr>
                        <td>Pending Accounts</td>
                        <td>{{ $pendingAccounts }}</td>
                    </tr>
                    <tr>
                        <td>Accounts Created Today</td>
                        <td>{{ $accountsCreatedToday }}</td>
                    </tr>
                    <tr>
                        <td>Forums Created Today</td>
                        <td>{{ $forumsCreatedToday }}</td>
                    </tr>
                    <tr>
                        <td>Lawyer Comments Made Today</td>
                        <td>{{ $lawyerCommentsCount }}</td>
                    </tr>
                </table>
            </div>
            <div class="footer">
                © {{ now()->year }} Lawminary. All rights reserved.
            </div>
        </div>
    </body>
</html>
