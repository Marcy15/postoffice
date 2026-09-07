<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Population;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PopulationController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search'));

        $populations = Population::query()
            ->with('cityRecord.county')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('population', 'like', '%' . $search . '%')
                        ->orWhereHas('cityRecord', function ($cityQuery) use ($search) {
                            $cityQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('zip_code', 'like', '%' . $search . '%')
                                ->orWhereHas('county', fn ($countyQuery) => $countyQuery->where('name', 'like', '%' . $search . '%'));
                        });
                });
            })
            ->orderBy('id')
            ->paginate(25)
            ->withQueryString();

        return view('population.index', compact('populations', 'search'));
    }

    public function create(): View
    {
        $cities = City::with('county')->orderBy('id')->get();

        return view('population.create', compact('cities'));
    }

    public function store(Request $request): RedirectResponse
    {
        Population::create($this->validatedData($request));

        return redirect()->route('population.index')->with('success', 'A lakossági adat sikeresen létrejött.');
    }

    public function edit(Population $population): View
    {
        $cities = City::with('county')->orderBy('id')->get();

        return view('population.edit', compact('population', 'cities'));
    }

    public function update(Request $request, Population $population): RedirectResponse
    {
        $population->update($this->validatedData($request, $population));

        return redirect()->route('population.index')->with('success', 'A lakossági adat sikeresen módosítva lett.');
    }

    public function destroy(Population $population): RedirectResponse
    {
        $population->delete();

        return redirect()->route('population.index')->with('success', 'A lakossági adat sikeresen törölve lett.');
    }

    public function generate(): RedirectResponse
    {
        $rows = City::query()
            ->select('id')
            ->orderBy('id')
            ->get()
            ->map(fn (City $city) => [
                'city' => $city->id,
                'population' => random_int(100, 200000),
            ])
            ->all();

        DB::transaction(function () use ($rows): void {
            Population::query()->delete();

            foreach (array_chunk($rows, 500) as $chunk) {
                Population::query()->insert($chunk);
            }
        });

        return redirect()->route('population.index')->with('success', count($rows) . ' város lakossági adata véletlen értékekkel feltöltve.');
    }

    private function validatedData(Request $request, ?Population $population = null): array
    {
        $cityRule = 'unique:population,city';

        if ($population !== null) {
            $cityRule .= ',' . $population->id;
        }

        return $request->validate([
            'city' => ['required', 'exists:cities,id', $cityRule],
            'population' => ['required', 'integer', 'min:0', 'max:10000000'],
        ]);
    }
}
