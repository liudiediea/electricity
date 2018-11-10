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
Route::middleware(['login'])->group(function(){
    Route::get('/index','Admin\IndexController@index')->name('index');
    Route::get('/home','Admin\IndexController@home')->name('home');
    //会员
    Route::get('/user_list','Admin\UserController@list')->name('list');
    Route::get('/user_grade','Admin\UserController@grade')->name('grade');
    Route::get('/user_record','Admin\UserController@record')->name('record'); 
    Route::post('/user_insert','Admin\UserController@insert')->name('user_insert'); 
    Route::get('/user_del/{id}','Admin\UserController@delete')->name('user_del'); 
    //RBAC
    Route::get('/admin_list','Admin\AdminController@admin_list')->name('admin_list');
    Route::post('/insertadmin','Admin\AdminController@insertadmin')->name('insertadmin');
    Route::get('/delete/{id}','Admin\AdminController@delete')->name('del_admin');
    Route::get('/admin_edit/{id}','Admin\AdminController@edit')->name('admin_edit');
    Route::post('/admin_update/{id}','Admin\AdminController@update')->name('admin_update');
    Route::get('/admin_info','Admin\AdminController@admin_info')->name('admin_info');
    Route::post('/update','Admin\AdminController@update_info')->name('update_info');

    Route::get('/role','Admin\RoleController@index')->name('role');
    Route::get('/role_add','Admin\RoleController@add')->name('role_add');
    Route::post('/role_insert','Admin\RoleController@insert')->name('role_insert');
    Route::get('/role_del/{id}','Admin\RoleController@delete')->name('role_del');
    Route::get('/role_edit/{id}','Admin\RoleController@edit')->name('role_edit');
    Route::post('/role_update/{id}','Admin\RoleController@update')->name('role_update');


    //商品
    Route::get('/good','Admin\GoodsController@goods')->name('goods');
    Route::get('/goods_add','Admin\GoodsController@add')->name('goods_add');
    Route::post('/goods_insert','Admin\GoodsController@insert')->name('goods_insert');
    Route::get('/goods_getcat','Admin\GoodsController@ajax_get_cat')->name('goods_getcat');
    Route::get('/goods_edit/{id}','Admin\GoodsController@edit')->name('goods_edit');
    Route::post('/goods_update/{id}','Admin\GoodsController@update')->name('goods_update');

    //分类
    Route::get('/category','Admin\CategoryController@category')->name('category');
    Route::post('/addSecond','Admin\CategoryController@addSecond')->name('addSecond');
    Route::post('/addFirst','Admin\CategoryController@addFirst')->name('addFirst');
    Route::post('/cat_del','Admin\CategoryController@delete')->name('cat_del');
    Route::post('/updateCategory','Admin\CategoryController@update')->name('updateCategory');
    //品牌
    Route::get('/brand','Admin\BrandController@brand')->name('brand');
    Route::get('/brand_add','Admin\BrandController@add')->name('brand_add');
    Route::post('/brand_insert','Admin\BrandController@insert')->name('brand_insert');
    Route::get('/brand_del/{id}','Admin\BrandController@delete')->name('brand_del');
    Route::get('/brand_edit/{id}','Admin\BrandController@edit')->name('brand_edit');
    Route::post('/brand_update/{id}','Admin\BrandController@update')->name('brand_update');
    //文章
    Route::get('/article_index','Admin\ArticleController@index')->name('article_index');
    Route::get('/article_add','Admin\ArticleController@add')->name('article_add');
    Route::post('/insert_article','Admin\ArticleController@insert')->name('insert_article');
    Route::get('/edit_article/{id}','Admin\ArticleController@edit')->name('article_edit');
    Route::post('/update_article/{id}','Admin\ArticleController@update')->name('article_update');
    Route::get('/article_del/{id}','Admin\ArticleController@delete')->name('article_del');

    Route::get('/article_sort','Admin\ArticleController@sort')->name('article_sort');
    Route::post('/article_sort_insert','Admin\ArticleController@sort_insert')->name('article_sort_insert');
    Route::get('/article_sort_del/{id}','Admin\ArticleController@sort_del')->name('article_sort_del');



});

Route::get('/login','Admin\LoginController@login')->name('login');
Route::post('/login','Admin\LoginController@dologin')->name('dologin');
Route::get('/logout','Admin\LoginController@logout')->name('logout');


//前台
Route::get('/home/login','Home\LoginController@login')->name('home_login');
Route::post('/home/dologin','Home\LoginController@dologin')->name('home_dologin');
Route::get('/home/register','Home\RegisterController@register')->name('home_register');
Route::post('/home/doregist','Home\RegisterController@doregist')->name('home_doregist');
Route::get('/home/sendcode','Home\RegisterController@sendcode')->name('home_sendcode');

//首页
Route::get('/home/index','Home\IndexController@index')->name('home_index');


//商品
Route::get('/home/goods_list','Home\GoodController@goods_list')->name('goods_list');
Route::get('/home/success_cart','Home\GoodController@success_cart')->name('success_cart');
Route::get('/home/cart','Home\GoodController@cart')->name('cart');
Route::get('/home/item','Home\GoodController@item')->name('item');
Route::get('/home/getGoodsSku','Home\GoodController@getGoodsSku')->name('getGoodsSku');
//购物车
Route::get('/home/cart','Home\CartController@index')->name('cart');
Route::post('/home/add_cart','Home\CartController@add')->name('add_cart');
Route::get('/home/good_cart_ajax','Home\CartController@good_cart_ajax')->name('good_cart_ajax');
Route::get('/home/good_cart_add','Home\CartController@good_cart_add')->name('good_cart_add');
Route::get('/home/good_cart_reduce','Home\CartController@good_cart_reduce')->name('good_cart_reduce');

Route::post('/home/cart_del','Home\CartController@delete')->name('cart_del');





