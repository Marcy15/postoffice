@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Város szerkesztése</h1>
        <a class="button secondary" href="{{ route('cities.index') }}">Vissza a listához</a>
    </div>

    <div class="card form-card">
        <form method="POST" action="{{ route('cities.update', $city) }}">
            @csrf
            @method('PUT')
            @include('cities.form')
            <button class="button" type="submit">Módosítás mentése</button>
        </form>
    </div>
@endsection
