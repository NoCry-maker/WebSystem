{{-- @extends('layouts.app')
@section('no-header')
@endsection
@section('content')
    <div class="container py-36">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <section class="login-register container">
                    <div class="card">
                        <div class="card-header">{{ __('Account Recovery') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('otp.password.email') }}">
                                @csrf


                                <div class="form-floating my-7">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus=""
                                        placeholder="">
                                    <label for="email">{{ __('Email Address') }}</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Next') }}
                                </button>

                            </form>
                        </div>
                    </div>
                         </section>
                    </div>

            </div>
        </div>
    </div>
@endsection --}}
@extends('layouts.app')

@section('no-header')
@endsection

@section('content')
<div class="min-h-screen flex items-center justify-center bg-light px-3 ">
    <div class="card shadow-sm w-100 p-10 " style="max-width: 480px;">
        <!-- Header -->
        <div class="card-header bg-white px-5 text-center">
            <h4 class="mb-0">{{ __('Account Recovery') }}</h4>
            <small class="text-muted">Enter your email to recover your account</small>
        </div>

        <!-- Body -->
        <div class="card-body p-5">
            @if (session('status'))
                <div class="alert alert-success mb-3" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('otp.password.email') }}">
                @csrf

                <!-- Email field -->
                <div class="form-group mb-3 ">
                    <label for="recovery-email">{{ __('Email Address') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        id="recovery-email" name="email" value="{{ old('email') }}" required autofocus>

                    @error('email')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Submit button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Next') }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="card-footer bg-white text-center">
            <small class="text-muted">
                Remembered your password?
                <a href="{{ route('home.index') }}" class="text-primary">
                    {{ __('Sign in') }}
                </a>
            </small>
        </div>
    </div>
</div>
@endsection
