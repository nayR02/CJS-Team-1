<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layout')
    @section('title', 'Criterias')
    <link rel="stylesheet" href="{{asset('/assets/css/criteria.css')}}">

</head>

<body class="criteria__">
    @section('header')
    @section('.canvas__')
    <main>
        @php
        $rounds = App\Models\Rounds::all();
        $categories = App\Models\Categories::all();
        @endphp
        <section class="section-one">
            <h3>Add/Edit Criterias</h3>
            <button class="backbtn standard-btn">
                <a href="{{('/categories')}}"><i class="fa-solid fa-arrow-left"></i></a>
            </button>
            <form class="criForm" action="{{('criterias')}}" method="POST">
                @csrf
                <div class="criteriaContainer" id="criteriaContainer">
                    <div class="block-inp select-sec">
                        <select name="categories" id="categoryName">
                            <option selected disabled>Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cstm-box block-inp catName-sec">
                        <input type="text" id="criInputName" name="criteria_name" required>
                        <label for="criInputName">Criteria Name</label>
                    </div>
                    <div class="cstm-box block-inp catVal-sec">
                        <input type="number" id="criInputValue" name="criteria_value" required>
                        <label for="criInputValue">Percentage Value</label>
                    </div>
                    <div class="btn-parent"><button class="standard-btn" type="submit">Save</button></div>
                </div>
            </form>
        </section>
        <section class="second-section">
            
        </section>
    </main>
    @endsection
    @endsection
</body>

</html>