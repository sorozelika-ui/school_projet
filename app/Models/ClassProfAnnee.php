<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassProfAnnee extends Model
{
    protected $table = 'class_prof_annee';

    protected $fillable = [
        'professeur_id',
        'classe_id',
        'annee_id'
    ];

    // Relations
    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function annee()
    {
        return $this->belongsTo(Annee::class);
    }
}