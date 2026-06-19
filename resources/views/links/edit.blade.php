@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-2xl">

    <h1 class="mb-6 text-3xl font-bold">
        Modifier le lien
    </h1>

    <div class="rounded-xl bg-white p-6 shadow">

        <div class="mb-6 rounded bg-slate-100 p-3">

            <p class="text-sm text-slate-500">
                URL courte
            </p>

            <p class="font-mono">
                {{ url($link->short_code) }}
            </p>

        </div>

        <form
            method="POST"
            action="{{ route('links.update', $link) }}"
        >
            @csrf
            @method('PUT')

            <input
                type="url"
                name="original_url"
                value="{{ old('original_url', $link->original_url) }}"
                required
                class="w-full rounded-lg border px-4 py-2"
            >

            @error('original_url')
                <p class="mt-1 text-red-500">
                    {{ $message }}
                </p>
            @enderror

            <button
                class="mt-6 rounded-lg bg-blue-600 px-4 py-2 text-white"
            >
                Sauvegarder
            </button>

        </form>

    </div>

</div>

@endsection
