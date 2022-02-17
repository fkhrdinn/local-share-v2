@extends('layouts.app-login')

@section('content')
<div class="mt-20 flex justify-center mb-40">
    <div class="lg:block hidden">
        <img class="" src="{{ asset('img/project_logo.png') }}" alt="Logo">
        <p class="w-2/4 text-5xl pt-10 font-bold">A Merchant Friendly Admin Panel</p>
    </div>
    <div class="rounded border border-gray-300 p-10 bg-white shadow-2xl sm:rounded-lg lg:w-3/12 sm:w-full">
        <a href="/"><img class="" src="{{ asset('img/project_logo.png') }}" alt="Logo"></a>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mt-8 text-center font-black text-2xl">
                Welcome
            </div>
            <div class="mt-4 text-sm">
                Enter your e-mail and password to sign-in 
            </div>
            @if($errors->has('email'))
            <div class="mt-4 text-sm text-red-400 bg-red-200 rounded text-center">
                These Credentials do not match our records.
            </div>
            @endif
            <!-- Email Address -->
            <div class="mt-4">
                <label for="email">
                    Email
                    <input id="email" class="form-input block mt-1 w-full rounded-3xl" type="email" name="email" :value="old('email')" required autofocus />
                </label>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password">
                    Password
                    <input id="password" class="form-input block mt-1 w-full rounded-3xl"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
                </label>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-center mt-4 pr-3">
                <button class="bg-blue-300 rounded p-1 px-4"type="submit" class="ml-3">
                    Log in
                </button>
            </div>

            <div class="flex items-center justify-center mt-4 pr-3">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 pr-4" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection