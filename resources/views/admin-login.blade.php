<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo asset('/assets/css/style.css') ?>">

    <title> Login Page</title>
</head>

<body class="loginpage__">
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <button type="button" class="toggle-btn" onclick="login()"><a href="admin-login">Admin</a></button>
                <button type="button" class="toggle-btn" onclick="register()"><a href="judge-login">Judge</a></button>
            </div>
            <form method="POST" action="{{route('user')}}" id="login" class="input-group">
                @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                @csrf
                <header>
                    <img src="/assets/images/logomain.png" alt="Form Image">
                </header>
                <input type="text" name="username" class="input-field" placeholder="Username" required>
                <input type="password" name="password" class="input-field" placeholder="Password" required>
                @if ($errors->has('error'))
                <div class="alert alert-danger error-message">
                    {{ $errors->first('error') }}
                </div>
                @endif
                <button type="submit" class="submit-btn" id="my-button">Login</button>
            </form>
            <form method="POST" action="{{route('judge-user')}}" id="register" class="input-group">
                @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                @csrf
                <header>
                    <img src="/assets/images/logomain.png" alt="Form Image">
                </header>
                <input type="text" name="username" class="input-field" placeholder="Username" required>
                <input type="password" name="password" class="input-field" placeholder="Password" required>
                @if ($errors->has('error'))
                <div class="alert alert-danger error-message">
                    {{ $errors->first('error') }}
                </div>
                @endif
                <button type="submit" class="submit-btn" id="my-button">Login</button>
            </form>
        </div>
    </div>
    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        // Check if there is a clicked state stored in the local storage
        var isClicked = localStorage.getItem("isClicked");
        if (isClicked === "register") {
            register();
        } else {
            login();
        }

        function register() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";

            // Store the clicked state in the local storage
            localStorage.setItem("isClicked", "register");
        }

        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";

            // Store the clicked state in the local storage
            localStorage.setItem("isClicked", "login");
        }
    </script>


</body>

</html>