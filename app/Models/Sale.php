<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'total',
        'table_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'total' => 'double',
        'table_id' => 'integer',
    ];

    public function cashierSales()
    {
        return $this->hasMany(CashierSale::class);
    }

    public function waiterSales()
    {
        return $this->hasMany(WaiterSale::class);
    }

    public function chefSales()
    {
        return $this->hasMany(ChefSale::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
