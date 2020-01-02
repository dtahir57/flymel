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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

 Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'/admin','middleware'=>['auth','role:Super_User']],function()
{
    Route::get('home','Admin\AdminController@index')->name('admin.home');

    Route::get('blogs','Admin\BlogController@index')->name('blog.index');
    Route::get('blogs/create','Admin\BlogController@create')->name('blog.create');
    Route::post('blogs/store','Admin\BlogController@store')->name('blog.store');
    Route::get('blogs/edit/{blog}','Admin\BlogController@edit')->name('blog.edit');
    Route::patch('blogs/update/{blog}','Admin\BlogController@update')->name('blog.update');
    Route::delete('blogs/delete/{blog}','Admin\BlogController@destroy')->name('blog.destroy');

    Route::get('news','Admin\NewsController@index')->name('news.index');
    Route::get('news/create','Admin\NewsController@create')->name('news.create');
    Route::post('news/store','Admin\NewsController@store')->name('news.store');
    Route::get('news/edit/{news}','Admin\NewsController@edit')->name('news.edit');
    Route::patch('news/update/{news}','Admin\NewsController@update')->name('news.update');
    Route::delete('news/delete/{news}','Admin\NewsController@destroy')->name('news.destroy');

}
);

