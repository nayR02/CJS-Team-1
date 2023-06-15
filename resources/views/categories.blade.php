<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layout')
    @section('title', 'Categories')
    <link rel="stylesheet" href="{{asset('/assets/css/categories.css')}}">
</head>

<body class="categories__">
    @section('header')
    @section('.canvas__')
    <main>
        @php
        $rounds = App\Models\Rounds::all();
        $eventConfigurations = App\Models\Configuration::all();
        @endphp
        @foreach($eventConfigurations as $key => $eventConfiguration)
        <h1>{{$eventConfiguration->event_name}}</h1>
        @endforeach
        @if (session('success'))
        <div id="eventAddedMsg" class="event-alert alert alert-success">
            {{ session('success') }} <i class="fa-solid fa-circle-check"></i>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('eventAddedMsg').style.display = 'none';
            }, 2000);
        </script>
        @endif
        <section class="round-data-parent">
            <form class="second-form" action="{{route('save.category')}}" method="POST">
                @csrf
                <div class="categoryContainer" id="categoryContainer">
                    <div class="block-inp select-sec">
                        <label for="rounds">Rounds</label>
                        <select name="rounds" id="rounds">
                            <option selected>Choose Round</option>
                            @foreach ($rounds as $roundKey => $round)
                            @isset($round)
                            <option value="{{$round->id}}">{{$round->rounds}}</option>
                            @endisset
                            @endforeach
                        </select>
                    </div>
                    <div class="cstm-box block-inp catName-sec">
                        <input type="text" id="catInputName" name="category_name" required>
                        <label for="catInputName">Category Name</label>
                    </div>
                    <div class="cstm-box block-inp catVal-sec">
                        <input type="number" id="catInputValue" name="category_value" required>
                        <label for="catInputValue">Percentage Value</label>
                    </div>
                    <div class="btn-parent"><button class="standard-btn" type="submit">Save</button></div>
                </div>
            </form>
            <section>
                
            </section>
        </section>
    </main>
    </section>
    @endsection
    @endsection
</body>

</html>