<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('/assets/css/core.css')}}"> 
    <title>@yield("title")</title>
</head>

<body>
    <header>
        @yield('header')
        <img class="logoimg" src="{{asset('/assets/images/logomain.png')}}" alt="">
        <nav class="navigation">
            <button class="tgl-button btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-bars"></i></button>
            <ul class="nav-links">
                <li><a href="{{('/add_info')}}">Configurations</a></li>
                <li><a href="{{('/judges')}}">Judges</a></li>
                <li><a href="{{('/candidates')}}">Candidates</a></li>
            </ul>
            <ul class="__except">
                <li class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-user"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{'/judge-to-admin-results'}}">Results</a></li>
                        <li><a class="dropdown-item" href="{{route('admin-logout')}}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <div class="canvas__">
        @yield('.canvas__')
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Offcanvas with body scrolling</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
            <ul class="nav-links d-flex flex-column justify-content-center align-items-center">
                <li><a href="{{('/add_info')}}">Configurations</a></li>
                <li><a href="{{('/judges')}}">Judges</a></li>
                <li><a href="{{('/categories')}}">Categories</a></li>
                <li><a href="{{('/candidates')}}">Candidates</a></li>
                <li><a href="">Logout</a></li>
            </ul>
            </div>
        </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>