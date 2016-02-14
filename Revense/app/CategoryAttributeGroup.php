<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryAttributeGroup extends Model
{
    public function categoryAttributes()
    {
        return $this->hasMany('App\CategoryAttribute', 'group_id');
    }
}
