<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicule extends Model
{
   use HasFactory;

   protected $fillable = [
    'immatriculation',
    'marque',
    'modele',
    'couleur',
    'annee',
    'kilometrage',
    'carosserie',
    'energie',
    'boite'];
}
