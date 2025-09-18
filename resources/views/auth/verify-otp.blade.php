@extends('layouts.app')
@section('content')
    <div class="py-20 min-w-lg min-w-48 mx-auto text-center bg-white px-4 sm:px-8 rounded-xl shadow mt-5">
        <header class="mb-8">
            <h1 class="text-2xl font-bold mb-1">Enter Verification Code</h1>
        </header>
        @error('otp')
            <span class="text-danger d-block text-center mb-2">{{ $message }}</span>
        @enderror
        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf

            {{-- OTP input boxes --}}
            <div class="d-flex justify-content-center gap-3 mb-4" id="otp-inputs">
                @for ($i = 0; $i < 6; $i++)
                    <input type="text" name="otp_digit[]" maxlength="1" inputmode="numeric"
                        class="form-control text-center fw-bold fs-4 otp-box"
                        style="width: 50px; height: 60px; border: 2px solid #ced4da; border-radius: 8px;" required />
                @endfor
            </div>

            <div class="text-center ">
                <button type="submit"
                    class="px-4 py-2 mb-2 rounded-md bg-indigo-600 text-white  min-w-96">{{ __('Next') }}</button>
            </div>
        </form>
        <div class="text-sm text-slate-500 mb-4">
            <span id="countdown">Please wait 60s to resend</span>
            <form id="resend-form" method="POST" action="{{ route('otp.resend.register') }}">
                @csrf
                <button id="resend-btn" type="submit" class="font-medium text-indigo-500 hover:text-indigo-600 d-none">
                    Resend code
                </button>
            </form>
        </div>
    </div>

    <style>
        #otp-inputs .otp-box:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, .25);
            outline: none;
        }
    </style>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // === OTP input handling ===
                const inputs = document.querySelectorAll('.otp-box');
                inputs.forEach((input, index) => {
                    input.addEventListener('input', (e) => {
                        const value = input.value.replace(/\D/g, '');
                        input.value = value.charAt(0);
                        if (value && index < inputs.length - 1) inputs[index + 1].focus();
                    });
                    input.addEventListener('keydown', (e) => {
                        if (e.key === 'Backspace' && input.value === '' && index > 0) inputs[index - 1]
                            .focus();
                        else if (e.key === 'ArrowLeft' && index > 0) inputs[index - 1].focus();
                        else if (e.key === 'ArrowRight' && index < inputs.length - 1) inputs[index + 1]
                            .focus();
                    });
                    input.addEventListener('focus', () => input.select());
                    input.addEventListener('paste', (e) => {
                        e.preventDefault();
                        const paste = (e.clipboardData || window.clipboardData).getData('text').trim();
                        if (/^\d{6}$/.test(paste)) {
                            for (let i = 0; i < inputs.length; i++) inputs[i].value = paste[i] || '';
                            inputs[inputs.length - 1].focus();
                        } else alert('Invalid OTP format. Please paste a 6-digit number only.');
                    });
                });

                // Resend code
                const countdownEl = document.getElementById('countdown');
                const resendBtn = document.getElementById('resend-btn');
                const resendForm = document.getElementById('resend-form');

                let countdownInterval;

                // Load saved end time from localStorage
                let endTime = localStorage.getItem('otpCountdownEnd');
                if (endTime) {
                    endTime = parseInt(endTime, 10);
                }

                function startCountdown() {
                    clearInterval(countdownInterval);

                    countdownInterval = setInterval(() => {
                        const remaining = Math.floor((endTime - Date.now()) / 1000);

                        if (remaining > 0) {
                            countdownEl.textContent = `Please wait ${remaining} seconds to resend`;
                            countdownEl.style.display = 'inline';
                            resendBtn.classList.add('d-none'); // hide button
                        } else {
                            clearInterval(countdownInterval);
                            countdownEl.style.display = 'none';
                            resendBtn.classList.remove('d-none'); // show button
                            localStorage.removeItem('otpCountdownEnd');
                        }
                    }, 1000);
                }

                // Decide what to do on page load
                if (endTime && Date.now() < endTime) {
                    // countdown still active
                    startCountdown();
                } else {
                    // countdown expired or never set → show resend button immediately
                    resendBtn.classList.remove('d-none');
                    countdownEl.style.display = 'none';
                    localStorage.removeItem('otpCountdownEnd');
                }

                // Handle resend button click
                resendForm.addEventListener('submit', function() {
                    // Reset countdown to 60s only when clicking resend
                    endTime = Date.now() + 60 * 1000;
                    localStorage.setItem('otpCountdownEnd', endTime);

                    startCountdown();
                    // Form submits normally → Laravel resends the same OTP
                });

               //   When OTP is verified correctly (trigger this in controller response)
window.addEventListener('otpVerified', function () {
    localStorage.removeItem('otpCountdownEnd');
    clearInterval(countdownInterval);
    countdownEl.style.display = 'none';
    resendBtn.classList.remove('d-none');
});

            });
        </script>
    @endpush
@endsection
