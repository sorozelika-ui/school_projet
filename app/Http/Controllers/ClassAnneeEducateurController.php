<?php

namespace App\Http\Controllers;

use App\Models\ClassAnneeEducateur;
use Illuminate\Http\Request;

class ClassAnneeEducateurController extends Controller
{
    // 🔹 Liste
    public function index()
    {
        return ClassAnneeEducateur::with([
            'classe',
            'annee',
            'educateur'
        ])->get();
    }

    // 🔹 Ajouter
    public function store(Request $request)
    {
        $request->validate([
            'classe_id'     => 'required|exists:classes,id',
            'annee_id'      => 'required|exists:annees,id',
            'educateur_id'  => 'required|exists:educateurs,id',
        ]);

        // Sécurité anti-duplication
        $exists = ClassAnneeEducateur::where('classe_id', $request->classe_id)
            ->where('annee_id', $request->annee_id)
            ->where('educateur_id', $request->educateur_id)
            ->first();

        if ($exists) {
            return response()->json([
                'message' => 'Cette association existe déjà.'
            ], 409);
        }

        $data = ClassAnneeEducateur::create($request->all());

        return response()->json([
            'message' => 'Association créée avec succès',
            'data' => $data
        ], 201);
    }

    // 🔹 Supprimer
    public function destroy($id)
    {
        $relation = ClassAnneeEducateur::findOrFail($id);
        $relation->delete();

        return response()->json([
            'message' => 'Association supprimée'
        ]);
    }
}