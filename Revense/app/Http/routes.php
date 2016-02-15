<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('/home', 'HomeController@index');
    
    Route::get('test', 
           ['as' => 'test', 
            'uses' => 'ItemController@get_test']);

    Route::get('kategoriler', 
               ['as' => 'categories', 
                'uses' => 'CategoryController@get_index']);

    Route::get('categories', 
               ['as' => 'categories', 
                'uses' => 'CategoryController@get_index']);

    Route::get('kategoriler/{mainCatSlug}', 
               ['as' => 'mainCategory', 
                'uses' => 'CategoryController@get_index']);

    Route::get('categories/{mainCatSlug}', 
               ['as' => 'mainCategory', 
                'uses' => 'CategoryController@get_index']);

    Route::get('kategoriler/{mainCatSlug}/{subCatSlug}', 
               ['as' => 'subCategory', 
                'uses' => 'CategoryController@get_items']);

    Route::get('categories/{mainCatSlug}/{subCatSlug}', 
               ['as' => 'subCategory', 
                'uses' => 'CategoryController@get_items']);

    Route::get('kategoriler/{mainCatSlug}/{subCatSlug}/{itemSlug}', 
               ['as' => 'subCategory', 
                'uses' => 'ItemController@get_index'])->middleware('isAdmin');

    Route::get('categories/{mainCatSlug}/{subCatSlug}/{itemSlug}', 
               ['as' => 'subCategory', 
                'uses' => 'ItemController@get_index']);
    
    
    ///////// ADMIN ROUTES //////////
    /////////////////////////////////
    
    Route::get('admin/login', 
               ['as' => 'adminLogin', 
                'uses' => 'AdminController@get_login']);
    
    Route::get('admin', 'AdminController@get_index')->middleware('isAdmin');
    
    Route::post('admin/login', 
               ['as' => 'adminLoginSubmit', 
                'uses' => 'AdminController@post_login'])->middleware('isAdmin');
    
    Route::get('admin/logout', 
               ['as' => 'adminLogout', 
                'uses' => 'AdminController@get_logout'])->middleware('isAdmin');
    
    Route::get('admin/categories', 
               ['as' => 'adminCategories', 
                'uses' => 'AdminController@get_categories'])->middleware('isAdmin');
    
    Route::get('admin/categories/add', 
               ['as' => 'adminAddCategory', 
                'uses' => 'AdminController@get_addCategory'])->middleware('isAdmin');
    
    Route::post('admin/categories/add', 
               ['as' => 'adminAddCategory', 
                'uses' => 'AdminController@post_addCategory'])->middleware('isAdmin');
});
