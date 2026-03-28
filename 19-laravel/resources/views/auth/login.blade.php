{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route(''login'') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('layouts.app')

@section('title', 'Larapets: Login')
@section('content')
    @include('partials.navbar')

<div class="flex items-center justify-center min-h-[80vh]">
    <section class="bg-[#000a] p-8 border-white border-2 rounded-xl w-96 flex flex-col justify-center items-center backdrop-blur-sm shadow-2xl">
        <img src="{{ asset('images/loginlarapets.png') }}" alt="Login Image" class="w-32 h-32 object-cover rounded-full border-2 border-white mb-4 shadow-lg">

        <h1 class="text-4xl flex border-b-2 pb-2 gap-2 text-white font-bold w-full justify-center">
            Login
        </h1>
        <form class="flex mt-8 flex-col gap-2 text-white w-full" action="{{ route('login') }}" method="POST">
            @csrf

            <label for="email" class="font-semibold">Email:</label>
            <input class="input bg-[#0009] outline-1 border border-gray-400 p-2 rounded w-full focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all" type="text" name="email" value="{{ old('email') }}"
                placeholder="username@mail.com">
            @error('email')
                <small class="badge badge-error w-full text-red-400 font-bold">{{ $message }} </small>
            @enderror

            <label class="mt-4 font-semibold" for="password">Password:</label>
            <input class="input bg-[#0009] outline-1 border border-gray-400 p-2 rounded w-full focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all" type="password" name="password" placeholder="••••••••">
            @error('password')
                <small class="badge badge-error w-full text-red-400 font-bold">{{ $message }} </small>
            @enderror

            <button class="btn mt-6 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 rounded transition-colors w-full">Login</button>
            @if (Route::has('password.request'))
                <a class="mt-4 w-fit border-b pb-1 text-sm text-gray-300 hover:text-white focus:outline-none transition-colors mx-auto"
                    href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </form>
    </section>
</div>
@endsection
