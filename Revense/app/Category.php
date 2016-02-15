<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{   
    protected $guarded = array('tableName');
    public function items()
    {
        return $this->hasMany('App\Item');
    }
    
    public function getItems()
    {
        $modelName = ('App\\' . $this->modelName);
        $model = new $modelName;
        
        return DB::table('items')
            ->join($model->getTable(), 'items.itemable_id', '=', $model->getTable() . '.id')
            ->where('items.category_id', '=', $this->id);
        
//        $objects = DB::select('select items.*, '. $model->getTable() . '.*, translations.* from items 
//                                LEFT JOIN '. $model->getTable() . ' 
//                                ON items.itemable_id = '. $model->getTable() . '.id
//                                LEFT JOIN translations ON items.name = translations.translationKey');
//        
//        $objArray = array();
//        $objArray = $modelName::hydrate($objects);
//        return $objArray;
        
//        return Item::select('items.name')->join($model->getTable(), 'items.itemable_id', '=', $model->getTable() . '.id')->getQuery()->get();
        
//        return Item::with('itemable')->get();
        
    }
    
    public function categories()
    {
        return $this->hasMany('App\Category', 'parentCategory');
    }
    
    public function attributes()
    {
        return $this->hasMany('App\CategoryAttribute');
    }
    
    public function parentCategory()
    {
        return $this->belongsTo('App\Category', 'parentCategory');
    }
    
    public static function getBySlug($slug){
//        $category = Category::whereHas('slugTranslation', function($q) use($slug){
//            $q->where('trValue', $slug); 
//        })->orWhereHas('slugTranslation', function($q) use($slug){
//            $q->where('enValue', $slug); 
//        })->first();
        
        $category = Category::where('trSlug', '=', $slug)->orWhere('enSlug', '=', $slug)->first();
        
        return $category;
    }
}
