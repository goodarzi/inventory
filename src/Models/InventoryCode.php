<?php

namespace Goodarzi\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryCode extends Model
{
    
    protected $table = 'inventory_codes';
    protected $fillable = [
        'code',
        'stock_id',
        'qty',
        'sku',
        'user_id',
    ];
    public function stock()
    {
        return $this->belongsTo('Goodarzi\Inventory\Models\Stock');
    }
    public function product()
    {
        return $this->belongsTo('Goodarzi\Inventory\Models\Product');
    }
}
