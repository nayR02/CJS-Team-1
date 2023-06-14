<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layout')
    @section('title', 'Categories')
    <link rel="stylesheet" href="{{asset('/assets/css/categories.css')}}">
</head>

<body>
    @section('header')
    @section('.canvas__')
    <main>
        <h1>marker</h1>
        @php
        $rounds = App\Models\Rounds::all();
        $eventConfigurations = App\Models\Configuration::all();
        @endphp

        @foreach ($rounds as $roundKey => $round)
        @isset($round)
        <section id="round-{{ $roundKey }}" class="round-data-parent">
            <div class="rounds-data">{{ $round->rounds }}</div>
            <button onclick="addCat('{{ $roundKey }}')" type="button">Add</button>
            <form class="second-form">
                <div class="categoryContainer" id="categoryContainer-{{ $roundKey }}">

                </div>
            </form>
        </section>
        <!-- || -->
        <script>
            function addCat(roundKey) {
                const inputContainer = document.getElementById('categoryContainer-' + roundKey);
                const newInput = document.createElement('input');
                newInput.type = 'text';
                inputContainer.appendChild(newInput);
            }
        </script>
        @endisset
        @endforeach

    </main>
    </section>
    @endsection
    @endsection
</body>

</html>