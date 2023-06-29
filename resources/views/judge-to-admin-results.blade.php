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
        <div style="z-index: 10; position: fixed; top: 20px; left: 20px; box-shadow: 0px 0px 5px rgb( 0 0 0 / 0.3); border-radius: inherit;" class="mt-2 ms-2"><button class="canvas-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-bars"></i></button></div>
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
        <section class="testgrid mt-5" id="score-table-container">
            <h3>Score Cards</h3>
            <!--  -->
            @php
            $candidateIds = [];
            $count = 1;
            @endphp

            @foreach ($scores as $score)
            @if (!in_array($score->candidate_id, $candidateIds))
            @php
            $candidateIds[] = $score->candidate_id;
            @endphp

            <!-- Close previous table if it exists -->
            @if ($loop->iteration > 1)
            </tbody>
            </table>
            </div>
            @endif

            <!-- Start new score card -->
            <div class="score-card">
                <h5 class="candidate-name">{{$candidates[$score->candidate_id]}}</h5>
                <hr>
                <table class="score-table">
                    @endif

                    @if ($loop->iteration == 1 || $score->categories_id != $scores[$loop->index - 1]->categories_id)
                    <!-- Display category name -->
                    <thead>
                        <tr>
                            <th class="category-name" colspan="2">{{$category[$score->categories_id]}}</th>
                        </tr>
                    </thead>
                    <tbody class="criteria-score-container">
                        @endif

                        <!-- Display criteria and score -->
                        <tr>
                            <td class="px-2">{{$criteria[$score->criteria_id]}}</td>
                            <td class="px-2">{{$score->score}}</td>
                        </tr>

                        @php
                        $count++;
                        @endphp
                        @endforeach

                        <!-- Close the last table if scores exist -->
                        @if (!empty($scores))
                    </tbody>
                </table>
            </div>
            @endif





            <!--  -->
        </section>
        <!-- --- -->
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>