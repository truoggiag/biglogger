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

//Route::get('/', function () {
//    return view('FrontEnd\index');
//});
/***
 * frontend
 */
Route::get('/', 'FrontEnd\IndexController@Index')->name('ViewHome');

route::match(['get','post'],'/login', 'FrontEnd\IndexController@login')->name('ViewLogin');

Route::match(['get','post'],'/register', 'FrontEnd\IndexController@register')->name('ViewRegister');

Route::get('/demo', 'FrontEnd\DemoController@Index')->name('ViewDemo');

Route::get('ajax-search.php','FrontEnd\AjaxSearchController@Index');

Route::get('/logout', 'FrontEnd\IndexController@logout')->name('logout');



////==============
//// route to show the login form
//Route::get('login', array('uses' => 'Auth\LoginController@showLogin'))->name('login');
//Route::get('logout', array('uses' => 'Auth\LoginController@logout'));
//// route to process the form
//Route::post('login', array('uses' => 'Auth\LoginController@doLogin'));
//////======================

/***
 * backend
 */
Route::match(['get','post'],'/accounts-list', 'BackEnd\AccountsController@Index')->name('AccountList');

Route::match(['get','post'],'/accounts-create', 'BackEnd\AccountsController@Create')->name('AccountCreate');

Route::match(['get','post'],'/accounts-edit-{id}', 'BackEnd\AccountsController@Edit')->name('AccountEdit');

//Route::match(['get','post'],'/api', 'BackEnd\ApiController@Index')->name('Api');

//Route::post('/api', 'BackEnd\ApiController@Index')->name('Api');

Route::get('examplelog','BackEnd\ApiController@ExampleLog')->name('exampleLog');

Route::get('examplevisitor','BackEnd\ApiController@ExampleVisitor')->name('exampleVisitor');

Route::get('/app', 'BackEnd\AppController@Index')->name('App');

Route::match(['get','post'],'/app-create', 'BackEnd\AppController@Create')->name('AppCreate');

Route::get('/content', 'BackEnd\ContentController@Index')->name('Content');

Route::get('/log', 'BackEnd\LogController@Index')->name('Log');

Route::get('/visitor/{id_app}', 'BackEnd\VisitorController@Index')->name('Visitor');

Route::get('/visitor', 'BackEnd\VisitorController@VisitorMenu')->name('ListVisor');

Route::get('delete-app/{id_app}','BackEnd\AppController@Delete')->name('DeleteApp');

Route::match(['get','post'],'edit-app/{id_app}','BackEnd\AppController@Edit')->name('EditApp');



