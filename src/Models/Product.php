<?php

namespace Goodarzi\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'sku',
        'name',
        'qty',
        'user_id',
    ];

    public function inventoryCodes()
    {
        return $this->hasMany('Goodarzi\Inventory\Models\InventoryCode', 'sku', 'sku');
    }
}
