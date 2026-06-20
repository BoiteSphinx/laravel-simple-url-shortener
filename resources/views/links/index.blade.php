@extends('layouts.app')

@section('content')

@if(session('short_url'))
    <div class="mb-6 rounded-lg bg-green-100 p-4">

        <p class="font-semibold">
            Votre URL courte :
        </p>

        <a
            href="{{ session('short_url') }}"
            target="_blank"
            class="text-blue-600"
        >
            {{ session('short_url') }}
        </a>

    </div>
@endif

<div class="mb-6 flex items-center justify-between">

    <h1 class="text-3xl font-bold">
        Mes liens
    </h1>

    <a
        href="{{ route('links.create') }}"
        class="rounded-lg bg-blue-600 px-4 py-2 text-white"
    >
        Nouveau lien
    </a>

</div>

<div class="mb-6 overflow-hidden rounded-xl bg-white shadow">

    <table class="w-full">

        <thead class="bg-slate-50">
        <tr>
            <th class="px-4 py-3 text-left">
                URL
            </th>

            <th class="px-4 py-3">
                Code
            </th>

            <th class="px-4 py-3">
                Visites
            </th>

            <th class="px-4 py-3">
                Dernière visite
            </th>

            <th class="px-4 py-3">
            </th>
        </tr>
        </thead>

        <tbody>

        @forelse($links as $link)

            <tr class="border-t">

                <td class="px-4 py-4">
                    <a
                        href="{{ $link->original_url }}"
                        target="_blank"
                        class="text-blue-600"
                        title="{{ $link->original_url }}"
                    >
                        {{ Str::limit($link->original_url, 60) }}
                    </a>
                </td>

                <td class="text-center font-mono">
                    <div class="flex items-center justify-center gap-2">
                        <a
                            href="{{ url($link->short_code) }}"
                            target="_blank"
                            class="text-blue-600"
                        >
                            <code>
                                {{ url($link->short_code) }}
                            </code>
                        </a>

                        <button
                            type="button"
                            onclick="copyLink('{{ route('redirect', $link->short_code) }}', this)"
                            class="rounded bg-slate-600 px-2 py-1 text-xs text-white"
                        >
                            Copier
                        </button>
                    </div>
                </td>

                <td class="text-center">
                    {{ $link->visits }}
                </td>

                <td class="text-center">
                    {{ $link->last_visited_at?->toDateTimeString() ?? '-' }}
                </td>

                <td class="px-4">

                    <div class="flex justify-end gap-2">

                        <a
                            href="{{ route('links.edit', $link) }}"
                            class="rounded bg-yellow-500 px-3 py-1 text-white"
                        >
                            Modifier
                        </a>

                        <form
                            method="POST"
                            action="{{ route('links.destroy', $link) }}"
                            onsubmit="return confirm('Voulez-vous vraiment supprimer le lien {{ $link->short_code }} ?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                class="rounded bg-red-600 px-3 py-1 text-white"
                            >
                                Supprimer
                            </button>
                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="5" class="p-6 text-center text-slate-500">
                    Aucun lien.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@if ($links->hasPages())
<div class="mt-6">
    {{ $links->links() }}
</div>
@endif

@endsection

<script>
function copyLink(url, button)
{
    const textarea = document.createElement('textarea');

    textarea.value = url;

    document.body.appendChild(textarea);

    textarea.select();

    document.execCommand('copy');

    document.body.removeChild(textarea);

    const originalText = button.innerText;

    button.innerText = 'Copié ✓';

    setTimeout(() => {
        button.innerText = originalText;
    }, 2000);
}
</script>
