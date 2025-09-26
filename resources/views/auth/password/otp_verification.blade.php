@extends('layouts.app')
@section('no-header')
@endsection
@section('content')
    <div class="text-center bg-white px-8 sm:px-16 py-8 rounded-2xl  mt-10 mx-auto">

        <header class="mb-8">
            <h1 class="text-3xl font-bold mb-1">Enter Verification Code</h1>
        </header>

        @if (session('status'))
            <div class="mb-2 text-green-600 font-medium">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->has('otp'))
            <div class="mb-2 text-red-600 font-medium">
                {{ $errors->first('otp') }}
            </div>
        @endif

        <form method="POST" action="{{ route('otp.verify.submit') }}">
            @csrf
            <div class="flex items-center justify-center gap-3 mb-4" id="otp-inputs">
                @for ($i = 0; $i < 6; $i++)
                    <input type="text" name="otp_digit[]" maxlength="1" inputmode="numeric"
                        class="form-control text-center fw-bold fs-4 otp-box"
                        style="width: 60px; height: 70px; border: 2px solid #ced4da;  border-radius: 12px;
                   font-size: 2.2rem; font-weight: 600; color: #111827; letter-spacing: 1px;"
                        required />
                @endfor
            </div>
            <div class="text-center">
                <button type="submit" class="px-4 py-3 mb-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 w-[400px]">
                    {{ __('Next') }}
                </button>
            </div>
        </form>

        {{-- Countdown + resend --}}
        <div class="text-md text-slate-500 mb-4">
            <span id="countdown" @if ($remaining <= 0) style="display:none;" @endif>
                Please wait {{ $remaining }} seconds to resend
            </span>
            <form id="resend-form" method="POST" action="{{ route('otp.resend') }}">
                @csrf
                <button id="resend-btn" type="submit"
                    class="font-medium text-indigo-500 hover:text-blue-600 @if ($remaining > 0) d-none @endif">
                    Resend code
                </button>
            </form>
        </div>
    </div>
@endsection

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

            // === Countdown handling ===
            let remaining = {{ $remaining }};
            const countdownEl = document.getElementById('countdown');
            const resendBtn = document.getElementById('resend-btn');

            if (remaining > 0) {
                const interval = setInterval(() => {
                    remaining--;
                    if (remaining > 0) {
                        countdownEl.textContent = `Please wait ${remaining} seconds to resend`;
                    } else {
                        clearInterval(interval);
                        countdownEl.style.display = 'none';
                        resendBtn.classList.remove('d-none');
                    }
                }, 1000);
            }
        });
    </script>
@endpush
