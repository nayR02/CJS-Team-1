<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layout')
    @section('title', 'Admin Configuration || Events')
    <link rel="stylesheet" href="{{asset('/assets/css/judges.css')}}">

</head>

<body class="__add-jdg">
    @section('header')
    @section('.canvas__')
    <section>
        @if (session('message'))
        <div id="flashMessage" class="alert alert-danger">
            {{ session('message') }}
        </div>
        <script>
            const flashMessage = document.getElementById('flashMessage');

            setTimeout(() => {
                flashMessage.style.display = 'none';
            }, 1500);
        </script>
        @endif

        <form action="{{route('judge.generate') }}" method="POST">
            @csrf
            <div class="boxinput-parent">
                <div class="boxinput">
                    <input type="text" name="judge_name" id="judgeName" required>
                    <label for="judgeName">Judge's Name</label>
                </div>
                <div>
                    <button type="submit" class="standard-btn">Add</button>
                </div>
            </div>
        </form>
        <table class="all_tables">
            <thead>
                <tr>
                    <td>Judge Number</td>
                    <td>Judge's Name</td>
                    <td>Username</td>
                    <td class="lock" @click="changeClass">
                        Password <i :class="className"></i>
                    </td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @php
                $counter = 1;
                @endphp
                @foreach($judges as $judge)
                <tr>
                    <td>{{$counter}}</td>
                    <td>{{$judge->judge_name}}</td>
                    <td>{{$judge->username}}</td>
                    <td class="hide">{{$judge->password}}</td>
                    <td>
                        <a href="{{route('delete_judge',['id' => $judge->id])}}"><button class="btn btn-danger">Delete</button></a>
                    </td>
                </tr>
                @php
                $counter++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </section>
    @endsection
    @endsection
    <script src="https://unpkg.com/vue@3"></script>
    <script>
        Vue.createApp({
            data() {
                return {
                    className: 'fa-solid fa-lock'
                };
            },
            methods: {
                changeClass() {
                    if (this.className === 'fa-solid fa-lock') {
                        this.className = 'fa-solid fa-lock-open';
                    } else {
                        this.className = 'fa-solid fa-lock';
                    }
                }
            }
        }).mount('.all_tables');
    </script>
</body>

</html>