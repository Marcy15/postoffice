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
                @forelse ($counties as $county)
                    <tr>
                        <td>{{ $county->id }}</td>
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
                        <td class="empty" colspan="4">Nincs megjeleníthető megye.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $counties->links() }}</div>
    </div>
@endsection
