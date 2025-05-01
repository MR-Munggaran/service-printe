<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class Bill extends Model
{
    protected $fillable = ['item_id', 'customer_id', 'amount', 'total', 'period'];

    protected $casts = [
        'period' => 'date:Y-m-d', // Pastikan period selalu menjadi Carbon
    ];
    
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
