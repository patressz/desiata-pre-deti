<?php

namespace App\Http\Controllers\Admin;

use App\Models\Allergen;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAllergenRequest;
use App\Http\Controllers\Controller;

class AllergenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allergens = Allergen::all();

        return view('admin.allergens', compact('allergens',) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add-allergen');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAllergenRequest $request)
    {
        Allergen::create([
            'allergen' => $request->allergen,
            'allergen_id' => $request->allergen_id,
        ]);

        return redirect()->route('allergens.index')->withStatus('Alergén bol úspešne pridaný.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Allergen  $allergen
     * @return \Illuminate\Http\Response
     */
    public function show(Allergen $allergen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Allergen  $allergen
     * @return \Illuminate\Http\Response
     */
    public function edit(Allergen $allergen)
    {
        return view('admin.edit-allergen', compact('allergen',) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Allergen  $allergen
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAllergenRequest $request, Allergen $allergen)
    {
        $allergen->update([
            'allergen' => $request->allergen,
            'allergen_id' => $request->allergen_id,
        ]);

        return redirect()->route('allergens.index')->withStatus('Alergén bol úspešne aktualizovaný.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Allergen  $allergen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allergen $allergen)
    {
        $allergen->delete();

        return redirect()->route('allergens.index')->withStatus('Alergén bol úspešne zmazaný.');
    }
}
