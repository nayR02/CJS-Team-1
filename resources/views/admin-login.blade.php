<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo asset('assets/css/style.css') ?>">
    <title>Login Page</title>
</head>

<body>
<div class="hero">
        <div class="form-box">
            <form method="POST" action="{{route('user')}}" id="login" class="input-group">
                @csrf
                <header>
                    <img src="storage/img/logo4.jpg" alt="Form Image">
                    <h2>Miss Q</h2>
                </header>
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

</body>

</html>
