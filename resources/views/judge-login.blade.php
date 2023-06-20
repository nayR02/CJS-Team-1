<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo asset('/assets/css/style.css') ?>">

    <title>Judge Login Page</title>
</head>

<body>
    <div class="hero">
        <div class="form-box">
            <button class="dropdown-btn">Role &#x25BE;</button>
            <div class="dropdown-content">
                <a href="admin-login">Admin</a>
                <a href="judge-login">Judge</a>
            </div>

            <form method="POST" action="{{route('judge-user')}}" id="login" class="input-group">
                @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                @csrf
                <header>
                    <img src="/img/logo4.jpg" alt="Form Image">
                    <h2>Miss Q</h2>
                </header>
                <center><p>JUDGE</p></center>
                <input type="text" name="username" class="input-field" placeholder="Username" required>
                <input type="password" name="password" class="input-field" placeholder="Password" required>
                @if ($errors->has('error'))
                <div class="alert alert-danger error-message">
                    {{ $errors->first('error') }}
                </div>
                @endif
                <button type="submit" class="submit-btn" id="my-button">Login</button>
                <div id="loader-container">
                    <div id="loader"></div>
                </div>
            </form>
        </div>
    </div>
    <script>
        const button = document.querySelector("#my-button");
        const loaderContainer = document.querySelector("#loader-container");

        window.onbeforeunload = function () {
            showLoader();
        };

        function showLoader() {
            loaderContainer.style.display = "flex";
        }

        function hideLoader() {
            loaderContainer.style.display = "none";
        }

        function enableButton() {
            if (input.value.trim() !== "") {
                button.disabled = false;
            } else {
                button.disabled = true;
            }
        }

        // input.addEventListener("input", enableButton);

        button.addEventListener("click", function () {
            showLoader();

            setTimeout(function () {
                hideLoader();

            }, 2000);
        });

    </script>
    <script>
        const dropdownBtn = document.querySelector(".dropdown-btn");
        const dropdownContent = document.querySelector(".dropdown-content");

        dropdownBtn.addEventListener("click", function () {
        dropdownContent.style.display = dropdownContent.style.display === "none" ? "block" : "none";
        });

    </script>

</body>

</html>
