<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['category_id', 'name', 'brand', 'purchase_price', 'selling_price', 'satuan_barang', 'stock'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
