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
Route::get('/error',function(){	return view('pages.error'); });
Route::get('/about',function(){	return view('pages.about'); });
Route::get('/blog-single',function(){	return view('samples.blog-single'); });
Route::get('/blog',function(){	return view('samples.blog'); });
Route::get('/gallery',function(){	return view('samples.gallery'); });
Route::get('/portfolio-single',function(){	return view('samples.portfolio-single'); });
Route::get('/portfolio',function(){	return view('samples.portfolio'); });
Route::get('/testimonials',function(){	return view('samples.testimonials'); });
Route::get('/faq',function(){	return view('samples.faq'); });
Route::get('/service-single',function(){	return view('samples.service-single'); });
Route::get('/services',function(){	return view('samples.services'); });

Route::get('/contact','LienHeController@getContact');
Route::post('/contact','LienHeController@sendMessage');


Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

Route::group(['middleware' => ['guest','isEmailVerified']], function() {
	Route::get('/', 'HomeController@index');
	Route::get('/tin-tuyen-dung/{news_id}','HomeController@getNews')->name('news')->where('news_id', '[0-9]+');
	Route::get('/tim-kiem','HomeController@search')->name('search');
	Route::get('/tim-kiem-skill/{skill}','HomeController@searchBySkill');

	Route::get('/job-list','HomeController@getJobs')->name('jobListings');

	Route::get('/dangky-ntd', 'HomeController@getRecRegister')->name('recRegister');
	Route::post('/dangky-ntd', 'HomeController@postRecRegister');

	Route::get('/skill-job/{key}','HomeController@getSkillsJobs');

	Route::group(['prefix' => 'nguoitimviec','middleware' => 'auth'], function() {				
		Route::get('/profile-list','NguoiTimViecController@getProfiles');
		Route::get('/nop-ho-so','NguoiTimViecController@apply');

		Route::get('/create-profile','NguoiTimViecController@getCreateProfile');	
		Route::post('/create-profile','NguoiTimViecController@postCreateProfile');			

		Route::get('/delete-profile/{profile_id}','NguoiTimViecController@deleteProfile');

		Route::get('/update-profile/{profile_id}','NguoiTimViecController@getUpdateProfile')->where('profile_id', '[0-9]+');
		Route::post('/update-profile/{profile_id}','NguoiTimViecController@postUpdateProfile');			
		Route::get('/choose-apply/{ttd_id}','NguoiTimViecController@getSelectApply');

		Route::get('/apply/{ttd_id}','NguoiTimViecController@getApply')->name('apply')->where('ttd_id', '[0-9]+');
		Route::post('/apply/{ttd_id}','NguoiTimViecController@postApply');	

		Route::get('/save-job-list','NguoiTimViecController@getSaveJob')->name('saveJobs');
		Route::get('/applied-job-list','NguoiTimViecController@getAppliedJob')->name('appliedJobs');

		Route::get('/set-status/{hs_id}','NguoiTimViecController@setStatus')->where('hs_id','[0-9]+');
		// PDF
		Route::get('/pdf/{hs_id}','PDFController@pdfProfile')->where('hs_id','[0-9]+')->name('pdf-profile');
		// AJAX
		Route::get('/save-job/{news_id}','NguoiTimViecController@saveJob')->where('news_id','[0-9]+');
		Route::get('/unsave-job/{news_id}','NguoiTimViecController@unsaveJob');		
	});
});

Route::group(['prefix' => 'nhatuyendung','middleware' => ['auth','recruiter','isEmailVerified']], function() {
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

	Route::get('/thong-tin-ho-so/{hs_id}','NhaTuyenDungController@viewProfile')->name('detailPf')->where('hs_id','[0-9]+');

	Route::get('/save-profile-list','NhaTuyenDungController@getSaveProfiles')->name('savePf');
	Route::get('/applied-profile-list','NhaTuyenDungController@getAppliedProfiles')->name('appliedPf');

	Route::get('/save-profile/{hs_id}','NhaTuyenDungController@saveProfile');
	Route::get('/unsave-profile/{hs_id}','NhaTuyenDungController@unsaveProfile');

	Route::get('/tim-kiem','NhaTuyenDungController@search');

	Route::get('/view-profile/{ntv_id}/{ttd_id}','NhaTuyenDungController@viewApplied')->where('ntv_id','[0-9]+')->where('ttd_id','[0-9]+');
});

Route::group(['prefix' => 'user','middleware' => 'auth'], function() {
	Route::post('/change-name','HomeController@changeUserName');
	Route::post('/change-pwd','HomeController@changeUserPassword');
});

// VERIFICATION EMAIL
Route::group(['middleware' => ['web', 'auth', 'isEmailVerified']], function () {
	// Verification
	Route::get('register/verify','App\Http\Controllers\Auth\RegisterController@verify')->name('verifyEmailLink');
	Route::get('register/verify/resend','App\Http\Controllers\Auth\RegisterController@showResendVerificationEmailForm')->name('showResendVerificationEmailForm');
	Route::post('register/verify/resend','App\Http\Controllers\Auth\RegisterController@resendVerificationEmail')->name('resendVerificationEmail')->middleware('throttle:2,1');
});

// Admin
Route::get('/login-admin','AdminController@getLogin');
Route::group(['prefix' => 'administrators','middleware' => ['admin']], function () {
	Route::get('/','AdminController@home');
	Route::get('/home','AdminController@home');

	Route::get('/lien-he','AdminController@getContactList');
	Route::get('/lien-he/feedback/{id}','LienHeController@reponseMessage')->where('id', '[0-9]+')->name('feedback');

	Route::group(['prefix' => 'tin-tuyen-dung'], function () {
		Route::get('/danh-sach','AdminController@getRecList');
		Route::get('/phe-duyet','AdminController@getApprovedRecList');
		Route::get('/phe-duyet/{ttd_id}','AdminController@approvedRec')->where('ttd_id', '[0-9]+');
		Route::get('/view-pdf/{ttd_id}','PDFController@viewPDFJob')->where('ttd_id', '[0-9]+');
		Route::get('/export-pdf/{ttd_id}','PDFController@exportPDFJob')->where('ttd_id', '[0-9]+');
		Route::get('/export-all','PDFController@exportAll');
		Route::get('/clear','AdminController@clear');
	});
	
	Route::group(['prefix' => 'ho-so'], function () {
		Route::get('/danh-sach','AdminController@getProfileList');
		Route::get('/phe-duyet','AdminController@getApprovedPrfList');
		Route::get('/phe-duyet/{hs_id}','AdminController@approvedPrf')->where('hs_id', '[0-9]+');
	});
	
	Route::group(['prefix' => 'nguoi-dung'], function () {
		Route::get('/nguoi-tim-viec','AdminController@getJobSeekerList');
		Route::get('/nha-tuyen-dung','AdminController@getBusinessList');
	});

	Route::group(['prefix' => 'quan-tri-vien'], function () {
		Route::get('/danh-sach','AdminController@getAdminList');		
	});
});