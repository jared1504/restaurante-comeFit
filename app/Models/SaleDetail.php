<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'amount',
        'price',
        'subtotal',
        'dish_id',
        'sale_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'amount' => 'double',
        'price' => 'double',
        'subtotal' => 'double',
        'dish_id' => 'integer',
        'sale_id' => 'integer',
    ];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
