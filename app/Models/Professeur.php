<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Professeur extends Model
{
    use HasFactory;

    protected $table='professeurs';
    protected $fillable = [
        'nom',
        'prenom',
        'contact',
        'email',
        'pass_prof',
        'info_prof',
    ];

    // Relation future avec classes et années
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'class_prof_annee', 'professeur_id', 'classe_id')
                    ->withPivot('annee_id')
                    ->withTimestamps();
    }
    public function classesAnnee()
{
    return $this->hasMany(ClassProfAnnee::class);
}
}
