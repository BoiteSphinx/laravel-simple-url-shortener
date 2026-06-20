@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-3xl">

    <h1 class="mb-8 text-3xl font-bold">
        Mon profil
    </h1>

    <div class="mb-8 rounded-xl bg-white p-6 shadow">

        <h2 class="mb-4 text-xl font-semibold">
            Adresse email
        </h2>

        <form
            method="POST"
            action="{{ route('user-profile-information.update') }}"
        >
            @csrf
            @method('PUT')

            <input
                type="email"
                name="email"
                value="{{ auth()->user()->email }}"
                class="w-full rounded-lg border px-4 py-2"
            >

            <button
                class="mt-4 rounded bg-blue-600 px-4 py-2 text-white"
            >
                Mettre à jour
            </button>

        </form>

    </div>

    <div class="rounded-xl bg-white p-6 shadow">

        <h2 class="mb-4 text-xl font-semibold">
            Mot de passe
        </h2>

        <form
            method="POST"
            action="{{ route('user-password.update') }}"
        >
            @csrf
            @method('PUT')

            <div class="mb-4">
                <input
                    type="password"
                    name="current_password"
                    placeholder="Mot de passe actuel"
                    class="w-full rounded-lg border px-4 py-2"
                >
            </div>

            <div class="mb-4">
                <input
                    type="password"
                    name="password"
                    placeholder="Nouveau mot de passe"
                    class="w-full rounded-lg border px-4 py-2"
                >
            </div>

            <div class="mb-4">
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirmation"
                    class="w-full rounded-lg border px-4 py-2"
                >
            </div>

            <button
                class="rounded bg-blue-600 px-4 py-2 text-white"
            >
                Modifier le mot de passe
            </button>

        </form>

    </div>

</div>

@endsection
