<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'MyAnaPro' }}</title>

    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-100 min-h-screen">

<nav class="bg-white border-b">
    <div class="mx-auto max-w-7xl px-6">

        <div class="flex h-16 items-center justify-between">

            <a
                href="{{ route('links.index') }}"
                class="font-bold text-xl"
            >
                MyAnaPro
            </a>

            <div class="flex items-center gap-4">

                <a
                    href="{{ route('links.create') }}"
                    class="text-sm text-slate-600 hover:text-slate-900"
                >
                    Nouveau lien
                </a>

                <a
                    href="{{ route('profile.index') }}"
                    class="text-sm text-slate-600 hover:text-slate-900"
                >
                    Mon profil
                </a>

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >
                    @csrf

                    <button
                        class="rounded bg-red-500 px-3 py-1 text-white"
                    >
                        Déconnexion
                    </button>
                </form>

            </div>

        </div>

    </div>
</nav>

<main class="mx-auto max-w-7xl px-6 py-8">

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{ $slot ?? '' }}

    @yield('content')

</main>

</body>
</html>
