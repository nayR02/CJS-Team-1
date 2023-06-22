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
        <button class="toggle-btn" onclick="toggleButton(event, 'admin')">Admin</button>
        <button class="toggle-btn" onclick="toggleButton(event, 'judge')">Judge</button>
      </div>
      <form method="POST" action="{{route('user')}}" id="admin" class="input-group">
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
    document.addEventListener("DOMContentLoaded", function() {
      const activeButton = sessionStorage.getItem('activeButton');
      if (activeButton) {
        const buttons = document.querySelectorAll('.toggle-btn');
        buttons.forEach(button => {
          if (button.textContent.toLowerCase() === activeButton) {
            button.classList.add('active');
          }
        });
      }
    });

    function toggleButton(event, buttonType) {
      event.preventDefault();
      const clickedButton = event.target;
      clickedButton.classList.toggle('active');

      const buttons = document.querySelectorAll('.toggle-btn');
      buttons.forEach(button => {
        if (button !== clickedButton) {
          button.classList.remove('active');
        }
      });

      sessionStorage.setItem('activeButton', buttonType);

      if (buttonType === 'admin') {
        window.location.href = 'admin-login'; // Redirect to the admin login route
      } else if (buttonType === 'judge') {
        window.location.href = 'judge-login'; // Redirect to the judge login route
      }
    }
  </script>


</body>

</html>