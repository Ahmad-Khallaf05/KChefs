@extends('layouts.home')

@section('content')
<br>
<br>
<br>
<div class="container mt-5 mb-5" style="background-image: url('{{ asset('./assets/home/img/hero-bg.jpg') }}'); background-size: cover; background-position: center; min-height: 100vh; padding: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg" style="border-radius: 10px; background-color: rgba(255, 255, 255, 0.9);">
                <div class="card-header text-center" style="background-color: #343a40; color: white; border-radius: 10px 10px 0 0;">
                    <h4>{{ __('Register') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="username" class="form-label">{{ __('Username') }}</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus style="border: 1px solid #ced4da; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="border: 1px solid #ced4da; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">{{ __('First Name') }}</label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" style="border: 1px solid #ced4da; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" style="border: 1px solid #ced4da; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="border: 1px solid #ced4da; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="border: 1px solid #ced4da; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="role" class="form-label">{{ __('Role') }}</label>
                                <select id="role" class="form-select @error('role') is-invalid @enderror" name="role" required style="border: 1px solid #ced4da; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                    <option value="user" selected>{{ __('User') }}</option>
                                    <option value="chef">{{ __('Chef') }}</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn" style="background-color: #f9b133; color: white; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
