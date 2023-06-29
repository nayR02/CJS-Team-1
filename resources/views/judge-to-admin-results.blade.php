<!DOCTYPE html>
<html lang="en">

<head>
    @extends ('layout')
    @section('title', 'Results')
</head>

<body class="results-body">
    @php
    $judges = App\Models\judgemodel::all();
    $categories = App\Models\Categories::all();
    $rounds = App\Models\Rounds::all();
    $infoList = App\Models\configuration_model::all();
    $criterias = App\Models\Criteria::all();
    $scores = App\Models\Scoring::all();
    @endphp
    <main class="results-main">
        <!-- === -->
        <div style="z-index: 10; position: fixed; top: 20px; left: 20px;" class="mt-2 ms-2"><button class="canvas-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-bars"></i></button></div>
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header d-flex justify-content-center gap-2 flex-column" style="position: relative;">
                <img src="{{asset('/assets/images/logomain.png')}}" alt="">
                <span class="offcanvas-title">
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
                        <li class="active"><a href="{{('/judge-to-admin-results')}}"><i class="me-1 fa-solid fa-square-poll-vertical"></i>Results</a></li>
                        <li class="exception"><a href="#" class="dropdown-item" onclick="confirmLogout()"><i class="me-1 fa-solid fa-right-from-bracket"></i>Logout</a></li>
                    </ul>
                </nav>
            </div>
            <div class="off-canvas-footer">
                <img src="{{asset('/assets/images/cjs.png')}}" alt="">
            </div>
        </div>
        <!-- === -->
        <section class="testgrid mt-5" id="scores-container">
            @foreach ($scores as $score)
            <div class="card mb-2">
                <table class="col">
                    <thead>
                        <tr>
                            <th>{{$criteria[$score->criteria_id]}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$candidates[$score->candidate_id]}}</td>
                            <td>{{$score->score}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endforeach
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>