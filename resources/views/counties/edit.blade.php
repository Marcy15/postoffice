@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Megye szerkesztése</h1>
        <a class="button secondary" href="{{ route('counties.index') }}">Vissza a listához</a>
    </div>

    <div class="card form-card">
        <form method="POST" action="{{ route('counties.update', $county) }}">
            @csrf
            @method('PUT')
            <div class="field">
                <label for="name">Név</label>
                <input id="name" name="name" type="text" value="{{ old('name', $county->name) }}" maxlength="50" required autofocus>
            </div>
            <div class="field">
                <label for="crest_url">Címer képének URL-je</label>
                <input id="crest_url" name="crest_url" type="url" value="{{ old('crest_url', $county->crest_url) }}" maxlength="2048" placeholder="https://...">
            </div>
            @if ($county->crest_url)
                <div class="field">
                    <label>Előnézet</label>
                    <img class="crest preview" src="{{ $county->crest_url }}" alt="{{ $county->name }} címere">
                </div>
            @endif
            <button class="button" type="submit">Módosítás mentése</button>
        </form>
    </div>
@endsection
