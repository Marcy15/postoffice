@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1>Lakossági adatok</h1>
            <p class="muted">A population tábla kezelése</p>
        </div>
        <div class="actions">
            <form method="POST" action="{{ route('population.generate') }}">
                @csrf
                <button class="button secondary" type="submit" onclick="return confirm('A jelenlegi lakossági adatok törlődnek és minden városhoz új véletlen érték készül. Folytatod?')">Véletlen feltöltés városokból</button>
            </form>
            <a class="button" href="{{ route('population.create') }}">Új lakossági adat</a>
        </div>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Város</th>
                    <th>Irányítószám</th>
                    <th>Megye</th>
                    <th>Lakosság</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($populations as $population)
                    <tr>
                        <td>{{ $population->id }}</td>
                        <td>{{ $population->cityRecord?->name ?? '-' }}</td>
                        <td>{{ $population->cityRecord?->zip_code ?? '-' }}</td>
                        <td>{{ $population->cityRecord?->county?->name ?? '-' }}</td>
                        <td>{{ number_format($population->population, 0, ',', ' ') }}</td>
                        <td>
                            <div class="actions">
                                <a class="button secondary" href="{{ route('population.edit', $population) }}">Szerkesztés</a>
                                <form method="POST" action="{{ route('population.destroy', $population) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button danger" type="submit" onclick="return confirm('Biztosan törlöd ezt a lakossági adatot?')">Törlés</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty" colspan="6">Nincs megjeleníthető lakossági adat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $populations->links() }}</div>
    </div>
@endsection
