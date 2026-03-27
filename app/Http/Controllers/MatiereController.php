<?php

namespace App\Http\Controllers;
use App\Models\Matiere;
use App\Models\Notes;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Matiere::with(['notes'])->get();
        return response()->json($classes, 200);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'libelle' => 'required|string|max:255|unique:notes,libelle',
        ]);

        $classe = Matiere::create([
            'libelle' => $request->libelle,
        ]);

        return response()->json([
            'message' => 'Matiere créée avec succès',
            'data' => $classe
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
       return response()->json(
            $classe->load(['notes']),
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classe $classe)
    {
        $request->validate([
            'libelle' => 'sometimes|required|string|max:255|unique:classes,libelle,' . $classe->id,
        ]);

        $classe->update($request->only('libelle'));

        return response()->json([
            'message' => 'Matiere modifiée avec succès',
            'data' => $classe
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
               // Sécurité : empêcher suppression si la classe contient des élèves
        if ($classe->eleves()->count() > 0) {
            return response()->json([
                'message' => 'Impossible de supprimer une Matiere contenant des notes'
            ], 400);
        }

        $classe->delete();

        return response()->json([
            'message' => 'Matiere supprimée avec succès'
        ], 200);

    }
}
