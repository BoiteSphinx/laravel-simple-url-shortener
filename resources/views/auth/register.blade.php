@extends('layouts.guest')

@section('content')
    <h2 class="mb-6 text-xl font-semibold">
        Créer un compte
    </h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label class="mb-1 block text-sm font-medium">
                Adresse email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                class="w-full rounded-lg border px-4 py-2"
            >

            @error('email')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="mb-1 block text-sm font-medium">
                Mot de passe
            </label>

            <input
                type="password"
                name="password"
                required
                class="w-full rounded-lg border px-4 py-2"
            >
        </div>

        <div class="mb-6">
            <label class="mb-1 block text-sm font-medium">
                Confirmation
            </label>

            <input
                type="password"
                name="password_confirmation"
                required
                class="w-full rounded-lg border px-4 py-2"
            >
        </div>

        <button
            type="submit"
            class="w-full rounded-lg bg-blue-600 py-2 font-medium text-white hover:bg-blue-700"
        >
            Créer mon compte
        </button>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-sm text-blue-600">
                Déjà inscrit ?
            </a>
        </div>
    </form>
@endsection
