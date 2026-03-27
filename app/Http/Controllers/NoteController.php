<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;
use App\Models\Eleve;
use App\Models\Matiere;
use Barryvdh\DomPDF\Facade\Pdf;

class NoteController extends Controller
{
    /**
     * Lister toutes les notes
     */
    public function index()
    {
        $notes = Notes::with(['elev', 'prof', 'matiere'])->get();
        return response()->json($notes, 200);
    }

    /**
     * Ajouter une note
     */
    public function store(Request $request)
    {
        $request->validate([
            'eleve_id' => 'required|exists:eleves,id',
            'professeur_id' => 'required|exists:professeurs,id',
            'matiere_id' => 'required|exists:matieres,id',
            'note' => 'required|numeric|min:0|max:20',
            'periode' => 'required|string|max:50',
            'type' => 'required|in:interrogation,devoir_classe,devoir_niveau'
        ]);

        // Définir le coefficient selon le type
        $coefficient = match($request->type) {
            'interrogation' => 0.5,
            'devoir_classe' => 1,
            'devoir_niveau' => 2,
        };

        $note = Notes::create([
            'eleve_id' => $request->eleve_id,
            'professeur_id' => $request->professeur_id,
            'matiere_id' => $request->matiere_id,
            'note' => $request->note,
            'periode' => $request->periode,
            'type' => $request->type,
            'coefficient' => $coefficient,
        ]);

        return response()->json([
            'message' => 'Note ajoutée avec succès',
            'data' => $note
        ], 201);
    }

    /**
     * Afficher une note
     */
    public function show(Notes $note)
    {
        return response()->json($note->load(['eleve', 'prof', 'matiere']), 200);
    }

    /**
     * Modifier une note
     */
    public function update(Request $request, Notes $note)
    {
        $request->validate([
            'note' => 'sometimes|required|numeric|min:0|max:20',
            'periode' => 'sometimes|required|string|max:50',
            'type' => 'sometimes|required|in:interrogation,devoir_classe,devoir_niveau'
        ]);

        if ($request->has('type')) {
            $note->coefficient = match($request->type) {
                'interrogation' => 0.5,
                'devoir_classe' => 1,
                'devoir_niveau' => 2,
            };
        }

        $note->update($request->only(['note', 'periode', 'type', 'coefficient']));

        return response()->json([
            'message' => 'Note modifiée avec succès',
            'data' => $note
        ], 200);
    }

    /**
     * Supprimer une note
     */
    public function destroy(Notes $note)
    {
        $note->delete();
        return response()->json([
            'message' => 'Note supprimée avec succès'
        ], 200);
    }

    /**
     * Moyenne par matière pour un élève et un trimestre
     */
    public function moyenneParMatiere($eleveId, $matiereId, $periode)
    {
        $notes = Notes::where('eleve_id', $eleveId)
            ->where('matiere_id', $matiereId)
            ->where('periode', $periode)
            ->get();

        $totalPoints = $notes->sum(fn($n) => $n->note * $n->coefficient);
        $totalCoef = $notes->sum('coefficient');

        $moyenne = $totalCoef > 0 ? round($totalPoints / $totalCoef, 2) : 0;

        return response()->json(['moyenne' => $moyenne], 200);
    }

    /**
     * Moyenne générale pour un élève sur toutes les matières
     */
    public function moyenneGenerale($eleveId, $periode)
    {
        $notes = Notes::where('eleve_id', $eleveId)
            ->where('periode', $periode)
            ->get();

        $totalPoints = $notes->sum(fn($n) => $n->note * $n->coefficient);
        $totalCoef = $notes->sum('coefficient');

        $moyenne = $totalCoef > 0 ? round($totalPoints / $totalCoef, 2) : 0;

        return response()->json(['moyenne_generale' => $moyenne], 200);
    }

    /**
     * Classement de tous les élèves d'une classe pour un trimestre
     */
    public function classement($classeId, $periode)
    {
        $eleves = Eleve::where('classe_id', $classeId)->get();

        $resultats = $eleves->map(function ($eleve) use ($periode) {
            $notes = Notes::where('eleve_id', $eleve->id)
                ->where('periode', $periode)
                ->get();

            $totalPoints = $notes->sum(fn($n) => $n->note * $n->coefficient);
            $totalCoef = $notes->sum('coefficient');

            $moyenne = $totalCoef > 0 ? round($totalPoints / $totalCoef, 2) : 0;

            return [
                'eleve' => $eleve,
                'moyenne' => $moyenne
            ];
        });

        $classement = $resultats->sortByDesc('moyenne')->values();

        return response()->json($classement, 200);
    }

    /**
     * Générer bulletin PDF pour un élève
     */
    public function genererBulletin($eleveId, $periode)
    {
        $eleve = Eleve::findOrFail($eleveId);

        // Moyenne générale
        $notes = Notes::where('eleve_id', $eleveId)
            ->where('periode', $periode)
            ->get();

        $totalPoints = $notes->sum(fn($n) => $n->note * $n->coefficient);
        $totalCoef = $notes->sum('coefficient');
        $moyenneGenerale = $totalCoef > 0 ? round($totalPoints / $totalCoef, 2) : 0;

        $data = [
            'eleve' => $eleve,
            'periode' => $periode,
            'moyenneGenerale' => $moyenneGenerale,
            'notes' => $notes
        ];

        $pdf = Pdf::loadView('bulletin', $data);

        return $pdf->download('bulletin_'.$eleve->nom.'.pdf');
    }
}