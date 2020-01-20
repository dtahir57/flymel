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

    Route::get('permissions','Admin\UserManagement\PermissionController@index')->name('permission.index');
    Route::get('permissions/create','Admin\UserManagement\PermissionController@create')->name('permission.create');
    Route::post('permissions/store','Admin\UserManagement\PermissionController@store')->name('permission.store');
    Route::get('permissions/edit/{permission}','Admin\UserManagement\PermissionController@edit')->name('permission.edit');
    Route::patch('permissions/update/{permission}','Admin\UserManagement\PermissionController@update')->name('permission.update');
    Route::delete('permissions/delete/{permission}','Admin\UserManagement\PermissionController@destroy')->name('permission.destroy');

    Route::get('roles','Admin\UserManagement\RoleController@index')->name('role.index');
    Route::get('roles/create','Admin\UserManagement\RoleController@create')->name('role.create');
    Route::post('roles/store','Admin\UserManagement\RoleController@store')->name('role.store');
    Route::get('roles/edit/{role}','Admin\UserManagement\RoleController@edit')->name('role.edit');
    Route::patch('roles/update/{role}','Admin\UserManagement\RoleController@update')->name('role.update');
    Route::delete('roles/delete/{role}','Admin\UserManagement\RoleController@destroy')->name('role.destroy');

    Route::get('users','Admin\UserManagement\UserController@index')->name('user.index');
    Route::get('users/create','Admin\UserManagement\UserController@create')->name('user.create');
    Route::post('users/store','Admin\UserManagement\UserController@store')->name('user.store');
    Route::get('users/edit/{user}','Admin\UserManagement\UserController@edit')->name('user.edit');
    Route::patch('users/update/{user}','Admin\UserManagement\UserController@update')->name('user.update');
    Route::delete('users/delete/{user}','Admin\UserManagement\UserController@destroy')->name('user.destroy');

}
);

Route::group(['prefix'=>'/user','middleware'=>['auth','role:User']],function()
{
    Route::get('home','User\UserController@index')->name('user.home');
    Route::get('bookinghistory','User\UserController@bookinghistory')->name('user.bookinghistory');
    Route::get('contactsupport','User\UserController@contactsupport')->name('user.contactsupport');
    Route::post('message','User\UserController@message')->name('user.message');
    Route::get('profile','User\UserController@profile')->name('user.profile');
    Route::patch('updateprofile','User\UserController@updateprofile')->name('user.updateprofile');
}
);

