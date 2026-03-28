@extends('layouts.app')

@section('title', 'Larapets: Register')
@section('content')
    @include('partials.navbar')

<div class="flex items-center justify-center min-h-[80vh] w-full">
    <section
        class="bg-[#000a] p-8 border-white border-2 rounded-xl md:w-fit w-80 flex flex-col justify-center items-center my-5 backdrop-blur-sm shadow-2xl">
        <img src="{{ asset('images/loginlarapets.png') }}" alt="Register Image" class="w-32 h-32 object-cover rounded-full border-2 border-white mb-4 shadow-lg">

        <h1 class="text-4xl flex border-b-2 pb-2 gap-2 text-white font-bold w-full justify-center">
            Register
        </h1>

        <form class="text-white flex flex-col md:flex-row gap-x-2 w-full" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="w-full md:w-80 flex flex-col gap-y-2 mt-8">
                <label for="label">Document:</label>
                <input class="input bg-[#0009] outline-1" type="text" name="document" value="{{ old('document') }}"
                    placeholder="75000011">
                @error('document')
                    <small class="badge badge-error w-full ">{{ $message }} </small>
                @enderror


                <label for="label">Full-Name:</label>
                <input class="input bg-[#0009] outline-1" type="text" name="fullname" value="{{ old('fullname') }}"
                    placeholder="pepito perez">
                @error('fullname')
                    <small class="badge badge-error w-full ">{{ $message }} </small>
                @enderror

                <label for="label">Gender:</label>
                <select name="gender" class="select bg-[#0009] outline-1">
                    <option value="">Select...</option>
                    <option value="Female" @if (old('gender') == 'Female') selected @endif>
                        Female
                    </option>
                    <option value="Male" @if (old('gender') == 'Male') selected @endif>
                        Male
                    </option>
                </select>
                @error('gender')
                    <small class="badge badge-error w-full ">{{ $message }} </small>
                @enderror


                <label for="label">BirthDate:</label>
                <input class="input bg-[#0009] outline-1" type="text" name="birthdate" value="{{ old('birthdate') }}"
                    placeholder="2000-12-25">
                @error('birthdate')
                    <small class="badge badge-error w-full ">{{ $message }} </small>
                @enderror

            </div>
            <div class="w-full md:w-80 flex flex-col gap-y-2 mt-8">
                <label for="label">Phone:</label>
                <input class="input bg-[#0009] outline-1" type="text" name="phone" value="{{ old('phone') }}"
                    placeholder="3001231234">
                @error('phone')
                    <small class="badge badge-error w-full ">{{ $message }} </small>
                @enderror

                <label for="label">Email:</label>
                <input class="input bg-[#0009] outline-1" type="text" name="email" value="{{ old('email') }}"
                    placeholder="tucorreo@mail.com">
                @error('email')
                    <small class="badge badge-error w-full ">{{ $message }} </small>
                @enderror

                <label for="label">Password:</label>
                <input class="input bg-[#0009] outline-1" type="password" name="password" placeholder="tusecreto">
                @error('password')
                    <small class="badge badge-error w-full ">{{ $message }} </small>
                @enderror

                <label for="label">Password Confirmation:</label>
                <input class="input bg-[#0009] outline-1" type="password" name="password_confirmation"
                    placeholder="tusecretodenuevo">

                <button class="btn btn-outline w-full mt-2">Register</button>
            </div>
        </form>

    </section>
</div>

@endsection
