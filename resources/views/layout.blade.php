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

    <!-- === -->
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header d-flex justify-content-center gap-2 flex-column" style="position: relative;">
            <img src="{{asset('/assets/images/logomain.png')}}" alt="">
            <span class="offcanvas-title" >
                <p><i>Where Beauty Meets Brains</i></p>
            </span>
            <button type="button" class="btn-close close-canvas" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex justify-content-center pt-5">
                <nav class="navigation">
                    <ul class="nav-links text-center">
                        <li class="active"><a href="{{('/add_info')}}"><i class="me-1 fa-solid fa-sliders"></i>Configurations</a></li>
                        <li class="active"><a href="{{('/judges')}}"><i class="me-1 fa-solid fa-gavel"></i>Judges</a></li>
                        <li class="active"><a href="{{('/candidates')}}"><i class="me-1 fa-solid fa-crown"></i>Candidates</a></li>
                        <li class="active"><a href="{{('/results')}}"><i class="me-1 fa-solid fa-square-poll-vertical"></i>Results</a></li>
                        <li class="exception"><a class="dropdown-item" href="{{route('admin-logout')}}"><i class="me-1 fa-solid fa-right-from-bracket"></i>Logout</a></li>
                    </ul>
                </nav>
        </div>
        <div class="off-canvas-footer">
            <img src="{{asset('/assets/images/cjs.png')}}" alt="">
        </div>
    </div>
    <!-- === -->
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