@extends('layouts.app-login')

@section('content')
<div class="lg:mx-64 rounded-3xl border border-gray-300 p-10 bg-white shadow-2xl sm:rounded-lg m-20 mb-60 mx-0">
    <div class="flex justify-center mb-3">
            <p class="font-bold text-black text-lg">REGISTRATION</p>
    </div>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="lg:flex sm:block">
            <div class="mr-0 lg:mr-5 lg:w-1/2 w-full">
                <div>
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="block mt-1 w-full rounded-3xl" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full rounded-3xl" type="email" name="email" :value="old('email')" required />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full rounded-3xl"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full rounded-3xl"
                                    type="password"
                                    name="password_confirmation" required />
                </div>
            </div>
            <div class="ml-0 lg:ml-5 lg:w-1/2 w-full">
                <div>
                    <x-label for="mobile" :value="__('Mobile Number')" />

                    <x-input id="mobile" class="block mt-1 w-full rounded-3xl" type="text" name="mobile" required/>
                </div>
            </div>
        </div>

        <div class="md:flex items-center justify-end mt-4 sm:block">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-button class="ml-4">
                {{ __('Register') }}
            </x-button>
        </div>
    </form>
</div>
@endsection