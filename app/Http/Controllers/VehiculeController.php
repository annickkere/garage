<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    public function index()
    {
        $vehicules = Vehicule::all();
        return view('vehicules.index', compact('vehicules'));
    }

    public function create()
    {
        return view('vehicules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'immatriculation' => 'required|string|unique:vehicules',
            'marque' => 'required|string',
            'modele' => 'required|string',
            'couleur' => 'required|string',
            'annee' => 'required|integer',
            'kilometrage' => 'required|integer',
            'carosserie' => 'required|string',
            'energie' => 'required|string',
            'boite' => 'required|string',
        ]);

        Vehicule::create($request->all());

        return redirect()->route('vehicules.index')->with('success', 'Véhicule ajouté.');
    }

    public function edit(Vehicule $vehicule)
    {
        return view('vehicules.edit', compact('vehicule'));
    }

    public function update(Request $request, Vehicule $vehicule)
    {
        $request->validate([
            'immatriculation' => 'required|string|unique:vehicules,immatriculation,' . $vehicule->id,
            'marque' => 'required|string',
            'modele' => 'required|string',
            'couleur' => 'required|string',
            'annee' => 'required|integer',
            'kilometrage' => 'required|integer',
            'carosserie' => 'required|string',
            'energie' => 'required|string',
            'boite' => 'required|string',
        ]);

        $vehicule->update($request->all());

        return redirect()->route('vehicules.index')->with('success', 'Véhicule mis à jour.');
    }

    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();
        return redirect()->route('vehicules.index')->with('success', 'Véhicule supprimé.');
    }
}