@extends('layouts.guest')

@section('content')
    <h2 class="mb-6 text-xl font-semibold">
        Nouveau mot de passe
    </h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input
            type="hidden"
            name="token"
            value="{{ request()->route('token') }}"
        >

        <div class="mb-4">
            <input
                type="email"
                name="email"
                value="{{ request('email') }}"
                required
                class="w-full rounded-lg border px-4 py-2"
            >
        </div>

        <div class="mb-4">
            <input
                type="password"
                name="password"
                required
                placeholder="Nouveau mot de passe"
                class="w-full rounded-lg border px-4 py-2"
            >
        </div>

        <div class="mb-6">
            <input
                type="password"
                name="password_confirmation"
                required
                placeholder="Confirmation"
                class="w-full rounded-lg border px-4 py-2"
            >
            @error('password')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>


        <button
            type="submit"
            class="w-full rounded-lg bg-blue-600 py-2 text-white"
        >
            Réinitialiser
        </button>

    </form>
@endsection
