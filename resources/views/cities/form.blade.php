<div class="field">
    <label for="zip_code">Irányítószám</label>
    <input id="zip_code" name="zip_code" type="number" value="{{ old('zip_code', $city->zip_code ?? '') }}" min="1000" max="9999" required>
</div>
<div class="field">
    <label for="name">Név</label>
    <input id="name" name="name" type="text" value="{{ old('name', $city->name ?? '') }}" maxlength="50" required>
</div>
<div class="field">
    <label for="id_county">Megye</label>
    <select id="id_county" name="id_county" required>
        <option value="">Válassz megyét</option>
        @foreach ($countries as $country)
            <option value="{{ $country->id }}" @selected(old('id_county', $city->id_county ?? '') == $country->id)>{{ $country->name }}</option>
        @endforeach
    </select>
</div>
