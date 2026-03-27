<?php

namespace App\Http\Controllers;

use App\Models\ClassProfAnnee;
use Illuminate\Http\Request;

class ClassProfAnneeController extends Controller
{
    // 🔹 Lister
    public function index()
    {
        return ClassProfAnnee::with(['professeur', 'classe', 'annee'])->get();
    }

    // 🔹 Ajouter
    public function store(Request $request)
    {
        $request->validate([
            'professeur_id' => 'required|exists:professeurs,id',
            'classe_id'     => 'required|exists:classes,id',
            'annee_id'      => 'required|exists:annees,id'
        ]);

        $data = ClassProfAnnee::create($request->all());

        return response()->json([
            'message' => 'Association créée avec succès',
            'data' => $data
        ], 201);
    }

    // 🔹 Supprimer
    public function destroy($id)
    {
        $relation = ClassProfAnnee::findOrFail($id);
        $relation->delete();

        return response()->json([
            'message' => 'Association supprimée'
        ]);
    }
}