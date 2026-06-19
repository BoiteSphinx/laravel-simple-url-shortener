@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-2xl">

    <h1 class="mb-6 text-3xl font-bold">
        Nouveau lien
    </h1>

    <div class="rounded-xl bg-white p-6 shadow">

        <form
            method="POST"
            action="{{ route('links.store') }}"
        >
            @csrf

            <div>

                <label class="mb-2 block font-medium">
                    URL de destination
                </label>

                <input
                    type="url"
                    name="original_url"
                    value="{{ old('original_url') }}"
                    required
                    class="w-full rounded-lg border px-4 py-2"
                >

                @error('original_url')
                    <p class="mt-1 text-red-500">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <button
                class="mt-6 rounded-lg bg-blue-600 px-4 py-2 text-white"
            >
                Générer le lien
            </button>

        </form>

    </div>

</div>

@endsection
