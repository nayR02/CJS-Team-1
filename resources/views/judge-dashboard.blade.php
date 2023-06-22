<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/assets/css/judge.css')}}">
    <title>Judge</title>
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
            <h3>{{$round->rounds}}</h3>
            <form action="">
                <table class="tevol">
                    <thead>
                        <tr>
                            <th>Candidate #</th>
                            <th>Candidate Name</th>
                            @foreach ($round->categories as $category)
                            <th>{{$category->category_name}} {{$category->category_value}}%</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($infoList as $getInfo)
                        <tr>
                            <td>{{$getInfo->candidate_number}}</td>
                            <td>{{$getInfo->candidate_name}}</td>
                            @foreach ($round->categories as $category)
                            <td><input type="text"></td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button>submit</button>
            </form>
            @endforeach
        </section>
    </main>
</body>

</html>