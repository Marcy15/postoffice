@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Lakossági adat szerkesztése</h1>
        <a class="button secondary" href="{{ route('population.index') }}">Vissza a listához</a>
    </div>

    <div class="card form-card">
        <form method="POST" action="{{ route('population.update', $population) }}">
            @csrf
            @method('PUT')
            @include('population.form')
            <button class="button" type="submit">Módosítás mentése</button>
        </form>
    </div>
@endsection
