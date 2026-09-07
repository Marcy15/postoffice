<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CountryController extends Controller
{
    public function index(): View
    {
        $countries = Country::withCount('cities')->orderBy('name')->paginate(20);

        return view('countries.index', compact('countries'));
    }

    public function create(): View
    {
        return view('countries.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Country::create($request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:countries,name'],
        ]));

        return redirect()->route('countries.index')->with('success', 'A megye sikeresen létrejött.');
    }

    public function edit(Country $country): View
    {
        return view('countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country): RedirectResponse
    {
        $country->update($request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:countries,name,' . $country->id],
        ]));

        return redirect()->route('countries.index')->with('success', 'A megye sikeresen módosítva lett.');
    }

    public function destroy(Country $country): RedirectResponse
    {
        if ($country->cities()->exists()) {
            return redirect()->route('countries.index')->with('error', 'A megye nem törölhető, mert városok tartoznak hozzá.');
        }

        $country->delete();

        return redirect()->route('countries.index')->with('success', 'A megye sikeresen törölve lett.');
    }
}
