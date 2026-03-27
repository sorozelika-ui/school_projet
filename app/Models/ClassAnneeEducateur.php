<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassAnneeEducateur extends Model
{
    protected $table = 'class_annee_educateur';

    protected $fillable = [
        'classe_id',
        'annee_id',
        'educateur_id'
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function annee()
    {
        return $this->belongsTo(Annee::class);
    }

    public function educateur()
    {
        return $this->belongsTo(Educateur::class);
    }
}