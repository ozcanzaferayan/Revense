<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use App\Translation;
use App\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class ItemController extends BaseController
{
    public $restful = true;
    
    public function get_index($mainCatSlug, $subCatSlug, $itemSlug)
    {
        $item = Item::getBySlug($itemSlug);
        $typedItem = $item->itemable;
        
//        var_dump($typedItem);
        echo Auth::user();
    }
    
    public function get_test()
    {
        $category = Category::find(7);
        $innerType = call_user_func(array($category->modelName, 'create'), Input::all());
        
        $item = new Item;
        $item->name = Translation::createNew('test1', 'test2');
        $item->slug = Translation::createNew('test1', 'test2');
        $item->itemable_id = $innerType->id;
        $item->itemable_type = $category->modelName;
            
        $category->items()->save($item);
    }
}
