<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Sign Up</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/signup_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <section>
        <div class="wrapper">
            <div class="container">
                <h1>Sign Up</h1>
                <div class="error">
                    @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                <form class="signup-form" method="post" action="{{route('signup')}}">
                    @csrf
                    @method('post')
                    <div class="left-column">
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="firstName" value="{{ old('firstName') }}">
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="lastName" value="{{ old('lastName') }}">
                        </div>
                        <div class="form-group">
                            <label for="nationality">Nationality</label>
                            <input type="text" id="nationality" name="nationality" value="{{ old('nationality') }}">
                        </div>
                        <div class="form-group">
                            <label for="email-address">Email Address</label>
                            <input type="email" id="email-address" name="email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="middle-column">
                        <div class="form-group">
                            <label for="middle-name">Middle Name <span>(Optional)</span></label>
                            <input type="text" id="middle-name" name="middleName" value="{{ old('middleName') }}">
                        </div>
                        <div class="form-group">
                            <label for="birth-date">Birth Date</label>
                            <input type="date" id="birth-date" name="birthDate" value="{{ old('birthDate') }}">
                        </div>
                        <div class="form-group">
                            <label for="sex">Sex</label>
                            <select name="sex" id="" value="{{ old('sex') }}">
                                <option value="" disabled {{ old('sex') === null ? 'selected' : '' }}>Option</option>
                                <option value="male" {{ old('sex') === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('sex') === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contact-number">Contact Number</label>
                            <input type="tel" id="contact-number" name="contactNumber" value="{{ old('contactNumber') }}">
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="right-column">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <div class="buttons">
                            <a href="login" class="back-home">Back to Login</a>
                            <button type="submit">Create Account</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>