<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'uses'=>'FrontEndController@index',
    'as'=>'index'

]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');//1
Route::resource('post', 'PostController'); //１をより省略できる

Route::get('/trashed-posts',[
     'uses'=>'PostController@trashed',
     'as'=>'post.trashed'

     
]);

Route::get('/restore-post/{id}',[
    'uses'=>'PostController@restore',
    'as'=>'post.restore'
    ]);
    
Route::delete('/kill-post/{id}',[
        'uses'=>'PostController@kill',
        'as'=>'post.kill'
        ]);
        
        
        
Route::resource('category', 'CategoryController'); 
Route::resource('tag', 'TagController'); 

Route::get('/results',[
    'uses'=>'FrontEndController@search',
    'as'=>'search.results'
    ]);

Route::post('/subscribe',[
        'uses'=>'FrontEndController@subscribe',
        'as'=>'subscribe'
        ]);

 Route::get('/single_post/{slug}',[
            'uses'=>'FrontEndController@single_post',
            'as'=>'post.single'
            ]);

Route::get('/category/{category}',[
                'uses'=>'FrontEndController@single_category',
                'as'=>'category.single'
                ]);
        
    
    