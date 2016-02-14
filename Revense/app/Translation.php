<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Custom\Extend;

class Translation extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'translationKey';
    
    public static function createNew($trValue, $enValue)
    {
        $guid = Extend::generateGuid();
        
        Translation::create([
            'translationKey' => $guid,
            'trValue' => $trValue,
            'enValue' => $enValue
        ]);
        
        return $guid;
    }
}
