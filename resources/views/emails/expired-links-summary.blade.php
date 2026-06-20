<h1>Liens supprimés</h1>

<p>
    Les liens suivants ont été supprimés car inactifs depuis plus de {{ config('links.inactive_days') }} jours :
</p>

<ul>
    @foreach ($links as $link)
        <li>
            {{ $link['short_code'] }}
            →
            {{ $link['original_url'] }}
        </li>
    @endforeach
</ul>
