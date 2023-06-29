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
        <button class="backbtn standard-btn">
            <a href="{{('/add_info')}}"><i class="fa-solid fa-arrow-left"></i></a>
        </button>
        <button class="criteriabtn standard-btn"><a href="{{('/criterias')}}">Modify/Add Criterias</a></button>
        @php
        $rounds = App\Models\Rounds::all();
        $eventConfigurations = App\Models\Configuration::all();
        $categories = App\Models\Categories::all();
        @endphp
        <h3>Add/Edit 
            Categories</h3>
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
            <form class="second-form" action="{{('categories')}}" method="POST" autocomplete="off">
                @csrf
                <div class="categoryContainer" id="categoryContainer">
                    <div class="block-inp select-sec">
                        <select name="rounds" id="rounds">
                            <option selected>Select Round</option>
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
                        <input type="number" id="catInputValue" name="category_value" min="1" max="100" required>
                        <label for="catInputValue">Percentage Value</label>
                    </div>
                    <div class="btn-parent"><button class="standard-btn" type="submit">Save</button></div>
                </div>
            </form>
        </section>
        <section class="data-table-down gap-1">
            @foreach ($rounds as $round)
            <table class="all_tables" style="white-space: nowrap;">
                <thead>
                    <tr>
                        <th colspan="4" class="th-round">{{ $round->rounds }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $count = 1;
                    @endphp
                    @foreach ($round->categories as $category)
                    <tr>
                        <td class="dialogue"><i>Category {{$count}}</i><span>Click Category Data to Update</span></td>
                        <td class="td-wtform">
                            <form class="edit-frm" action="{{ route('update.category', ['category_id' => $category->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" name="category_name" value="{{ $category->category_name }}">
                                <button type="submit"><i class="fa-solid fa-check-double"></i></button>
                            </form>
                        </td>
                        <td class="td-wtform">
                            <form class="edit-frm" action="{{ route('update.category', ['category_id' => $category->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="category_value" value="{{$category->category_value}}">
                                <button type="submit"><i class="fa-solid fa-check-double"></i></button>
                            </form>
                        </td>
                        <td class="d-flex align-items-center gap-1">
                            <a class="delete" href="{{ route('delete.category', ['category_id' => $category->id]) }}"><i style="color: rgb(255 0 0 / 0.7);" class="fa-solid fa-eraser"></i></a>
                        </td>
                    </tr>
                    @php
                    $count++;
                    @endphp
                    @endforeach
                </tbody>

            </table>
            @endforeach

        </section>
    </main>
    </section>
    @endsection
    @endsection
</body>

</html>