<?php

namespace Goodarzi\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table = 'sources';
    protected $fillable = [
        'name',
        'user_id',
    ];
}
