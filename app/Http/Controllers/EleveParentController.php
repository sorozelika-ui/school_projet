<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleve_Parent;

class EleveParentController extends Controller
{
    /**
     * Liste toutes les relations élève-parent
     */
    public function index()
    {
        $relations = Eleve_Parent::with(['eleve', 'parent'])->get();
        return response()->json($relations, 200);
    }

    /**
     * Crée une nouvelle relation élève-parent
     */
    public function store(Request $request)
    {
        $request->validate([
            'eleves_id' => 'required|exists:eleves,id',
            'parent_id' => 'required|exists:parent_eleves,id',
        ]);

        // Empêche la duplication
        $exists = Eleve_Parent::where('eleves_id', $request->eleves_id)
                             ->where('parent_id', $request->parent_id)
                             ->first();

        if ($exists) {
            return response()->json([
                'message' => 'Cette relation élève-parent existe déjà.'
            ], 409);
        }

        $relation = Eleve_Parent::create([
            'eleves_id' => $request->eleves_id,
            'parent_id' => $request->parent_id,
        ]);

        return response()->json([
            'message' => 'Relation élève-parent créée avec succès.',
            'data' => $relation
        ], 201);
    }

    /**
     * Affiche une relation spécifique
     */
    public function show(Eleve_Parent $eleveParent)
    {
        return response()->json(
            $eleveParent->load(['eleve', 'parent']),
            200
        );
    }

    /**
     * Met à jour une relation élève-parent
     */
    public function update(Request $request, Eleve_Parent $eleveParent)
    {
        $request->validate([
            'eleves_id' => 'sometimes|required|exists:eleves,id',
            'parent_id' => 'sometimes|required|exists:parent_eleves,id',
        ]);

        // Empêche la duplication après modification
        if ($request->has(['eleves_id', 'parent_id'])) {
            $exists = Eleve_Parent::where('eleves_id', $request->eleves_id)
                                 ->where('parent_id', $request->parent_id)
                                 ->where('id', '!=', $eleveParent->id)
                                 ->first();
            if ($exists) {
                return response()->json([
                    'message' => 'Cette relation élève-parent existe déjà.'
                ], 409);
            }
        }

        $eleveParent->update($request->only(['eleves_id', 'parent_id']));

        return response()->json([
            'message' => 'Relation élève-parent mise à jour avec succès.',
            'data' => $eleveParent
        ], 200);
    }

    /**
     * Supprime une relation élève-parent
     */
    public function destroy(Eleve_Parent $eleveParent)
    {
        $eleveParent->delete();

        return response()->json([
            'message' => 'Relation élève-parent supprimée avec succès.'
        ], 200);
    }
}



// namespace App\Http\Controllers;

// use App\Models\Eleve_Parent;
// use Illuminate\Http\Request;

// class EleveParentController extends Controller
// {
//     /**
//      * Liste des relations élève-parent
//      */
//     public function index()
//     {
//         return response()->json(Eleve_Parent::all(), 200);
//     }

//     /**
//      * Associer un élève à un parent
//      */
//     public function store(Request $request)
//     {
//         $request->validate([
//             'eleves_id' => 'required|exists:eleves,id',
//             'parent_id' => 'required|exists:parent_eleves,id',
//         ]);

//         $relation = Eleve_Parent::create([
//             'eleves_id' => $request->eleves_id,
//             'parent_id' => $request->parent_id,
//         ]);

//         return response()->json([
//             'message' => 'Relation élève-parent créée avec succès',
//             'data' => $relation
//         ], 201);
//     }

//     /**
//      * Supprimer une relation
//      */
//     public function destroy(Eleve_Parent $eleve_parent)
//     {
//         $eleve_parent->delete();

//         return response()->json([
//             'message' => 'Relation supprimée avec succès'
//         ], 200);
//     }
// }
