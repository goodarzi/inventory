<?php

namespace Goodarzi\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $fillable = [
        'name',
        'source_id',
        'user_id',
    ];
    public function source()
    {
        return $this->belongsTo('Goodarzi\Inventory\Models\Source');
    }
}
