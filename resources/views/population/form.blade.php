<div class="field">
    <label for="city">Város</label>
    <select id="city" name="city" required>
        <option value="">Válassz várost</option>
        @foreach ($cities as $city)
            <option value="{{ $city->id }}" @selected(old('city', $population->city ?? '') == $city->id)>{{ $city->name }} ({{ $city->zip_code }}) — {{ $city->country?->name }}</option>
        @endforeach
    </select>
</div>
<div class="field">
    <label for="population">Lakosság</label>
    <input id="population" name="population" type="number" value="{{ old('population', $population->population ?? '') }}" min="0" max="10000000" required>
</div>
