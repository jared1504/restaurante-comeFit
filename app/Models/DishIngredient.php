<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishIngredient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'dish_id',
        'ingredient_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'amount' => 'double',
        'dish_id' => 'integer',
        'ingredient_id' => 'integer',
    ];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
