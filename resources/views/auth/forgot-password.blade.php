@extends('layouts.guest')

@section('content')
    <h2 class="mb-2 text-xl font-semibold">
        Réinitialisation
    </h2>

    <p class="mb-6 text-sm text-slate-500">
        Entrez votre adresse email pour recevoir un lien de réinitialisation.
    </p>

    @if(session('status'))
        <div class="mb-4 rounded-lg bg-green-100 p-3 text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-6">
            <input
                type="email"
                name="email"
                required
                class="w-full rounded-lg border px-4 py-2"
                placeholder="email@example.com"
            >
        </div>

        <button
            type="submit"
            class="w-full rounded-lg bg-blue-600 py-2 text-white"
        >
            Envoyer le lien
        </button>
    </form>
@endsection
