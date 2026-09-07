@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1>Városok</h1>
            <p class="muted">A cities tábla kezelése</p>
        </div>
        <a class="button" href="{{ route('cities.create') }}">Új város</a>
    </div>

    <div class="card">
        <form class="search-form" method="GET" action="{{ route('cities.index') }}">
            <input name="search" type="search" value="{{ $search }}" placeholder="Város, irányítószám vagy megye keresése">
            <button class="button" type="submit">Keresés</button>
            @if ($search !== '')
                <a class="button secondary" href="{{ route('cities.index') }}">Szűrés törlése</a>
            @endif
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Irányítószám</th>
                    <th>Név</th>
                    <th>Megye</th>
                    <th>Lakosság</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cities as $city)
                    <tr>
                        <td>{{ $city->id }}</td>
                        <td>{{ $city->zip_code }}</td>
                        <td>{{ $city->name }}</td>
                        <td>{{ $city->county?->name ?? '-' }}</td>
                        <td>{{ $city->population ? number_format($city->population->population, 0, ',', ' ') : '-' }}</td>
                        <td>
                            <div class="actions">
                                <a class="button secondary" href="{{ route('cities.edit', $city) }}">Szerkesztés</a>
                                <form method="POST" action="{{ route('cities.destroy', $city) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button danger" type="submit" onclick="return confirm('Biztosan törlöd ezt a várost?')">Törlés</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty" colspan="6">Nincs megjeleníthető város.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $cities->links() }}</div>
    </div>
@endsection
