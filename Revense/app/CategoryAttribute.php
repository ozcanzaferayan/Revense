<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{
    public function inputType()
    {
        return $this->hasOne('App\AttributeInputType', 'id', 'input_type_id');
    }
}
