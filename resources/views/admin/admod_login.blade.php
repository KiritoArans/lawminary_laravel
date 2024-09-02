<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Admin / Moderator Login</title>
    <link rel="icon" href="{{ asset('imgs/lawminarylogo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/admin/admod_login_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <content>
        <div class="login-container">
            <img src="../../imgs/Lawminary_Logo_2-Gold.png" alt="Lawminary Logo">
            <h1>Login</h1>
            <form action="{{ route('loginAdMod') }}" method="POST">
                @csrf
                @if ($errors->has('loginError'))
                <div class="error">
                    <span>{{ $errors->first('loginError') }}</span>
                </div>
                @endif
                <label for="" class="label-ttl">Username</label>
                <input type="text" id="username" name="username" placeholder="Type your username" value="{{ old('username') }}" required>
            
                <label for="" class="label-ttl">Password</label>
                <input type="password" id="password" name="password" placeholder="Type your password" required>
            
                <div class="toggle-container">
                    <div class="toggle-boxes">
                        <label for="admin">Admin</label>
                    </div>
                    <div class="toggle-boxes">
                        <label class="switch">
                            <input type="checkbox" name="is_moderator" id="is_moderator">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="toggle-boxes">
                        <label for="moderator">Moderator</label>
                    </div>
                </div>
                <button type="submit">Login</button>
            </form>
            
        </div>
    </content>
</body>
</html>
