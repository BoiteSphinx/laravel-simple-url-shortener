@extends('layouts.guest')

@section('content')
    <h2 class="mb-6 text-xl font-semibold">
        Connexion
    </h2>

    <form method="POST" action="{{ route('login') }}">
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
                autofocus
                class="w-full rounded-lg border px-4 py-2 focus:border-blue-500 focus:outline-none"
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
                class="w-full rounded-lg border px-4 py-2 focus:border-blue-500 focus:outline-none"
            >

            @error('password')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="w-full rounded-lg bg-blue-600 py-2 font-medium text-white hover:bg-blue-700"
        >
            Se connecter
        </button>

        <div class="mt-4 flex justify-between text-sm">
            <a href="{{ route('register') }}" class="text-blue-600">
                Créer un compte
            </a>

            <a href="{{ route('password.request') }}" class="text-blue-600">
                Mot de passe oublié ?
            </a>
        </div>
    </form>
@endsection
