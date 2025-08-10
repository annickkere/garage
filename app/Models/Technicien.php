<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Technicien extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'specialite'];

    public function reparations()
    {
        return $this->belongsToMany(Reparation::class);
    }
}
