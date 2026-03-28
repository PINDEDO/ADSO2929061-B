@extends('layouts.app')

@section('title', 'Larapets: Edit User')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10 font-bold">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216ZM147.31,107.31l-24,24a8,8,0,0,1-11.32,0l-10.34-10.35A8,8,0,1,1,112.97,109.66L117.31,114,136,95.31l11.31,11.32A8,8,0,0,1,147.31,107.31Z"></path>
        </svg>
        Edit User: {{ $user->fullname }}
    </h1>

    <div class="breadcrumbs text-sm text-white mb-6">
        <ul>
            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ url('users') }}">User Module</a></li>
            <li>Edit User</li>
        </ul>
    </div>

    <div class="card text-white md:w-[800px] w-full bg-black/30 backdrop-blur-md p-8 mb-10 rounded-xl border border-white/20 shadow-2xl mx-auto">
        <form method="POST" action="{{ route('users.update', $user) }}" class="grid grid-cols-1 md:grid-cols-2 gap-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            {{-- Photo Section --}}
            <div class="flex flex-col items-center justify-start space-y-4">
                <div class="avatar">
                    <div id="upload" class="mask mask-squircle w-56 h-56 cursor-pointer hover:scale-105 transition-all duration-300 border-2 border-dashed border-white/30 p-1">
                        <img id="preview" src="{{ asset('images/' . ($user->photo ?? 'no-photo.png')) }}" class="object-cover" />
                    </div>
                </div>
                <div class="text-center">
                    <span class="text-sm font-semibold border-b border-white/50 pb-1 cursor-pointer" onclick="document.getElementById('photo').click()">
                        Change Photo
                    </span>
                    <input type="file" id="photo" name="photo" class="hidden" accept="image/*">
                    @error('photo')
                        <p class="text-error text-xs mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Form Fields --}}
            <div class="space-y-4">
                <div>
                    <label class="label font-bold text-white py-1">Document:</label>
                    <input type="text" name="document" class="input input-bordered w-full bg-black/40 border-none px-4" value="{{ old('document', $user->document) }}">
                    @error('document') <small class="text-error text-xs font-bold">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="label font-bold text-white py-1">Full Name:</label>
                    <input type="text" name="fullname" class="input input-bordered w-full bg-black/40 border-none px-4" value="{{ old('fullname', $user->fullname) }}">
                    @error('fullname') <small class="text-error text-xs font-bold">{{ $message }}</small> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="label font-bold text-white py-1">Gender:</label>
                        <select name="gender" class="select select-bordered w-full bg-black/40 border-none">
                            <option value="Male" @selected(old('gender', $user->gender) == 'Male')>Male</option>
                            <option value="Female" @selected(old('gender', $user->gender) == 'Female')>Female</option>
                            <option value="Other" @selected(old('gender', $user->gender) == 'Other')>Other</option>
                        </select>
                        @error('gender') <small class="text-error text-xs font-bold">{{ $message }}</small> @enderror
                    </div>
                    <div>
                        <label class="label font-bold text-white py-1">Birth Date:</label>
                        <input type="date" name="birthdate" class="input input-bordered w-full bg-black/40 border-none" value="{{ old('birthdate', $user->birthdate) }}">
                        @error('birthdate') <small class="text-error text-xs font-bold">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="label font-bold text-white py-1">Phone:</label>
                        <input type="text" name="phone" class="input input-bordered w-full bg-black/40 border-none px-4" value="{{ old('phone', $user->phone) }}">
                        @error('phone') <small class="text-error text-xs font-bold">{{ $message }}</small> @enderror
                    </div>
                    <div>
                        <label class="label font-bold text-white py-1">Email:</label>
                        <input type="email" name="email" class="input input-bordered w-full bg-black/40 border-none px-4" value="{{ old('email', $user->email) }}">
                        @error('email') <small class="text-error text-xs font-bold">{{ $message }}</small> @enderror
                    </div>
                </div>

                <hr class="border-white/10 my-2">

                <div>
                    <label class="label font-bold text-white py-1">New Password (optional):</label>
                    <input type="password" name="password" class="input input-bordered w-full bg-black/40 border-none px-4 placeholder:text-gray-500" placeholder="••••••••">
                    @error('password') <small class="text-error text-xs font-bold">{{ $message }}</small> @enderror
                </div>
                <div>
                    <label class="label font-bold text-white py-1">Confirm New Password:</label>
                    <input type="password" name="password_confirmation" class="input input-bordered w-full bg-black/40 border-none px-4 placeholder:text-gray-500" placeholder="••••••••">
                </div>

                <div class="flex gap-4 mt-6">
                    <a href="{{ url('users') }}" class="btn btn-ghost flex-1">Cancel</a>
                    <button class="btn btn-primary flex-1 bg-indigo-600 border-none">Update User</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#upload').click(function() {
                $('#photo').click();
            });
            $('#photo').change(function() {
                if (this.files && this.files[0]) {
                    $('#preview').attr('src', URL.createObjectURL(this.files[0]));
                }
            });
        });
    </script>
@endsection
