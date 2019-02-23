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
use App\TheLoai;

Route::get('/', function () {
    return view('welcome');
});


// router login admin
Route::get('admin/login', 'UserController@loginAdmin');
Route::post('admin/login', 'UserController@checkLoginAdmin');
Route::get('admin/logout', 'UserController@logoutAdmin');

// login user front end
Route::get('dangnhap', 'pagesController@getDangNhap');
Route::post('dangnhap', 'pagesController@postDangNhap');

// route for pages
Route::get('home', 'pagesController@homePage');
Route::get('contact', 'pagesController@contactPage');
Route::get('loaitin/{id}/{TenKhongDau}.html', 'pagesController@loaitin');
Route::get('chitiet/{id}/{TenKhongDau}.html', 'pagesController@chitiet');

// Route group for admin
Route::group(['prefix'=>'admin', 'middleware' => 'adminLogin'], function(){
    Route::group(['prefix'=>'theloai'], function (){
        //admin/theloai/them
        Route::get('danhsach','TheLoaiController@getDanhSach');

        Route::get('sua/{id}','TheLoaiController@getSua');
        Route::post('sua/{id}','TheLoaiController@postSua');

        Route::get('them','TheLoaiController@getThem');
        Route::post('them','TheLoaiController@postThem');

        Route::get('xoa/{id}','TheLoaiController@getXoa');
    });

    Route::group(['prefix'=>'loaitin'], function (){
        //admin/theloai/them
        Route::get('danhsach','LoaiTinController@getDanhSach');

        Route::get('sua/{id}','LoaiTinController@getSua');
        Route::post('sua/{id}','LoaiTinController@postSua');

        Route::get('them','LoaiTinController@getThem');
        Route::post('them','LoaiTinController@postThem');

        Route::get('xoa/{id}','LoaiTinController@getXoa');
    });

    Route::group(['prefix'=>'tintuc'], function (){
        //admin/theloai/them
        Route::get('danhsach','TinTucController@getDanhSach');

        Route::get('sua/{id}','TinTucController@getSua');
        Route::post('sua/{id}','TinTucController@postSua');

        Route::get('them','TinTucController@getThem');
        Route::post('them','TinTucController@postThem');

        Route::get('xoa/{id}', 'TinTucController@getXoa');
    });

    Route::group(['prefix'=>'slide'], function (){
        //admin/theloai/them
        Route::get('danhsach','SlideController@getDanhSach');

        Route::get('sua/{id}','SlideController@getSua');
        Route::post('sua/{id}','SlideController@postSua');

        Route::get('them','SlideController@getThem');
        Route::post('them','SlideController@postThem');

        Route::get('xoa/{id}', 'SlideController@getXoa');
    });

    Route::group(['prefix'=>'user'], function (){
        //admin/theloai/them
        Route::get('danhsach','UserController@getDanhSach');

        Route::get('sua','UserController@getSua');

        Route::get('them','UserController@getThem');
    });

    Route::group(['prefix'=>'ajax'], function (){
        Route::get('loaitin','ajaxController@getLoaiTin');
    });

    Route::group(['prefix'=>'comment'], function (){
        //admin/comment
        Route::get('xoa/{id}/{idTinTuc}', 'CommentController@getXoa');
    });

});
