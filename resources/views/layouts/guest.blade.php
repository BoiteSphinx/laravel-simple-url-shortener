<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? 'MyAnaPro' }}</title>

        @fonts

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100">

        <div class="flex min-h-screen items-center justify-center px-4">
            <div class="w-full max-w-md rounded-xl bg-white p-8 shadow-lg">
                <h1 class="mb-6 text-center text-3xl font-bold text-slate-800">
                    MyAnaPro
                </h1>

                @yield('content')
            </div>
        </div>

</body>
</html>
