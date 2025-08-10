<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Technicien;

class TechnicienController extends Controller
{
    public function index()
    {
        $techniciens = Technicien::all();
        return view('techniciens.index', compact('techniciens'));
    }

    public function create()
    {
        return view('techniciens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
        ]);

        Technicien::create($request->all());

        return redirect()->route('techniciens.index')->with('success', 'Technicien ajouté.');
    }

    public function edit(Technicien $technicien)
    {
        return view('techniciens.edit', compact('technicien'));
    }

    public function update(Request $request, Technicien $technicien)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
        ]);

        $technicien->update($request->all());

        return redirect()->route('techniciens.index')->with('success', 'Technicien mis à jour.');
    }

    public function destroy(Technicien $technicien)
    {
        $technicien->delete();
        return redirect()->route('techniciens.index')->with('success', 'Technicien supprimé.');
    }
}