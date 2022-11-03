<?php

namespace App\Models;

use App\Models\Category;
use App\Models\SaleDetail;
use App\Models\DishIngredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dish extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'cost',
        'price',
        'cal',
        'category_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cost' => 'double',
        'price' => 'double',
        'category_id' => 'integer',
    ];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function dishIngredients()
    {
        return $this->hasMany(DishIngredient::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
