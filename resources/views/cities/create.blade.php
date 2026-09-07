@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Új város</h1>
        <a class="button secondary" href="{{ route('cities.index') }}">Vissza a listához</a>
    </div>

    <div class="card form-card">
        <form method="POST" action="{{ route('cities.store') }}">
            @csrf
            @include('cities.form')
            <button class="button" type="submit">Mentés</button>
        </form>
    </div>
@endsection
