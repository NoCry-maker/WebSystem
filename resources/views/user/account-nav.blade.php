<div class="flex items-center mb-2 shadow-sm px-6 rounded-lg gap-3">
    {{-- Avatar --}}
    <div class="relative w-16 h-16">
        <img src="{{ Auth::user()->avatar ? asset('avatars/' . Auth::user()->avatar) . '?' . time() : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff' }}"
            class="w-16 h-16 rounded-full object-cover border">

        {{-- Upload Button (small camera icon overlay) --}}
        {{-- <form action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data"
            class="absolute bottom-0 right-0">
            @csrf
            @method('PUT')
            <label for="avatar-upload" class="cursor-pointer bg-white p-1 rounded-full shadow">
                <svg width="10px" height="10px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                    fill="#000000">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M14.846 1.403l3.752 3.753.625-.626A2.653 2.653 0 0015.471.778l-.625.625zm2.029 5.472l-3.752-3.753L1.218 15.028 0 19.998l4.97-1.217L16.875 6.875z"
                            fill="#5C5F62"></path>
                    </g>
                </svg>
            </label>
            <input id="avatar-upload" type="file" name="avatar" class="hidden" onchange="this.form.submit()">
        </form> --}}
    </div>
    {{-- User Info --}}
    <div>
        <p class="font-medium text-gray-900">{{ Auth::user()->name }}</p>
        <a href="{{ route('user.index') }}" class="text-blue-600 hover:text-blue-500">Edit Profile</a>
    </div>
</div>

<ul class="account-nav mx-4 p-2 ">
    <button type="button"
        class="hover:bg-gray-50 py-2 flex items-center font-medium w-full p-0 text-medium text-gray-700 transition duration-75 rounded-xl group  "
        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap ">My Account</span>
        <svg class="w-3 h-3 mr-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>
    <ul id="dropdown-example" class="hidden py-2 px-4 text-lg space-y-2">
        <li>
            <a href="{{ route('user.index') }}"
                class="flex items-center  w-full p-3 text-gray-900 hover:text-gray-600 transition duration-75 rounded-lg pl-11 group text-xl bg-gray-50 font-normal ">Profile</a>
        </li>
        <li>
            <a href="{{ route('otp.password.request') }}"
                class="flex items-center w-full p-3 text-gray-900 hover:text-gray-600 transition duration-75 rounded-lg pl-11 group text-xl bg-gray-50 font-normal">Change
                Password</a>
        </li>
    </ul>
    <a href="{{ route('user.orders') }}" class="">
        <div class="hover:bg-gray-50 cursor-pointer font-medium px-3 py-2 text-gray-700 rounded-xl">
            Orders
        </div>
    </a>
    <a href="{{ route('wishlist.index') }}" class=" text-gray-700">
        <div class="hover:bg-gray-50 cursor-pointer font-medium px-3 py-2 text-gray-700 rounded-xl">
            Wishlist
        </div>
    </a>
</ul>
