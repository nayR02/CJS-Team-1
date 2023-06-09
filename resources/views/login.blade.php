<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/storage/css/login.css">
    @extends('layout')
    @section('title', 'Login')
</head>

<body class="__login_page">
    <section class="first-sec d-flex justify-content-center align-items-center">
        <!-- <div class="child1">
            <h1 class="title">Computerized <br> Judging System</h1>
            <img src="/storage/images/missQ.png" alt="">
        </div> -->
        <form action="{{('/login')}}" method="POST">
            @csrf
            <div class="inputbox">
                <span><i class="fa-solid fa-user"></i></span>
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="inputbox">
                <span><i class="fa-solid fa-key"></i></span>
                <input :type="inputType" name="password" required>
                <label>Password</label>
                <span @click="changeClass(); toggleInputType()">
                    <i :class="className"></i>
                </span>
            </div>
            <div class="btn-parent">
                <button class="login-btn" type="submit">Login</button>
            </div>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script>
        Vue.createApp({
            data() {
                return {
                    className: 'fa-solid fa-eye',
                    inputType: 'password'
                };
            },
            methods: {
                changeClass() {
                    this.className = this.className === 'fa-solid fa-eye' ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye';
                },
                toggleInputType() {
                    this.inputType = this.inputType === 'text' ? 'password' : 'text';
                }
            }
        }).mount('.first-sec');
    </script>
</body>

</html>