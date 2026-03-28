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


     
// Route de connexion
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

Route::post('/login', function (Request $request) {
    $email = $request->email;
    $password = $request->password;

    $parent = \App\Models\ParentEleve::where('email_pere', $email)
        ->orWhere('email_mere', $email)
        ->first();

    if (!$parent) {
        return response()->json(['message' => 'Email introuvable'], 404);
    }

    $isPere = $parent->email_pere === $email;
    $passwordHash = $isPere ? $parent->pass_pere : $parent->pass_mere;

    if (!Hash::check($password, $passwordHash)) {
        return response()->json(['message' => 'Mot de passe incorrect'], 401);
    }

    return response()->json([
        'id'     => $parent->id,
        'nom'    => $isPere ? $parent->nom_pere : $parent->nom_mere,
        'prenom' => $isPere ? $parent->prenom_pere : $parent->prenom_mere,
        'email'  => $email,
        'role'   => $isPere ? 'pere' : 'mere',
    ]);
});
