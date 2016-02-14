<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeInputType extends Model
{
    public $table = 'attribute_input_types';
    
    public function getOperation()
    {
        $operation = '=';
        
        if($this->type == 'range')
            $operation = 'BETWEEN';
        
        return $operation;
    }
}
