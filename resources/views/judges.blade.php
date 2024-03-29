<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layout')
    @section('title', 'Admin Configuration || Events')
    <link rel="stylesheet" href="{{ asset('/assets/css/judges.css') }}">
</head>

<body class="__add-jdg">
    @section('.canvas__')
    <section class="judge-main">
        <div class="d-flex justify-content-start">
            <button class="canvas-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-bars"></i></button>
        </div>
        <form action="{{ route('judge.generate') }}" method="POST" autocomplete="off">
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
                    <td>{{ $counter }}</td>
                    <td>{{ $judge->judge_name }}</td>
                    <td>{{ $judge->username }}</td>
                    <td class="hide">{{ $judge->password }}</td>
                    <td>
                        <button class="btn btn-danger" onclick="deleteJudge()">Delete</button>
                    </td>
                    <script>
                        function deleteJudge() {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 800,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Judge Data Deleted'
                            })

                            setTimeout(function() {
                                window.location.href = "{{route('delete_judge',['id' => $judge->id])}}";
                            }, 900);
                        }
                    </script>
                </tr>
                @php
                $counter++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </section>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>