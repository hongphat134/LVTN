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
Auth::routes();
Route::get('/thongbao','HomeController@notification')->name('notification');
Route::get('/error',function(){
	return view('pages.error');
});
// Route::view('/thongbao','pages.notification');

Route::group(['middleware' => 'recruiter'], function() {
	Route::get('/', 'HomeController@index');
	Route::get('/tin-tuyen-dung/{news_id}','HomeController@getNews')->name('news')->where('news_id', '[0-9]+');
	Route::get('/tim-kiem','HomeController@search')->name('search');
	Route::get('/job-list','HomeController@getJobs')->name('jobListings');

	Route::get('/dangky-ntd', 'HomeController@getRecRegister')->name('recRegister');
	Route::post('/dangky-ntd', 'HomeController@postRecRegister');

	Route::group(['prefix' => 'nguoitimviec','middleware' => 'auth'], function() {
		Route::get('/profile','NguoiTimViecController@getProfile');	
		Route::post('/profile','NguoiTimViecController@postProfile');			
		Route::get('/apply/{ttd_id}','NguoiTimViecController@getApply')->name('apply')->where('ttd_id', '[0-9]+');
		Route::post('/apply/{ttd_id}','NguoiTimViecController@postApply');	

		Route::get('/save-job/{news_id}','NguoiTimViecController@saveJob');
		Route::get('/unsave-job/{news_id}','NguoiTimViecController@unsaveJob');
	});
});

Route::group(['prefix' => 'nhatuyendung','middleware' => ['auth','guest']], function() {
	Route::get('/','NhaTuyenDungController@index');

	Route::get('/post-job','NhaTuyenDungController@getPostJob')->name('postJob');
	Route::post('/post-job','NhaTuyenDungController@postPostJob');

	// BUG
	Route::delete('/delete-job/{id}','NhaTuyenDungController@destroy');

	Route::get('/update-job/{news_id}','NhaTuyenDungController@getUpdateJob')->name('updateJob')->where('news_id', '[0-9]+');
	Route::post('/update-job/{news_id}','NhaTuyenDungController@postUpdateJob');

	Route::get('/jobs-list','NhaTuyenDungController@getJobList');

	Route::get('/profile','NhaTuyenDungController@getEditProfile');
	Route::post('/profile','NhaTuyenDungController@postEditProfile');
});