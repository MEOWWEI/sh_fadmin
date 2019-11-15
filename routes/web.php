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
//验证码
Route::get('/verify',                   'HomeController@verify');
//登陆模块
Route::group(['namespace'  => "Auth"], function () {
    Route::get('/login',                'LoginController@showLoginForm')->name('login');
    Route::post('/login',               'LoginController@login');
    Route::get('/logout',               'LoginController@logout')->name('logout');
});
//后台主要模块
Route::group(['middleware' => ['auth', 'permission']], function () {
    Route::get('/admin',                     'HomeController@index');
    Route::get('/gewt',                 'HomeController@configr');
    Route::get('/index',                'HomeController@welcome');
    Route::post('/sort',                'HomeController@changeSort');
    Route::resource('/menus',           'MenuController');
    Route::resource('/logs',            'LogController');
    Route::resource('/users',           'UserController');
    Route::post('/users/userup',    'UserController@useredit');
    Route::get('/devices',              'UserController@devices');
    Route::get('/userinfo',             'UserController@userInfo');
    Route::post('/saveinfo/{type}',     'UserController@saveInfo');
    Route::resource('/roles',           'RoleController');
    Route::resource('/permissions',     'PermissionController');
});
Route::get('/apps','AppController@index');//应用展示
Route::get('/apps/list/{id}','AppController@applist');//应用详情
Route::post('/apps/icon/{id}','AppController@appicon');//图标上传
Route::post('/apps/eq/{id}','AppController@appeq');//二维码
Route::post('/apps/imgs/{id}','AppController@imgs');//预览图

Route::get('/apps/apptitles','AppController@apptitles');//既点既改 副标题
Route::get('/apps/editj','AppController@editjdjg');//既点既改 副标题
Route::get('/apps/fage','AppController@fage');//既点既改 年龄
Route::get('/apps/clas','AppController@clas');//既点既改 类型
Route::get('/apps/rlak','AppController@rlak');//既点既改 排名
Route::get('/apps/score','AppController@score');//既点既改 评分星级
Route::get('/apps/nums','AppController@nums');//既点既改 评分数量
Route::get('/apps/brief','AppController@brief');//既点既改 描述
Route::get('/apps/atitle','AppController@atitle');//既点既改 安装标题
Route::get('/apps/aname','AppController@aname');//既点既改 组织名称
Route::get('/apps/limitnum','AppController@limitnum');//既点既改 组织名称
Route::get('/apps/adesc','AppController@adesc');//既点既改 描述

Route::get('/apps/uploads','AppController@uploads');//应用显示
Route::post('/apps/file','AppController@fileuploads');//应用上传
Route::get('/apps/del/{id}','AppController@deldata');//删除软件


//------------------------------------------前台---------------------------------------------
Route::get('/{id?}','DownAppController@showdown');//下载index
Route::get('id/{id=1}','DownAppController@showdown');//下载index