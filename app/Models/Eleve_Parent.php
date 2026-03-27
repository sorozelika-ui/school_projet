<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eleve_Parent extends Model
{
    protected $table='eleve_parent';
    protected $fillable=[
        'eleves_id',
        'parent_id'
    ];
     // Relation vers l'élève
    public function eleve()
    {
        return $this->belongsTo(\App\Models\Eleve::class, 'eleves_id');
    }

    // Relation vers le parent
    public function parent()
    {
        return $this->belongsTo(\App\Models\ParentEleve::class, 'parent_id');
    }
}
