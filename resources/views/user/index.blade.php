@extends('layouts.app')
@section('content')
    <main class="pt-90 ">
        <div class="mb-2 pb-2"></div>
        <section class="my-account container pb-2 ">
            {{-- <h2 class="page-title">My Account</h2> --}}
            <div class="row gap-3">
                <div class="col-lg-3 shadow-md p-4 ">
                    @include('user.account-nav')

                </div>
                <div class="col-lg-8 shadow-md">
                    <div class="mx-auto bg-white rounded-xl mt-0 p-4">
                        <div class="shadow-sm px-4">
                            <h1 class="text-2xl font-bold mb-1">My Profile</h1>
                            <p class="text-black text-2xl mb-3">Manage and protect your account</p>
                        </div>
                        <form method="POST" action="{{ route('profile.update') }} "enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="flex flex-col lg:flex-row gap-4">
                                <div class="flex-1 bg-white px-6 rounded-lg">
                                    {{-- Username --}}
                                    <div class="mb-2">
                                        <label class="block text-xl font-medium text-gray-700">Username</label>
                                        <input type="text" name="name"
                                            class=" w-full border rounded-lg px-3 py-2 font-normal"
                                            value="{{ old('name', Auth::user()->name) }}" />
                                        {{-- <small class="text-gray-500">Username can only be changed once</small> --}}
                                    </div>
                                    {{-- Email --}}
                                    {{-- <div class="mb-2">
                                           <label class="block text-sm font-medium text-gray-700">Email</label>
                                           <input type="email" name="email" class="mt-1 w-full border rounded-lg px-3 py-2"
                                           value="{{ old('email', Auth::user()->email) }}" />
                                     </div> --}}
                                    {{-- Email --}}
                                    <div class="mb-2">
                                        <label class="block text-xl font-medium text-gray-700">Email</label>
                                        <input type="email"
                                            class=" w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-600 cursor-not-allowed"
                                            value="{{ Auth::user()->email }}" disabled />
                                    </div>
                                    {{-- Phone --}}
                                    <div class="mb-2">
                                        <label class="block text-xl font-medium text-gray-700">Phone Number</label>
                                        <input type="tel"pattern="^(?:\+?63|0)9\d{9}$" name="mobile"
                                            class=" w-full border rounded-lg px-3 py-2"
                                            value="{{ old('mobile', Auth::user()->mobile) }}" />
                                        @error('mobile')
                                            <p class="text-red-600 text-lg mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    {{-- Gender --}}
                                    <div class="mb-2">
                                        <label class="block text-xl font-medium text-gray-700">Gender</label>
                                        <div class="flex gap-4 ">
                                            <label>
                                                <input type="radio" name="gender" value="Male" class="accent-blue-600"
                                                    {{ Auth::user()->gender == 'Male' ? 'checked' : '' }}> Male
                                            </label>
                                            <label>
                                                <input type="radio" name="gender" value="Female" class="accent-blue-600"
                                                    {{ Auth::user()->gender == 'Female' ? 'checked' : '' }}> Female
                                            </label>
                                            <label>
                                                <input type="radio" name="gender" value="Other" class="accent-blue-600"
                                                    {{ Auth::user()->gender == 'Other' ? 'checked' : '' }}> Other
                                            </label>
                                        </div>
                                    </div>
                                    {{-- DOB --}}
                                    <div class="mb-2">
                                        <label class="block text-xl font-medium text-gray-700">Date of Birth</label>
                                        <input type="date" name="dob"
                                            class=" w-full border rounded-lg px-3 py-2 font-light"
                                            value="{{ old('dob', Auth::user()->dob) }}" />
                                    </div>
                                </div>
                                <div class="col-lg-3 ">
                                    {{-- Image Profile --}}
                                    <div class="w-full sm:w-72 bg-white px-6 rounded-lg shadow-md flex flex-col items-center">
                                        <label class="block text-xl font-medium text-gray-700 mb-1">Profile Photo</label>
                                        {{-- Avatar Display --}}
                                        <div class="w-36 h-36  rounded-md overflow-hidden mb-2">
                                            <img id="avatar-preview"
                                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                                                class="w-full h-full rounded-full border object-cover">
                                        </div>
                                        {{-- File Input --}}
                                        <label for="avatar-upload"
                                            class="w-full text-center text-black bg-gray-100 border rounded-lg px-3 py-3 cursor-pointer hover:bg-gray-200 font-normal text-sm sm:text-xl">
                                            Select Image
                                        </label>
                                        <input id="avatar-upload" type="file" name="avatar" accept="image/*"
                                            class="hidden">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center sm:ml-96 ">
                                <button type="submit"
                                    class="bg-blue-600 text-white px-8 py-2 rounded-md hover:bg-blue-700">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- <div class="page-content my-account__dashboard">
                        <p>Hello <strong>{{ Auth::user()->name }} </strong></p>
                        <p>From your account dashboard you can view your <a class="unerline-link"
                                href="account_orders.html">recent
                                orders</a>, manage your <a class="unerline-link" href="account_edit_address.html">shipping
                                addresses</a>, and <a class="unerline-link" href="account_edit.html">edit your password and
                                account
                                details.</a></p>
                    </div> --}}
        </section>
    </main>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('avatar-upload');
        const preview = document.getElementById('avatar-preview');

        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
