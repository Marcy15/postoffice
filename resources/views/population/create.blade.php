@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Új lakossági adat</h1>
        <a class="button secondary" href="{{ route('population.index') }}">Vissza a listához</a>
    </div>

    <div class="card form-card">
        <form method="POST" action="{{ route('population.store') }}">
            @csrf
            @include('population.form')
            <button class="button" type="submit">Mentés</button>
        </form>
    </div>
@endsection
