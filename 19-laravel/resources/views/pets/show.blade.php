@extends('layouts.app')

@section('title', 'Pet Details - ' . $pet->name)

@section('content')
<div class="animate-fade">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('pets.index') }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.875rem; gap: 0.5rem;">
            ← Back to List
        </a>
    </div>

    <div class="glass-card" style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 3rem; align-items: center;">
        <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%); border-radius: 20px; padding: 3rem; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
            <img src="https://cdn-icons-png.flaticon.com/512/107/107831.png" alt="Paw Print" style="width: 80%; opacity: 0.8; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));">
            <div style="position: absolute; bottom: 1rem; right: 1rem; background: var(--primary); color: white; padding: 0.5rem 1rem; border-radius: 50px; font-weight: 700; font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase;">
                {{ $pet->active ? 'Available' : 'Unavailable' }}
            </div>
        </div>

        <div>
            <span style="color: var(--primary); font-weight: 700; text-transform: uppercase; font-size: 0.875rem; letter-spacing: 0.1em;">Pet Profile</span>
            <h1 style="margin-bottom: 0.5rem; margin-top: 0.5rem;">{{ $pet->name }}</h1>
            
            <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
                <div style="background: white; padding: 0.75rem 1.25rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                    <p style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 0.25rem;">Type</p>
                    <p style="font-weight: 600;">{{ ucfirst($pet->kind) }}</p>
                </div>
                <div style="background: white; padding: 0.75rem 1.25rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                    <p style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 0.25rem;">Breed</p>
                    <p style="font-weight: 600;">{{ $pet->breed }}</p>
                </div>
            </div>

            <div style="margin-bottom: 2rem;">
                <h3 style="margin-bottom: 1rem; font-size: 1.125rem;">About {{ $pet->name }}</h3>
                <p style="line-height: 1.6; color: var(--text-main); font-size: 1.05rem;">
                    {{ $pet->description }}
                </p>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 3rem;">
                <div>
                    <p style="font-size: 0.875rem; color: var(--text-muted);">Weight</p>
                    <p style="font-weight: 600;">{{ $pet->weight }} kg</p>
                </div>
                <div>
                    <p style="font-size: 0.875rem; color: var(--text-muted);">Age</p>
                    <p style="font-weight: 600;">{{ $pet->age }} years</p>
                </div>
                <div>
                    <p style="font-size: 0.875rem; color: var(--text-muted);">Location</p>
                    <p style="font-weight: 600;">{{ $pet->location }}</p>
                </div>
            </div>

            <button class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1.125rem;">
                Adopt Now
            </button>
        </div>
    </div>
</div>
@endsection
