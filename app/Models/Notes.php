<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $table='notes';
    protected $fillable=[
        'note',
        'periode',
        'type',
        'coefficient',
        'matiere_id',
        'professeur_id',
        'eleve_id',
    ];
   public function matiere() {
    return $this->belongsTo(Matiere::class);
}
public function prof() {
    return $this->belongsTo(Professeur::class, 'professeur_id');
}
public function elev() {
    return $this->belongsTo(Eleve::class, 'eleve_id');
}

}
