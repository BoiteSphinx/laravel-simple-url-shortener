<?php

namespace App\Http\Controllers;

use App\Actions\Links\CreateShortUrl;
use App\Actions\Links\DeleteShortUrl;
use App\Actions\Links\UpdateShortUrl;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\ShortUrl;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('links.index', [
            'links' => ShortUrl::query()
                ->where('user_id', Auth::id())
                ->latest()
                ->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLinkRequest $request, CreateShortUrl $action): RedirectResponse
    {
        $link = $action->handle(
            Auth::user(),
            $request->validated('original_url')
        );

        return to_route('links.index')->with(
            'short_url',
            url($link->short_code)
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShortUrl $link): View
    {
        $this->authorize('update', $link);

        return view('links.edit', [
            'link' => $link,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLinkRequest $request, ShortUrl $link, UpdateShortUrl $action): RedirectResponse
    {
        $this->authorize('update', $link);

        $action->handle($link, $request->validated('original_url'));

        return to_route('links.index')->with(
            'success',
            'Lien mis à jour.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShortUrl $link, DeleteShortUrl $action): RedirectResponse
    {
        $this->authorize('delete', $link);

        $action->handle($link);

        return to_route('links.index')->with(
            'success',
            'Lien supprimé.'
        );
    }
}
