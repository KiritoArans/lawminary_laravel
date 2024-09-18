<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Settings</title>
        <link rel="icon" href="../../imgs/lawminarylogo.png" type="image/png" />
        <link
            rel="stylesheet"
            href="{{ asset('css/settings/activity_logs_style.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
        @include('inclusions/libraryLinks')
    </head>
    <body>
        <div class="container">
            @include('inclusions/userNav')
            <main>
                <header>
                    <div class="header-top">
                        @include('includes_syscon.syscon_logo_inc')
                        <div class="notification">
                            <a href="../notifications">
                                <i class="fas fa-bell bell-icon"></i>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>
                <content>
                    <div class="logs">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Activity</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2024-06-14</td>
                                    <td>Like</td>
                                    <td>You liked a post by John Doe</td>
                                </tr>
                                <tr>
                                    <td>2024-06-13</td>
                                    <td>Comment</td>
                                    <td>
                                        You commented on a post by Jane Smith
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-06-12</td>
                                    <td>Post</td>
                                    <td>You created a new post</td>
                                </tr>
                                <tr>
                                    <td>2024-06-11</td>
                                    <td>Share</td>
                                    <td>You shared a post by Alex Brown</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </content>
            </main>
        </div>
        <script src="../js/settings.js"></script>
        <script src="../js/logout.js"></script>
    </body>
</html>
