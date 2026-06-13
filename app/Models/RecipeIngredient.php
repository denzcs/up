<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    protected $fillable = [
        'quantity',
    ];
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
