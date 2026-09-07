<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CountyController extends Controller
{
    public function index(): View
    {
        $counties = County::withCount('cities')->orderBy('name')->paginate(20);

        return view('counties.index', compact('counties'));
    }

    public function create(): View
    {
        return view('counties.create');
    }

    public function store(Request $request): RedirectResponse
    {
        County::create($request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:counties,name'],
        ]));

        return redirect()->route('counties.index')->with('success', 'A megye sikeresen létrejött.');
    }

    public function edit(County $county): View
    {
        return view('counties.edit', compact('county'));
    }

    public function update(Request $request, County $county): RedirectResponse
    {
        $county->update($request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:counties,name,' . $county->id],
        ]));

        return redirect()->route('counties.index')->with('success', 'A megye sikeresen módosítva lett.');
    }

    public function destroy(County $county): RedirectResponse
    {
        if ($county->cities()->exists()) {
            return redirect()->route('counties.index')->with('error', 'A megye nem törölhető, mert városok tartoznak hozzá.');
        }

        $county->delete();

        return redirect()->route('counties.index')->with('success', 'A megye sikeresen törölve lett.');
    }
}
