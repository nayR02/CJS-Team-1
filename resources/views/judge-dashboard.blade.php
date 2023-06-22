<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/assets/css/judge.css')}}">
    <title>Judge Dashboard</title>
</head>

<body>
    @php
    $judges = App\Models\judgemodel::all();
    $categories = App\Models\Categories::all();
    $rounds = App\Models\Rounds::all();
    $infoList = App\Models\configuration_model::all();
    $criterias = App\Models\Criteria::all();
    @endphp
    <main class="main-sec">
        <section class="box1">
            <figure class="imgcrd">
                <img class="logo" src="/assets/images/logomain.png" alt="">
            </figure>
            <figure class="judge-Name">
                <center><h3>Welcome, {{ $judge }}</h3></center>
            </figure>
            <nav class="rounds">
                <ul>
                    <li><a href="#">Rounds</a></li>
                    <li><a href="#">Results</a></li>
                </ul>
            </nav>

            <button class="logout"><a href="{{route('judge-logout')}}">Logout</a></button>
            <div class="footer">
                <hr>
                <p>Computerized Judging System</p>
            </div>
        </section>
        <section class="box2">
            @foreach ($rounds as $round)
            <figure class="table-fig">
                <h3 class="round-name">{{$round->rounds}}</h3>
                @php
                $count = 1;
                @endphp
                @foreach ($round->categories as $category)
                <div class="cat-name">
                    <span><i>Category {{$count}}</i></span>
                    <legend><strong>{{$category->category_name}} {{$category->category_value}}%</strong></legend>
                </div>
                <form action="{{route('save.scores')}}" method="POST">
                    @csrf
                    <table class="tevol">
                        <thead>
                            <tr>
                                <th>Candidate #</th>
                                <th>Candidate Name</th>
                                @foreach($category->criteria as $criteria)
                                <th>{{$criteria->criteria_name}} {{$criteria->criteria_value}}%</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($infoList as $getInfo)
                            <tr>
                                <td>{{$getInfo->candidate_number}}</td>
                                <td>{{$getInfo->candidate_name}}</td>
                                @foreach ($category->criteria as $criteria)
                                <td><input type="number" name="score[{{ $getInfo->candidate_number }}][{{ $criteria->id }}]"></td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @php
                    $count++;
                    @endphp
                    @endforeach
                    <div class="tbl-btn">
                        <button type="submit" >Submit</button>
                    </div>
                </form>
            </figure>
            @endforeach
        </section>
    </main>
</body>

</html>