<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annee extends Model
{
    protected $table='annees';

    protected $fillable=['libelle',];

    public function periodes()
{
    return $this->hasMany(Periode::class);
}
 public function professeurs()
{
    return $this->belongsToMany(Professeur::class, 'class_prof_annee', 'annee_id', 'professeur_id')
                ->withPivot('classe_id')
                ->withTimestamps();
}
 
public function educateurs()
{
    return $this->belongsToMany(Educateur::class, 'class_annee_educateur', 'annee_id', 'educateur_id')
                ->withPivot('classe_id')
                ->withTimestamps();
}
public function classesProfesseurs()
{
    return $this->hasMany(ClassProfAnnee::class);
}
}
