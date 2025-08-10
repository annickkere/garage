<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reparation;
use App\Models\Vehicule;
use App\Models\Technicien;
use Illuminate\Http\Request;

class ReparationController extends Controller
{
    public function index()
    {
        $reparations = Reparation::with('vehicule', 'techniciens')->get();
        return view('reparations.index', compact('reparations'));
    }

    public function create()
    {
        $vehicules = Vehicule::all();
        $techniciens = Technicien::all();
        return view('reparations.create', compact('vehicules', 'techniciens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicule_id' => 'required|exists:vehicules,id',
            'date' => 'required|date',
            'duree_main_oeuvre' => 'required|string',
            'objet_reparation' => 'required|string',
            'techniciens' => 'array',
        ]);

        $reparation = Reparation::create($request->only('vehicule_id', 'date', 'duree_main_oeuvre', 'objet_reparation'));
        $reparation->techniciens()->sync($request->input('techniciens', []));

        return redirect()->route('reparations.index')->with('success', 'Réparation enregistrée.');
    }

    public function edit(Reparation $reparation)
    {
        $vehicules = Vehicule::all();
        $techniciens = Technicien::all();
        $selectedTechniciens = $reparation->techniciens->pluck('id')->toArray();

        return view('reparations.edit', compact('reparation', 'vehicules', 'techniciens', 'selectedTechniciens'));
    }

    public function update(Request $request, Reparation $reparation)
    {
        $request->validate([
            'vehicule_id' => 'required|exists:vehicules,id',
            'date' => 'required|date',
            'duree_main_oeuvre' => 'required|string',
            'objet_reparation' => 'required|string',
            'techniciens' => 'array',
        ]);

        $reparation->update($request->only('vehicule_id', 'date', 'duree_main_oeuvre', 'objet_reparation'));
        $reparation->techniciens()->sync($request->input('techniciens', []));

        return redirect()->route('reparations.index')->with('success', 'Réparation mise à jour.');
    }

    public function destroy(Reparation $reparation)
    {
        $reparation->techniciens()->detach();
        $reparation->delete();

        return redirect()->route('reparations.index')->with('success', 'Réparation supprimée.');
    }
}