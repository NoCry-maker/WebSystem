@extends('layouts.app')

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
@endsection
