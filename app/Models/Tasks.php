<?php

namespace App\Models;

// on importe le coreCodel de lumen
use Illuminate\Database\Eloquent\Model;

//ici mon modèle Category hérite du "coreModele "Model"

class Tasks extends Model
{
    // 1 tâche est lié à une seule catégorie
    // => One to Many (inverse)
    // https://laravel.com/docs/7.x/eloquent-relationships#one-to-many-inverse
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
