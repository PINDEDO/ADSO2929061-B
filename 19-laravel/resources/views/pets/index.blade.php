@extends('layouts.app')

@section('title', 'Pet List')

@section('content')
<div class="animate-fade">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Meet Our Friends</h1>
        <p style="color: var(--text-muted);">Find your perfect companion</p>
    </div>

    <div class="glass-card" style="padding: 0; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: rgba(99, 102, 241, 0.05); border-bottom: 1px solid var(--glass-border);">
                    <th style="padding: 1.25rem 2rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;">Name</th>
                    <th style="padding: 1.25rem 2rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;">Type</th>
                    <th style="padding: 1.25rem 2rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em;">Breed</th>
                    <th style="padding: 1.25rem 2rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pets as $pet)
                <tr style="border-bottom: 1px solid var(--glass-border); transition: background 0.2s ease;">
                    <td style="padding: 1.25rem 2rem;">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center;">
                                <img src="https://cdn-icons-png.flaticon.com/512/107/107831.png" alt="Paw" width="20" style="opacity: 0.6;">
                            </div>
                            <span style="font-weight: 600;">{{ $pet->name }}</span>
                        </div>
                    </td>
                    <td style="padding: 1.25rem 2rem; color: var(--text-muted);">{{ ucfirst($pet->kind) }}</td>
                    <td style="padding: 1.25rem 2rem; color: var(--text-muted);">{{ $pet->breed }}</td>
                    <td style="padding: 1.25rem 2rem; text-align: right;">
                        <a href="{{ route('pets.show', $pet->id) }}" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                            View Details
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 4rem; text-align: center; color: var(--text-muted);">
                        No pets found. Check back later!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    tr:hover {
        background: rgba(255, 255, 255, 0.5);
    }
</style>
@endsection
