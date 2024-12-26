@extends('layouts.app')

    <style>
        #navbar{
            font-weight: bold;
            padding-top: 15px;
            background-color: #066170;
            width: 1280px;
            height: 80px;
            padding-bottom: 30px;
            position: fixed;
            top: 0;
            z-index: 999;
        }

        .navbar-brand{
            margin-top: 10px;
        }

        .nav-link, .lien-nav{
            margin-top: 5px;
            color: #FF5733;
            font-size: 15px;
            font-family: "Arial Black";
        }

        .btn.btn{
            background-color: #FF5733;
            color: #FFFFFF;
            font-weight: bold;
        }

        .btn.btn:hover{
            background-color: #FF5733;
            color: #066170;
            font-weight: bold;
        }

        .card-header:first-child{
            background-color: #066170;
            color: #FF5733;
            font-weight: bold;
            border-width: 3px;
        }

        .card:first-child{
            margin-top: 150px;
            border-width: 3px;
            border-radius: 10px;
            border-color: #066170;
        }

    </style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
