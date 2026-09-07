<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CityController extends Controller
{
    public function index(): View
    {
        $cities = City::with(['country', 'population'])->orderBy('name')->orderBy('zip_code')->paginate(25);

        return view('cities.index', compact('cities'));
    }

    public function create(): View
    {
        $countries = Country::orderBy('name')->get();

        return view('cities.create', compact('countries'));
    }

    public function store(Request $request): RedirectResponse
    {
        City::create($this->validatedData($request));

        return redirect()->route('cities.index')->with('success', 'A város sikeresen létrejött.');
    }

    public function edit(City $city): View
    {
        $countries = Country::orderBy('name')->get();

        return view('cities.edit', compact('city', 'countries'));
    }

    public function update(Request $request, City $city): RedirectResponse
    {
        $city->update($this->validatedData($request));

        return redirect()->route('cities.index')->with('success', 'A város sikeresen módosítva lett.');
    }

    public function destroy(City $city): RedirectResponse
    {
        $city->population()->delete();
        $city->delete();

        return redirect()->route('cities.index')->with('success', 'A város és a hozzá tartozó lakossági adat sikeresen törölve lett.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'zip_code' => ['required', 'integer', 'between:1000,9999'],
            'name' => ['required', 'string', 'max:50'],
            'id_county' => ['required', 'exists:countries,id'],
        ]);
    }
}
