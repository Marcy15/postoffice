@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Új megye</h1>
        <a class="button secondary" href="{{ route('counties.index') }}">Vissza a listához</a>
    </div>

    <div class="card form-card">
        <form method="POST" action="{{ route('counties.store') }}">
            @csrf
            <div class="field">
                <label for="name">Név</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" maxlength="50" required autofocus>
            </div>
            <div class="field">
                <label for="crest_url">Címer képének URL-je</label>
                <input id="crest_url" name="crest_url" type="url" value="{{ old('crest_url') }}" maxlength="2048" placeholder="https://...">
            </div>
            <button class="button" type="submit">Mentés</button>
        </form>
    </div>
@endsection
