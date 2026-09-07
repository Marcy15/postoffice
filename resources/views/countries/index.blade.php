@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1>Megyék</h1>
            <p class="muted">A countries tábla kezelése</p>
        </div>
        <a class="button" href="{{ route('countries.create') }}">Új megye</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Név</th>
                    <th>Városok száma</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($countries as $country)
                    <tr>
                        <td>{{ $country->id }}</td>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->cities_count }}</td>
                        <td>
                            <div class="actions">
                                <a class="button secondary" href="{{ route('countries.edit', $country) }}">Szerkesztés</a>
                                <form method="POST" action="{{ route('countries.destroy', $country) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button danger" type="submit" onclick="return confirm('Biztosan törlöd ezt a megyét?')">Törlés</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty" colspan="4">Nincs megjeleníthető megye.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $countries->links() }}</div>
    </div>
@endsection
