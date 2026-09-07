<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CountyController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search'));

        $counties = County::query()
            ->withCount('cities')
            ->when($search !== '', fn ($query) => $query->where('name', 'like', '%' . $search . '%'))
            ->orderBy('id')
            ->paginate(20)
            ->withQueryString();

        return view('counties.index', compact('counties', 'search'));
    }

    public function create(): View
    {
        return view('counties.create');
    }

    public function store(Request $request): RedirectResponse
    {
        County::create($this->validatedData($request));

        return redirect()->route('counties.index')->with('success', 'A megye sikeresen létrejött.');
    }

    public function edit(County $county): View
    {
        return view('counties.edit', compact('county'));
    }

    public function update(Request $request, County $county): RedirectResponse
    {
        $county->update($this->validatedData($request, $county));

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

    private function validatedData(Request $request, ?County $county = null): array
    {
        $nameRule = 'unique:counties,name';

        if ($county !== null) {
            $nameRule .= ',' . $county->id;
        }

        return $request->validate([
            'name' => ['required', 'string', 'max:50', $nameRule],
            'crest_url' => ['nullable', 'url', 'max:2048'],
        ]);
    }
}
