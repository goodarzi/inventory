<?php

namespace Goodarzi\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    protected $table = 'inventory_transactions';
    protected $fillable = [
        'sku',
        'type',
        'qty',
        'product_qty',
        'inventory_code_qty',
        'description',
        'user_id',
        'stock_id',
        'inventory_code',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function inventoryCode()
    {
        return $this->belongsTo('Goodarzi\Inventory\Models\InventoryCode', 'inventory_code', 'code');
    }

    public function stock()
    {
        return $this->belongsTo('Goodarzi\Inventory\Models\Stock');
    }

    public function product()
    {
        return $this->belongsTo('Goodarzi\Inventory\Models\Product', 'sku' ,'sku');
    }

}
