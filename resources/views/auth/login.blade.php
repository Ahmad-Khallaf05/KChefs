@extends('layouts.home')

@section('content')

<style>
    *,
    *:before,
    *:after {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #080710;
    }

    .background {
        width: 430px;
        height: 520px;
        position: absolute;
        transform: translate(-50%, -50%);
        left: 50%;
        top: 50%;
    }

    .background .shape {
        height: 200px;
        width: 200px;
        position: absolute;
        border-radius: 50%;
    }

    .shape:first-child {
        background: linear-gradient(#1845ad,
                #23a2f6);
        left: -80px;
        top: -80px;
    }

    .shape:last-child {
        background: linear-gradient(to right,
                #ff512f,
                #f09819);
        right: -30px;
        bottom: -80px;
    }

    form {
        height: 520px;
        width: 400px;
        background-color: rgba(255, 255, 255, 0.13);
        position: absolute;
        transform: translate(-50%, -50%);
        top: 900%;
        left: 50%;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
        padding: 50px 35px;
    }

    form * {
        font-family: 'Poppins', sans-serif;
        color: #ffffff;
        letter-spacing: 0.5px;
        outline: none;
        border: none;
    }

    form h3 {
        font-size: 32px;
        font-weight: 500;
        line-height: 42px;
        text-align: center;
    }

    label {
        display: block;
        margin-top: 30px;
        font-size: 16px;
        font-weight: 500;
    }

    input {
        display: block;
        height: 50px;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.07);
        border-radius: 3px;
        padding: 0 10px;
        margin-top: 8px;
        font-size: 14px;
        font-weight: 300;
    }

    ::placeholder {
        color: #e5e5e5;
    }

    button {
        margin-top: 50px;
        width: 100%;
        background-color: #ffffff;
        color: #080710;
        padding: 15px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }

    .social {
        margin-top: 30px;
        display: flex;
    }

    .social div {
        background: red;
        width: 150px;
        border-radius: 3px;
        padding: 5px 10px 10px 5px;
        background-color: rgba(255, 255, 255, 0.27);
        color: #eaf0fb;
        text-align: center;
    }

    .social div:hover {
        background-color: rgba(255, 255, 255, 0.47);
    }

    .social .fb {
        margin-left: 25px;
    }

    .social i {
        margin-right: 4px;
    }
</style>

<br>
<br>
<br>
<div class="container mt-5 mb-5" style="background-image: url('{{ asset('./assets/home/img/hero-bg.jpg') }}'); 
           background-size: cover; 
           background-position: center; 
           min-height: 100vh; 
           padding: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg" style="border-radius: 10px; 
                        background-color: rgba(255, 255, 255, 0.9);">
                <div class="card-body" style="position: relative;">
                    <form method="POST" action="{{ route('login') }}" style="height: auto; 
                                 width: 100%; 
                                 background-color: rgba(255, 255, 255, 0.13); 
                                 backdrop-filter: blur(10px); 
                                 padding: 20px; 
                                 border-radius: 10px;">
                        @csrf
                        <h3 class="text-center" style="color: white;">Login Here</h3>

                        <label for="email" style="color: white;">Email</label>
                        <input id="email" type="text" name="email" class="form-control" placeholder="Email or Phone"
                            required style="background-color: rgba(255, 255, 255, 0.07); 
                                      color: white; 
                                      border: none; 
                                      margin-bottom: 20px;">

                        <label for="password" style="color: white;">Password</label>
                        <input id="password" type="password" name="password" class="form-control" placeholder="Password"
                            required style="background-color: rgba(255, 255, 255, 0.07); 
                                      color: white; 
                                      border: none; 
                                      margin-bottom: 20px;">

                        <button type="submit" class="btn btn-block" style="background-color: #ffffff; 
                                       color: #080710; 
                                       font-weight: bold; 
                                       border-radius: 5px;">
                            Log In
                        </button>

                        <div class="social mt-4">
                            <a href="{{ url('/auth/google') }}" class="btn btn-light w-50 me-2" style="background-color: rgba(255,255,255,0.27); 
                                      color: #eaf0fb; 
                                      border: none;">
                                <i class="fab fa-google"></i>Login with Google
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-light w-50" style="background-color: rgba(255,255,255,0.27); 
                                      color: #eaf0fb; 
                                      border: none;">
                                <i class="fab fa-facebook"></i> Register
                            </a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection