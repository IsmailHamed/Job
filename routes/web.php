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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lang', function (){

    if (App::isLocale('en')) {
        $locale='ar';
        App::setLocale($locale);

    }else{
        $locale='en';
        App::setLocale($locale);

    }
    Session::put('locale', $locale);

    return redirect('/home');
});

Route::get('/category','CategoriesController@Index')->name('Categories.Index');
Route::match(['get', 'post'],'/category/create','CategoriesController@Create')->name('Categories.Create');
Route::match(['get', 'post'],'/category/edit/{id}','CategoriesController@Edit')->name('Categories.Edit');
Route::get('/category/delete/{id}','CategoriesController@delete')->name('Categories.Delete');
Route::get('/category/Details/{id}','CategoriesController@Details')->name('Categories.Details');

Route::get('/Job','JobController@Index')->name('Job.Index');
Route::match(['get', 'post'],'/Job/create','JobController@Create')->name('Job.Create');
Route::match(['get', 'post'],'/Job/edit/{id}','JobController@Edit')->name('Job.Edit');
Route::get('/Job/delete/{id}','JobController@delete')->name('Job.Delete');
Route::get('/Job/Details/{id}','JobController@Details')->name('Job.Details');

Route::match(['get', 'post'],'/UserProfile','Auth\UserProfileController@UserProfile')->name('UserProfile');

Route::get('/Role','RoleController@Index')->name('Role.Index');
Route::match(['get', 'post'],'/Role/create','RoleController@Create')->name('Role.Create');
Route::match(['get', 'post'],'/Role/edit/{id}','RoleController@Edit')->name('Role.Edit');
Route::get('/Role/delete/{id}','RoleController@delete')->name('Role.Delete');
Route::get('/Role/Details/{id}','RoleController@Details')->name('Role.Details');

Route::get('/Permission','PermissionController@Index')->name('Permission.Index');
Route::match(['get', 'post'],'/Permission/create','PermissionController@Create')->name('Permission.Create');
Route::match(['get', 'post'],'/Permission/edit/{id}','PermissionController@Edit')->name('Permission.Edit');
Route::get('/Permission/delete/{id}','PermissionController@delete')->name('Permission.Delete');
Route::get('/Permission/Details/{id}','PermissionController@Details')->name('Permission.Details');

Route::get('/User','UserController@Index')->name('User.Index');
Route::match(['get', 'post'],'/User/create','UserController@Create')->name('User.Create');
Route::match(['get', 'post'],'/User/edit/{id}','UserController@Edit')->name('User.Edit');
Route::get('/User/delete/{id}','UserController@delete')->name('User.Delete');
Route::get('/User/Details/{id}','UserController@Details')->name('User.Details');

Route::match(['get', 'post'],'/Job/ApplyJob/{id}','JobController@ApplyJob')->name('Job.ApplyJob');
Route::get('/Job/ApplyJobByUser','JobController@ApplyJobByUser')->name('Job.ApplyJobByUser');
Route::get('/Job/DeleteApplyJob/{id}','JobController@DeleteApplyJob')->name('Job.DeleteApplyJob');

Route::match(['get', 'post'],'/Job/EditApplyJob/{id}','JobController@EditApplyJob')->name('Job.EditApplyJob');

