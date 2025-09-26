<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bankero and Fishermen Association</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Bankero and Fishermen Association">
    <meta name="author" content="p-themes">
    @vite('resources/css/app.css')
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('new-assets/images/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('new-assets/images/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('new-assets/images/icons/favicon-16x16.png') }}">
    <!-- FIXED: use a proper manifest if available (not site.html) -->
    <link rel="manifest" href="{{ asset('new-assets/images/icons/manifest.json') }}">
    <link rel="mask-icon" href="{{ asset('new-assets/images/icons/safari-pinned-tab.svg') }}" color="#666666">
    <link rel="shortcut icon" href="{{ asset('new-assets/images/icons/favicon.ico') }}">
    <meta name="apple-mobile-web-app-title" content="Bankero and Fishermen Association">
    <meta name="application-name" content="Bankero and Fishermen Association">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{ asset('new-assets/images/icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Vendor CSS -->
    <link rel="stylesheet"
        href="{{ asset('new-assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css') }}">
    <link rel= "stylesheet"
        href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('new-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new-assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('new-assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('new-assets/css/plugins/jquery.countdown.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('new-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('new-assets/css/skins/skin-demo-6.css') }}">
    <link rel="stylesheet" href="{{ asset('new-assets/css/demos/demo-6.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.css" rel="stylesheet">

</head>
<body>

    @if (!View::hasSection('no-header'))
        @include('layouts.header')
    @endif
    <div class="page-wrapper">

        {{-- main --}}
    @yield('content')
        {{-- end main --}}
    @if (!View::hasSection('no-footer'))
            @include('layouts.footer')
    @endif

    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay "></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container ">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search"
                    placeholder="Search in..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li class="{{ request()->routeIs('home.index') ? 'active' : '' }}">
                        <a href="{{ route('home.index') }}" class="navigation__link">Home</a>
                    </li>
                    <li class="{{ request()->routeIs('shop.index') ? 'active' : '' }}">
                        <a href="{{ route('shop.index') }}" class="navigation__link">Shop</a>
                    </li>
                    <li class="{{ request()->routeIs('cart.index') ? 'active' : '' }}">
                        <a href="{{ route('cart.index') }}" class="navigation__link">Cart</a>
                    </li>
                    <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                        <a href="{{ route('about') }}" class="navigation__link">About</a>
                    </li>
                    <li class="{{ request()->routeIs('home.contact') ? 'active' : '' }}">
                        <a href="{{ route('home.contact') }}" class="navigation__link">Contact</a>
                    </li>


                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i
                        class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i
                        class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i
                        class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i
                        class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    <!-- Sign In / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin"
                                        role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register"
                                        role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <!-- Sign In Tab -->
                                <div class="tab-pane fade show active " id="signin" role="tabpanel"
                                    aria-labelledby="signin-tab">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label for="signin-email">Email </label>
                                            <input type="email"
                                                class="form-control form-control_gray @error('email') is-invalid @enderror"
                                                id="signin-email" name="email" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Sign In Password -->
                                        <div class="form-group relative">
                                            <label for="signin-password">Password</label>
                                            <input type="password"
                                                class="form-control form-control_gray @error('password') is-invalid @enderror pr-10 password-input"
                                                id="signin-password" name="password" required>

                                            <!-- Eye Toggle -->
                                            <span
                                                class="toggle-password absolute right-6 top-24 -translate-y-1/2 cursor-pointer text-gray-500">
                                                <!-- Eye Open -->
                                                <svg class="eye-open hidden" xmlns="http://www.w3.org/2000/svg"
                                                    width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path
                                                        d="M3 14C3 9.02944 7.02944 5 12 5C16.9706 5 21 9.02944 21 14M17 14C17 16.7614 14.7614 19 12 19C9.23858 19 7 16.7614 7 14C7 11.2386 9.23858 9 12 9C14.7614 9 17 11.2386 17 14Z" />
                                                </svg>
                                                <!-- Eye Closed -->
                                                <svg class="eye-closed" xmlns="http://www.w3.org/2000/svg"
                                                    width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path
                                                        d="M9.61 9.61C8.05 10.45 7 12.1 7 14C7 16.76 9.24 19 12 19C13.9 19 15.55 17.94 16.39 16.39M21 14C21 9.03 16.97 5 12 5C11.56 5 11.12 5.03 10.70 5.09M3 14C3 11 4.46 8.36 6.71 6.72M3 3L21 21" />
                                                </svg>
                                            </span>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input "
                                                    id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember
                                                    Me</label>
                                            </div><!-- End .custom-checkbox -->

                                            <a href="{{ route('otp.password.request') }}" class="forgot-link">Forgot
                                                Your Password?</a>
                                        </div>
                                    </form>
                                    {{-- third party app --}}
                                    {{-- <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div> --}}
                                </div>

                                <!-- Register Tab -->
                                <div class="tab-pane fade" id="register" role="tabpanel"
                                    aria-labelledby="register-tab">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label id="email" value="{{ old('email') }}"
                                                for="register-email">Email </label>
                                            <input type="email" class="form-control form-control_gray @error('email') is-invalid @enderror" name="email"placeholder=""
                                                required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group relative">
                                            <label for="register-password">Password</label>
                                            <input type="password" class="form-control form-control_gray @error('password') is-invalid @enderror pr-10 password-input"
                                                id="register-password" name="password" required>
                                            <!-- Eye Toggle -->
                                            <span
                                                class="toggle-password absolute right-6 top-24 -translate-y-1/2 cursor-pointer text-gray-500">
                                                <!-- Eye Open -->
                                                <svg class="eye-open hidden" xmlns="http://www.w3.org/2000/svg"
                                                    width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path
                                                        d="M3 14C3 9.02944 7.02944 5 12 5C16.9706 5 21 9.02944 21 14M17 14C17 16.7614 14.7614 19 12 19C9.23858 19 7 16.7614 7 14C7 11.2386 9.23858 9 12 9C14.7614 9 17 11.2386 17 14Z" />
                                                </svg>
                                                <!-- Eye Closed -->
                                                <svg class="eye-closed" xmlns="http://www.w3.org/2000/svg"
                                                    width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path
                                                        d="M9.61 9.61C8.05 10.45 7 12.1 7 14C7 16.76 9.24 19 12 19C13.9 19 15.55 17.94 16.39 16.39M21 14C21 9.03 16.97 5 12 5C11.56 5 11.12 5.03 10.70 5.09M3 14C3 11 4.46 8.36 6.71 6.72M3 3L21 21" />
                                                </svg>
                                            </span>
                                            @error('password')
                                                <span class="invalid-feedback " role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I agree to
                                                    the <a href="#">privacy policy</a> *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div>
                                        {{-- third party app --}}
                                        {{-- <div class="form-choice">
                                            <p class="text-center">or Register with</p>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="#" class="btn btn-login btn-g">
                                                        <i class="icon-google"></i>
                                                        Login With Google
                                                    </a>
                                                </div><!-- End .col-6 -->
                                                <div class="col-sm-6">
                                                    <a href="#" class="btn btn-login  btn-f">
                                                        <i class="icon-facebook-f"></i>
                                                        Login With Facebook
                                                    </a>
                                                </div><!-- End .col-6 -->
                                            </div><!-- End .row -->
                                        </div> --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div>

    {{-- @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var modal = new bootstrap.Modal(document.getElementById('signin-modal'));
                modal.show();
            });
        </script>
    @endif --}}


    {{-- eye toggle --}}
    <script>
        document.querySelectorAll(".toggle-password").forEach(toggle => {
            toggle.addEventListener("click", () => {
                const input = toggle.parentElement.querySelector(".password-input");
                const eyeOpen = toggle.querySelector(".eye-open");
                const eyeClosed = toggle.querySelector(".eye-closed");

                const isPassword = input.getAttribute("type") === "password";
                input.setAttribute("type", isPassword ? "text" : "password");

                eyeOpen.classList.toggle("hidden", !isPassword);
                eyeClosed.classList.toggle("hidden", isPassword);
            });
        });
    </script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    <!-- Plugins JS File -->
    <script src="{{ asset('new-assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('new-assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('new-assets/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('new-assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('new-assets/js/superfish.min.js') }}"></script>
    <script src="{{ asset('new-assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('new-assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('new-assets/js/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('new-assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('new-assets/js/jquery.countdown.min.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('new-assets/js/main.js') }}"></script>
    <script src="{{ asset('new-assets/js/demos/demo-6.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.js"></script>

</body>
</html>
