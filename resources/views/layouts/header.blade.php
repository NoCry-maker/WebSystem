            <header class="header header-6 ">
                <div class="header-top ">
                    <div class="container">
                        <div class="header-left">
                            <ul class="top-menu top-link-menu d-none d-md-block">
                                <li>
                                    <a href="#">Links</a>
                                    <ul>
                                        <li><a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a></li>
                                    </ul>
                                </li>
                            </ul><!-- End .top-menu -->
                        </div><!-- End .header-left -->

                        <div class="header-right">
                            <div class="social-icons social-icons-color">
                                <a href="#" class="social-icon social-facebook" title="Facebook"
                                    target="_blank"><i class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i
                                        class="icon-twitter"></i></a>
                                <a href="#" class="social-icon social-pinterest" title="Instagram"
                                    target="_blank"><i class="icon-pinterest-p"></i></a>
                                <a href="#" class="social-icon social-instagram" title="Pinterest"
                                    target="_blank"><i class="icon-instagram"></i></a>
                            </div><!-- End .soial-icons -->
                            @guest
                                <ul class="top-menu top-link-menu">
                                    <li>
                                        <ul>
                                            <a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Sign
                                                in/Sign
                                                Up</a>
                                        </ul>
                                    </li>
                                </ul>
                            @else
                                {{-- <div class="header-tools__item hover-container">
                                <a href="{{ Auth::user()->utype === 'ADM' ? route('admin.index') : route('user.index') }}"
                                    class="icon-user">
                                    <span class="pr-6px ">{{ Auth::user()->name }} </span>

                                </a>
                            </div> --}}
                                <div class="relative inline-block group">
                                    <!-- Trigger -->
                                    <button
                                        class="flex items-center justify-between px-3 py-2 text-md font-medium cursor-pointer rounded-md gap-1">
                                        <img src="{{ Auth::user()->avatar ? asset('avatars/' . Auth::user()->avatar) . '?' . time() : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff' }}"
                                            class="w-10 h-9 rounded-full object-cover border">
                                        <span class=" text-gray-600">{{ Auth::user()->name }}</span>
                                    </button>
                                    <!-- Dropdown -->
                                    <ul
                                        class="absolute right-1 mt-0 w-56 bg-white border border-gray-200 rounded-lg shadow-lg hidden
                                      group-hover:block focus-within:block z-50">
                                        <li>
                                            <a href="{{ Auth::user()->utype === 'ADM' ? route('admin.index') : route('user.index') }}"
                                                class="block px-4 py-3 text-md font-medium hover:text-blue-700 hover:bg-gray-50 ">
                                                <p class="text-black text-md font-medium hover:text-blue-700"> My Account
                                                </p>
                                            </a>
                                        </li>

                                        <li>
                                            <div class="">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full text-left block px-4 py-2 hover:text-blue-700 hover:bg-gray-50">
                                                    <p class="text-md font-medium text-black hover:text-blue-700">Logout</p>
                                                </button>
                                            </form>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            @endguest
                            {{-- <div class="header-dropdown">
                            <a href="#">USD</a>
                            <div class="header-menu">
                                <ul>
                                    <li><a href="#">Eur</a></li>
                                    <li><a href="#">Usd</a></li>
                                </ul>
                            </div><!-- End .header-menu -->
                        </div><!-- End .header-dropdown -->

                        <div class="header-dropdown">
                            <a href="#">Eng</a>
                            <div class="header-menu">
                                <ul>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">Spanish</a></li>
                                </ul>
                            </div><!-- End .header-menu -->
                        </div><!-- End .header-dropdown --> --}}
                        </div><!-- End .header-right -->
                    </div>
                </div>
                <div class="header-middle">
                    <div class="container">
                        <div class="header-left">
                            <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                                <form action="#" method="get">
                                    <div class="header-search-wrapper search-wrapper-wide">
                                        <label for="q" class="sr-only">Search</label>
                                        <button class="btn btn-primary" type="submit"><i
                                                class="icon-search"></i></button>
                                        <input type="search" class="form-control" name="q" id="q"
                                            placeholder="Search product ..." required>
                                    </div><!-- End .header-search-wrapper -->
                                </form>
                            </div><!-- End .header-search -->
                        </div>
                        <div class="header-center">
                            <a href="{{ route('home.index') }}" class="logo">
                                <img src="{{ asset('new-assets/images/logo.png') }}" alt="Bankero Association Logo"
                                    width="120" height="20">
                            </a>
                        </div><!-- End .header-left -->

                        <div class="header-right">

                            <a href="{{ route('wishlist.index') }}" class=" wishlist-link">
                                <i class="icon-heart-o"></i>
                                <span class="wishlist-count">{{ Cart::instance('wishlist')->content()->count() }}</span>
                                <span class="wishlist-txt">My Wishlist</span>
                                {{-- @if (Cart::instance('wishlist')->content()->count() > 0)
                                <span
                                    class="cart-amount d-block position-absolute js-cart-items-count">{{ Cart::instance('wishlist')->content()->count() }}
                                </span>
                            @endif --}}
                            </a>

                            <div class="dropdown cart-dropdown">
                                <a href="{{ route('cart.index') }}" class="dropdown-toggle">
                                    <i class="icon-shopping-cart"></i>

                                    <span class="cart-count">{{ Cart::instance('cart')->content()->count() }}</span>
                                    <span class="cart-txt">Cart</span>
                                </a>
                            </div><!-- End .cart-dropdown -->
                        </div>
                    </div><!-- End .container -->
                </div><!-- End .header-middle -->

                <div class="header-bottom sticky-header ">
                    <div class="container ">
                        <div class="header-left">
                            <nav class="main-nav">
                                <ul class="menu sf-arrows">
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
                                </ul><!-- End .menu -->
                            </nav><!-- End .main-nav -->

                            <button class="mobile-menu-toggler">
                                <span class="sr-only">Toggle mobile menu</span>
                                <i class="icon-bars"></i>
                            </button>
                        </div><!-- End .header-left -->

                    </div><!-- End .container -->
                </div><!-- End .header-bottom -->
            </header><!-- End .header -->
