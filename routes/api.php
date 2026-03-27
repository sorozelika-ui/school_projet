<?php
use App\Http\Controllers\EleveController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\AnneeController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EducateurController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ParentEleveController;
use App\Http\Controllers\EleveParentController;
use App\Http\Controllers\ClassProfAnneeController;
use App\Http\Controllers\ClassAnneeEducateurController;

Route::apiResource('classes', ClasseController::class);
Route::apiResource('matieres', MatiereController::class);
Route::apiResource('notes', NoteController::class);
Route::apiResource('parents', ParentEleveController::class);
Route::apiResource('professeurs', ProfesseurController::class);
Route::apiResource('annees', AnneeController::class);
Route::apiResource('educateurs', EducateurController::class);
Route::apiResource('eleves', EleveController::class);
Route::apiResource('eleve-parent', EleveParentController::class);
Route::apiResource('class-prof-annee', ClassProfAnneeController::class);
Route::apiResource('class-educ-annee', ClassAnneeEducateurController::class);


// // Route::apiResource('eleves', EleveController::class);

// // Lister tous les élèves
// Route::get('/eleves', [EleveController::class, 'index']);

// // Ajouter un élève
// Route::post('/eleves', [EleveController::class, 'store']);

// // Voir un élève spécifique
// Route::get('/eleves/{eleve}', [EleveController::class, 'show']);

// // Modifier un élève
// Route::put('/eleves/{eleve}', [EleveController::class, 'update']);
// Route::patch('/eleves/{eleve}', [EleveController::class, 'update']);

// // Supprimer un élève
// Route::delete('/eleves/{eleve}', [EleveController::class, 'destroy']);

// // Route::apiResource('classe', ClasseController::class);
//     Route::get('/', [ClasseController::class, 'index']);
//     Route::post('/', [ClasseController::class, 'store']);
//     Route::get('/{classe}', [ClasseController::class, 'show'])->whereNumber('id');;
//     Route::put('/{classe}', [ClasseController::class, 'update']);
//     Route::patch('/{classe}', [ClasseController::class, 'update']);
//     Route::delete('/{classe}', [ClasseController::class, 'destroy']);
    
//    // Route::apiResource('annee', AnneeController::class);
//     Route::get('/', [AnneeController::class, 'index']);
//     Route::post('/', [AnneeController::class, 'store']);
//     Route::get('/{annee}', [AnneeController::class, 'show']);
//     Route::put('/{annee}', [AnneeController::class, 'update']);
//     Route::patch('/{annee}', [AnneeController::class, 'update']);
//     Route::delete('/{annee}', [AnneeController::class, 'destroy']);

//      // Route::apiResource('educateur', EducateurController::class);
//     Route::get('/', [EducateurController::class, 'index']);
//     Route::post('/edu', [EducateurController::class, 'store']);
//     Route::get('/{educateur}', [EducateurController::class, 'show']);
//     Route::put('/{educateur}', [EducateurController::class, 'update']);
//     Route::patch('/{educateur}', [EducateurController::class, 'update']);
//     Route::delete('/{educateur}', [EducateurController::class, 'destroy']);

//       // Route::apiResource('Professeur',ProfesseurController::class);
//     Route::get('/', [ProfesseurController::class, 'index']);
//     Route::post('/', [ProfesseurController::class, 'store']);
//     Route::get('/{Professeur}', [ProfesseurController::class, 'show']);
//     Route::put('/{Professeur}', [ProfesseurController::class, 'update']);
//     Route::patch('/{Professeur}', [ProfesseurController::class, 'update']);
//     Route::delete('/{Professeur}', [ProfesseurController::class, 'destroy']);

//      // Route::apiResource('matiere',MatiereController::class);
//     Route::get('/', [MatiereController::class, 'index']);
//     Route::post('/', [MatiereController::class, 'store']);
//     Route::get('/{matiere}', [MatiereController::class, 'show']);
//     Route::put('/{matiere}', [MatiereController::class, 'update']);
//     Route::patch('/{matiere}', [MatiereController::class, 'update']);
//     Route::delete('/{matiere}', [MatiereController::class, 'destroy']);

//      // Route::apiResource('note',NoteController::class);
//     Route::get('/', [NoteController::class, 'index']);
//     Route::post('/', [NoteController::class, 'store']);
//     Route::get('/{note}', [NoteController::class, 'show']);
//     Route::put('/{note}', [NoteController::class, 'update']);
//     Route::patch('/{note}', [NoteController::class, 'update']);
//     Route::delete('/{note}', [NoteController::class, 'destroy']);

//     // Route::apiResource('parent',ParentEleveController::class);
//     Route::get('/', [ParentEleveController::class, 'index']);
//     Route::post('/', [ParentEleveController::class, 'store']);
//     Route::get('/{parent}', [ParentEleveController::class, 'show']);
//     Route::put('/{parent}', [ParentEleveController::class, 'update']);
//     Route::patch('/{parent}', [ParentEleveController::class, 'update']);
//     Route::delete('/{parent}', [ParentEleveController::class, 'destroy']);

//     Route::apiResource('eleve-parents', EleveParentController::class)->only([
//         'index',
//         'store',
//         'destroy'
//     ]);

     