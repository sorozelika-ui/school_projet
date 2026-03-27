<?PHP
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table='classes';
    protected $fillable = ['libelle'];

    public function eleves() 
    {
        return $this->hasMany(Eleve::class);
    }
    public function professeurs()
{
    return $this->belongsToMany(Professeur::class, 'class_prof_annee', 'classe_id', 'professeur_id')
                ->withPivot('annee_id')
                ->withTimestamps();
}
public function educateurs()
{
    return $this->belongsToMany(Educateur::class, 'class_annee_educateur', 'classe_id', 'educateur_id')
                ->withPivot('annee_id')
                ->withTimestamps();
}
public function professeursAnnee()
{
    return $this->hasMany(ClassProfAnnee::class);
}

}
