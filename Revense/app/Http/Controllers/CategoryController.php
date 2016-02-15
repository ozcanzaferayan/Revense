<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Item;
use Illuminate\Support\Facades\Input;

class CategoryController extends BaseController
{   
    public $restful = true;
    
    public function get_index($slug = FALSE)
    {
        if($slug) {
            $category = Category::getBySlug($slug);
            
            var_dump($category->categories);
        }
        else
            echo 'test';
    }
    
    public function get_items($mainCatSlug, $subCatSlug)
    {
        $category = Category::getBySlug($subCatSlug);
        
//        var_dump($category->getItems());
//        $items = $category->getItems();
//        
//        foreach($items as $item)
//        {
//            var_dump($item->trValue);
//        }
//        
//        return;
        
        $items = $category->getItems();
        
        foreach($category->attributes as $attribute)
        {
            if(Input::has($attribute->columnName))
            {
                if($attribute->inputType->type == 'range')
                {
                    $items->whereBetween($attribute->columnName, 
                                  Input::get($attribute->columnName));
                }
                else
                    $items->where($attribute->columnName, 
                                  $attribute->inputType->getOperation(), 
                                  Input::get($attribute->columnName));
            }
        }
        
        $items = $items->get();
        
        foreach($items as $item)
        {
            echo $item->trValue . '<br>';
        }
    }
}
