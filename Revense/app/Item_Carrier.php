<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_Carrier extends Item
{
    protected $guarded = [];
    public $table = 'item_carriers';
    
    public function item()
    {
        return $this->morphOne('App\Item', 'itemable');
    }
}
