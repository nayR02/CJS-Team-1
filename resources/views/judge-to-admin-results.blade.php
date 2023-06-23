<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @php
    $judges = App\Models\judgemodel::all();
    $categories = App\Models\Categories::all();
    $rounds = App\Models\Rounds::all();
    $infoList = App\Models\configuration_model::all();
    $criterias = App\Models\Criteria::all();
    $scores = App\Models\Scoring::all();
    @endphp


    <button><a href="{{'/add_info'}}">back</a></button>
    <table>
        <thead>
            <tr>
                <th>Candidate Name</th>
                <th>Criteria Name</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores as $score)
            <tr>
                <td>{{$candidates[$score->candidate_id]}}</td>
                <td>{{$criteria[$score->criteria_id]}}</td>
                <td>{{$score->score}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>