@extends('layouts.app')

@section('no-header')
@endsection

@section('content')
<div class="min-h-screen flex items-center justify-center bg-light px-3">
    <div class="card shadow-sm w-100 p-5" style="max-width: 480px;">
          <div class="card-header bg-white px-5 text-center pb-5">
            <h4 class="mb-0">{{ __('Set New Password') }}</h4>
        </div>

        <div class="card-body px-5">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('otp.password.update') }}">
                @csrf

                <!-- Password Field -->
                <div class="form-group mb-3 position-relative">
                    <label for="password">{{ __('New Password') }}</label>
                    <input id="password"
                           type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password"
                           required
                           autocomplete="new-password">

                    <!-- Eye Toggle -->
                    <button type="button" id="togglePassword"
                        class="position-absolute top-20 end-0 translate-middle-y me-3 p-0"
                        style="border: none; background: transparent; cursor: pointer;">
                        <!-- Eye Open -->
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                            <path
                                d="M3 14C3 9.02944 7.02944 5 12 5C16.9706 5 21 9.02944 21 14M17 14C17 16.7614 14.7614 19 12 19C9.23858 19 7 16.7614 7 14C7 11.2386 9.23858 9 12 9C14.7614 9 17 11.2386 17 14Z" />
                        </svg>
                        <!-- Eye Closed -->
                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
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

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Save Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Eye Toggle Script -->
<script>
    const passwordInput = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");
    const eyeOpen = document.getElementById("eyeOpen");
    const eyeClosed = document.getElementById("eyeClosed");

    // Default state
    passwordInput.type = "password";
    eyeClosed.style.display = "inline";
    eyeOpen.style.display = "none";

    togglePassword.addEventListener("click", () => {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeOpen.style.display = "inline";
            eyeClosed.style.display = "none";
        } else {
            passwordInput.type = "password";
            eyeOpen.style.display = "none";
            eyeClosed.style.display = "inline";
        }
    });
</script>
@endsection
