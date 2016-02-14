<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_MobilePhone extends Item
{
    protected $guarded = [];
    public $table = 'item_mobilephones';
    
    public function item()
    {
        return $this->morphOne('App\Item', 'itemable');
    }
}
