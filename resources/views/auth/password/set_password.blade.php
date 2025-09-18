@extends('layouts.app')

@section('no-header')
@endsection
@section('content')
    <div class="container py-36">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <section class="login-register container">
                    <div class="card">

                        <div class="card-header">{{ __('Set New Password') }}</div>

                        <div class="card-body">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('otp.password.update') }}">
                                @csrf

                                <div class="form-floating my-4 position-relative ">
                                    <input id="password" type="password"
                                        class="form-control form-control_gray @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password" placeholder="">
                                    <label for="password">{{ __('New Password') }}</label>

                                    {{--  Eye Toggle  --}}
                                    <button type="button" id="togglePassword"
                                        class="position-absolute top-50 end-0 translate-middle-y me-3 p-0"
                                        style="border: none; background: transparent; cursor: pointer; text-decoration: none;">

                                        {{--  Eye Open (hidden initially)  --}}
                                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M3 14C3 9.02944 7.02944 5 12 5C16.9706 5 21 9.02944 21 14M17 14C17 16.7614 14.7614 19 12 19C9.23858 19 7 16.7614 7 14C7 11.2386 9.23858 9 12 9C14.7614 9 17 11.2386 17 14Z" />
                                        </svg>
                                        {{--  Eye Closed (default visible)  --}}
                                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                                            <path
                                                d="M9.60997 9.60714C8.05503 10.4549 7 12.1043 7 14C7 16.7614 9.23858 19 12 19C13.8966 19 15.5466 17.944 16.3941 16.3878M21 14C21 9.02944 16.9706 5 12 5C11.5582 5 11.1238 5.03184 10.699 5.09334M3 14C3 11.0069 4.46104 8.35513 6.70883 6.71886M3 3L21 21" />
                                        </svg>
                                    </button>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <script>
                                    const passwordInput = document.getElementById("password");
                                    const togglePassword = document.getElementById("togglePassword");
                                    const eyeOpen = document.getElementById("eyeOpen");
                                    const eyeClosed = document.getElementById("eyeClosed");

                                    // Default state: password hidden, eyeClosed visible
                                    passwordInput.type = "password";
                                    eyeClosed.style.display = "inline";
                                    eyeOpen.style.display = "none";

                                    togglePassword.addEventListener("click", () => {
                                        if (passwordInput.type === "password") {
                                            // Show password
                                            passwordInput.type = "text";
                                            eyeOpen.style.display = "inline";
                                            eyeClosed.style.display = "none";
                                        } else {
                                            // Hide password
                                            passwordInput.type = "password";
                                            eyeOpen.style.display = "none";
                                            eyeClosed.style.display = "inline";
                                        }
                                    });
                                </script>




                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Save Password') }}
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
