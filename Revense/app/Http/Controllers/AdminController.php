<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Html\FormFacade;
use View;
use Redirect;
use App\Category;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    public $restful = true;
    
    public function get_index()
    {
        return View::make('admin.index');
    }
    
    public function get_login()
    {
        if(Auth::check())
            return Redirect::action('AdminController@get_index');
            
        return View::make('admin.login');
    }
    
    public function post_login()
    {
        $credentials = [
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'role'   => 'admin'
        ];
        
        if (Auth::attempt($credentials))
            return Redirect::action('AdminController@get_index');
        
        return Redirect::action('AdminController@get_login');
    }
    
    public function get_logout()
    {
        Auth::logout();
        return View::make('admin.login');
    }
    
    public function get_categories()
    {
        $categories = Category::all();
        
        return View::make('admin.categories.index')->with('categories', $categories);
    }
    
    public function get_addCategory()
    {
        $categories = Category::all();
        
        return View::make('admin.categories.add')->with('categories', $categories);
    }
}
