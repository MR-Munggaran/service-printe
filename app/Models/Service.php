<?php

// app/Models/Service.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Service extends Model
{
    protected $fillable = ['item_id', 'customer_id', 'description', 'service_date', 'status'];
    
    protected $casts = [
        'service_date' => 'date:Y-m-d',
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
