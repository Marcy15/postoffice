@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1>Megyék</h1>
            <p class="muted">A counties tábla kezelése</p>
        </div>
        <a class="button" href="{{ route('counties.create') }}">Új megye</a>
    </div>

    <div class="card">
        <form class="search-form" method="GET" action="{{ route('counties.index') }}">
            <input name="search" type="search" value="{{ $search }}" placeholder="Keresés megye neve alapján">
            <button class="button" type="submit">Keresés</button>
            @if ($search !== '')
                <a class="button secondary" href="{{ route('counties.index') }}">Szűrés törlése</a>
            @endif
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Címer</th>
                    <th>Név</th>
                    <th>Városok száma</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($counties as $county)
                    <tr>
                        <td>{{ $county->id }}</td>
                        <td>
                            @if ($county->crest_url)
                                <a href="{{ $county->crest_url }}" target="_blank" rel="noopener noreferrer">
                                    <img class="crest" src="{{ $county->crest_url }}" alt="{{ $county->name }} címere">
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $county->name }}</td>
                        <td>{{ $county->cities_count }}</td>
                        <td>
                            <div class="actions">
                                <a class="button secondary" href="{{ route('counties.edit', $county) }}">Szerkesztés</a>
                                <form method="POST" action="{{ route('counties.destroy', $county) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button danger" type="submit" onclick="return confirm('Biztosan törlöd ezt a megyét?')">Törlés</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty" colspan="5">Nincs megjeleníthető megye.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $counties->links() }}</div>
    </div>
@endsection
