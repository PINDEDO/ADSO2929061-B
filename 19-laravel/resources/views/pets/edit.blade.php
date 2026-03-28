@extends('layouts.app')

@section('title', 'Larapets: Edit Pet')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10 font-bold">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 256 256">
            <path d="M227.32,73.37,182.63,28.69a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.32,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.69,147.32,64l24-24L216,84.69Z"></path>
        </svg>
        Edit Pet: {{ $pet->name }}
    </h1>

    <div class="breadcrumbs text-sm text-white mb-6">
        <ul>
            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ url('pets') }}">Pet Module</a></li>
            <li>Edit Pet</li>
        </ul>
    </div>

    <div class="card text-white md:w-[800px] w-full bg-black/30 backdrop-blur-md p-8 mb-10 rounded-xl border border-white/20 shadow-2xl mx-auto">
        <form method="POST" action="{{ route('pets.update', $pet) }}" class="grid grid-cols-1 md:grid-cols-2 gap-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            {{-- Image Upload Section --}}
            <div class="flex flex-col items-center justify-start space-y-4">
                <div class="avatar">
                    <div id="upload" class="mask mask-squircle w-56 h-56 cursor-pointer hover:scale-105 transition-all duration-300 border-2 border-dashed border-white/30 p-1">
                        <img id="preview" src="{{ asset('images/' . ($pet->image ?? 'no-image.png')) }}" class="object-cover" />
                    </div>
                </div>
                <div class="text-center">
                    <span class="text-sm font-semibold border-b border-white/50 pb-1 cursor-pointer" onclick="document.getElementById('image').click()">
                        Change Photo
                    </span>
                    <input type="file" id="image" name="image" class="hidden" accept="image/*">
                    @error('image')
                        <p class="text-error text-xs mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Form Fields Section --}}
            <div class="space-y-4">
                <div>
                    <label class="label font-bold text-white py-1">Name:</label>
                    <input type="text" name="name" class="input input-bordered w-full bg-black/40 border-none focus:ring-2 focus:ring-indigo-500" value="{{ old('name', $pet->name) }}">
                    @error('name') <small class="text-error text-xs font-bold">{{ $message }}</small> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="label font-bold text-white py-1">Kind:</label>
                        <select name="kind" class="select select-bordered w-full bg-black/40 border-none">
                            <option value="Dog" @selected(old('kind', $pet->kind) == 'Dog')>Dog</option>
                            <option value="Cat" @selected(old('kind', $pet->kind) == 'Cat')>Cat</option>
                            <option value="Pig" @selected(old('kind', $pet->kind) == 'Pig')>Pig</option>
                            <option value="Bird" @selected(old('kind', $pet->kind) == 'Bird')>Bird</option>
                        </select>
                        @error('kind') <small class="text-error text-xs font-bold">{{ $message }}</small> @enderror
                    </div>
                    <div>
                        <label class="label font-bold text-white py-1">Breed:</label>
                        <input type="text" name="breed" class="input input-bordered w-full bg-black/40 border-none" value="{{ old('breed', $pet->breed) }}">
                        @error('breed') <small class="text-error text-xs font-bold">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="label font-bold text-white py-1">Weight (kg):</label>
                        <input type="number" step="0.1" name="weight" class="input input-bordered w-full bg-black/40 border-none" value="{{ old('weight', $pet->weight) }}">
                        @error('weight') <small class="text-error text-xs font-bold">{{ $message }}</small> @enderror
                    </div>
                    <div>
                        <label class="label font-bold text-white py-1">Age (years):</label>
                        <input type="number" name="age" class="input input-bordered w-full bg-black/40 border-none" value="{{ old('age', $pet->age) }}">
                        @error('age') <small class="text-error text-xs font-bold">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div>
                    <label class="label font-bold text-white py-1">Location:</label>
                    <input type="text" name="location" class="input input-bordered w-full bg-black/40 border-none" value="{{ old('location', $pet->location) }}">
                    @error('location') <small class="text-error text-xs font-bold">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label class="label font-bold text-white py-1">Description:</label>
                    <textarea name="description" class="textarea textarea-bordered h-24 w-full bg-black/40 border-none">{{ old('description', $pet->description) }}</textarea>
                    @error('description') <small class="text-error text-xs font-bold">{{ $message }}</small> @enderror
                </div>

                <button class="btn btn-primary hover:scale-[1.02] transition-all w-full mt-4 bg-indigo-600 border-none shadow-lg">Update Pet</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#upload').click(function() {
                $('#image').click();
            });
            $('#image').change(function() {
                if (this.files && this.files[0]) {
                    $('#preview').attr('src', URL.createObjectURL(this.files[0]));
                }
            });
        });
    </script>
@endsection
