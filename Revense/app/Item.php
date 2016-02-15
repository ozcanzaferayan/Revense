<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;
    public $table = 'items';
    protected $morphClass = 'Item';
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment', 'item_id', 'id');
    }
    
    public function itemable()
    {
        return $this->morphTo();
    }
    
    public function getTable()
    {
        return $this->table;
    }
    
    public static function getBySlug($slug){
//        $item = Item::whereHas('slugTranslation', function($q) use($slug){
//            $q->where('trValue', $slug); 
//        })->orWhereHas('slugTranslation', function($q) use($slug){
//            $q->where('enValue', $slug); 
//        })->first();
        
        $item = Item::where('trSlug', '=', $slug)->orWhere('enSlug', '=', $slug)->first();
        
        return $item;
    }
}
