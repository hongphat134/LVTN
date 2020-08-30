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
Route::get('/test','HomeController@test');
Auth::routes();
// Mẫu chưa xử lý
Route::get('/thongbao',function(){
	if(session()->has('alert')) return view('pages.notification');

    return response()->json(['error'=>'404 Not Found','error_message'=>'Xin hãy kiểm tra lại URL của bạn!'], 404);
})->name('notification');
Route::get('/error',function(){	return view('pages.error'); });
Route::get('/about',function(){	return view('pages.about'); });
// Samples
Route::get('/gallery',function(){	return view('samples.gallery'); });
Route::get('/portfolio-single',function(){	return view('samples.portfolio-single'); });
Route::get('/portfolio',function(){	return view('samples.portfolio'); });
Route::get('/testimonials',function(){	return view('samples.testimonials'); });
Route::get('/faq',function(){	return view('samples.faq'); });
Route::get('/service-single',function(){	return view('samples.service-single'); });
Route::get('/services',function(){	return view('samples.services'); });

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
// Autocomplete dành cho thanh tìm kiếm => chỉ để dc đây vì middleware
Route::get('/skill-job/{key}','HomeController@getSkillsJobs'); //Ajax
// Show bài viết
Route::get('/blog-single/{blog_id}','HomeController@showSingleBlog')->where('blog_id', '[0-9]+');
// Show DS bài viết
Route::get('/blog','HomeController@showForum');
// Tào lao :D
Route::get('/tim-kiem-nganh-it','HomeController@searchByJobs');
Route::get('/tim-kiem-ki-nang-it','HomeController@searchBySkills');
Route::get('/tim-kiem-tinh-tp','HomeController@searchByCities');
// Liên hệ dành cho User
Route::get('/contact','LienHeController@getContact');
Route::post('/contact','LienHeController@sendMessage');
// Chức năng dành chung cho cả 2 loại User
Route::group(['middleware' => ['auth','isEmailVerified']], function() {
	// Tạo Blog
	Route::get('/create-blog','HomeController@getCreateBlog');
	Route::post('/create-blog','HomeController@postCreateBlog');
	// Cập nhật Blog
	Route::get('/update-blog/{blog_id}','HomeController@getUpdateBlog')->where('blog_id', '[0-9]+');
	Route::post('/update-blog/{blog_id}','HomeController@postUpdateBlog');
	// DS Blog của User
	Route::get('/blog-listings','HomeController@getBlogList');
	// Bình luận Blog => AJAX
	Route::post('/thanh-vien/binh-luan','HomeController@postComment');
});
// For Người tìm việc
Route::group(['middleware' => ['guest','isEmailVerified']], function() {
	// Trang chủ
	Route::get('/', 'HomeController@index');
	// Thông tin tuyển dụng
	Route::get('/tin-tuyen-dung/{news_id}','HomeController@getNews')->name('news')->where('news_id', '[0-9]+');
	// Tìm kiếm chính
	Route::get('/tim-kiem','HomeController@search')->name('search');
	// Tìm kiếm theo kĩ năng
	Route::get('/tim-kiem-skill/{skill}','HomeController@searchBySkill');
	// Danh sách tin tuyển dụng
	Route::get('/job-list','HomeController@getJobs')->name('jobListings');
	// Đăng ký dành cho nhà tuyển dụng
	Route::get('/dangky-ntd', 'HomeController@getRecRegister')->name('recRegister');
	// Show chi tiết nhà tuyển dụng
	Route::get('/thong-tin-ntd/{rec_id}','HomeController@showRecDetails')->where('rec_id', '[0-9]+');
	// Tìm kiếm nâng cao
	Route::get('/tim-kiem-nang-cao','HomeController@getAdvancedSearch')->name('advancedSearch');
	Route::post('/tim-kiem-nang-cao','HomeController@postAdvancedSearch');
	Route::group(['prefix' => 'nguoitimviec','middleware' => 'auth'], function() {		
		// Danh sách mẫu hồ sơ
		Route::get('/profile-list','NguoiTimViecController@getProfiles');
		// Dùng mẫu hồ sơ để ứng tuyển
		Route::get('/nop-ho-so','NguoiTimViecController@apply');
		// Tạo mẫu hồ sơ
		Route::get('/create-profile','NguoiTimViecController@getCreateProfile');	
		Route::post('/create-profile','NguoiTimViecController@postCreateProfile');			
		// Xoá mẫu hồ sơ
		Route::get('/delete-profile/{profile_id}','NguoiTimViecController@deleteProfile');
		// Cập nhật mẫu hồ sơ
		Route::get('/update-profile/{profile_id}','NguoiTimViecController@getUpdateProfile')->where('profile_id', '[0-9]+');
		Route::post('/update-profile/{profile_id}','NguoiTimViecController@postUpdateProfile');
		// Chọn cách ứng tuyển
		Route::get('/choose-apply/{ttd_id}','NguoiTimViecController@getSelectApply');
		// Tạo hồ sơ xin việc và ứng tuyển
		Route::get('/apply/{ttd_id}','NguoiTimViecController@getApply')->name('apply')->where('ttd_id', '[0-9]+');
		Route::post('/apply/{ttd_id}','NguoiTimViecController@postApply');	
		// Danh sách tin đang theo dõi
		Route::get('/save-job-list','NguoiTimViecController@getSaveJob')->name('saveJobs');
		// Danh sách tin đã ứng tuyển
		Route::get('/applied-job-list','NguoiTimViecController@getAppliedJob')->name('appliedJobs');
		// Đổi trạng thái công khai của mẫu hồ sơ
		Route::get('/set-status/{hs_id}','NguoiTimViecController@setStatus')->where('hs_id','[0-9]+');
		
		// PDF (chỉ có view Profile và Job)
		Route::get('/pdf/{hs_id}','PDFController@pdfProfile')->where('hs_id','[0-9]+')->name('pdf-profile');
		// AJAX
		// Theo và bỏ theo dõi tin tuyển dụng 
		Route::get('/save-job/{news_id}','NguoiTimViecController@saveJob')->where('news_id','[0-9]+');
		Route::get('/unsave-job/{news_id}','NguoiTimViecController@unsaveJob')->where('news_id','[0-9]+');
		// Theo dõi nhà tuyển dụng
		Route::get('/theo-doi-ntd','NguoiTimViecController@getFollowRecruiter');
		// TÌm kiếm và theo dõi nhà tuyển dụng
		Route::post('/tim-kiem-ntd','NguoiTimViecController@searchByRecruiter');
		Route::get('/tim-kiem-ntd','NguoiTimViecController@searchByRecruiter');
		// Theo và bỏ theo dõi nhà tuyển dụng => AJAX
		Route::get('/save-rec/{ntd_id}','NguoiTimViecController@saveRecuiter')->where('ntd_id','[0-9]+');
		Route::get('/unsave-rec/{ntd_id}','NguoiTimViecController@unsaveRecuiter')->where('ntd_id','[0-9]+');
		// Thông báo việc làm phù hợp
		Route::get('/thong-bao-viec-lam','NguoiTimViecController@notifyJobs');
	});
});
// For Nhà tuyển dụng
Route::group(['prefix' => 'nhatuyendung','middleware' => ['auth','recruiter','isEmailVerified']], function() {
	// Trang chủ
	Route::get('/','NhaTuyenDungController@index');
	// Đăng tin tuyển dụng
	Route::get('/post-job','NhaTuyenDungController@getPostJob')->name('postJob');
	Route::post('/post-job','NhaTuyenDungController@postPostJob');
	// BUG
	Route::get('/delete-job/{news_id}','NhaTuyenDungController@deleteJob')->where('news_id', '[0-9]+');
	// Cập nhật tin tuyển dụng
	Route::get('/update-job/{news_id}','NhaTuyenDungController@getUpdateJob')->name('updateJob')->where('news_id', '[0-9]+');
	Route::post('/update-job/{news_id}','NhaTuyenDungController@postUpdateJob');
	// Quản lý DS tin tuyển dụng
	Route::get('/jobs-list','NhaTuyenDungController@getJobList');
	// Cập nhật thông tin cá nhân
	Route::get('/profile','NhaTuyenDungController@getEditProfile');
	Route::post('/profile','NhaTuyenDungController@postEditProfile');
	// Xem thông tin mẫu hồ sơ NTV
	Route::get('/thong-tin-ho-so/{hs_id}','NhaTuyenDungController@viewProfile')->name('detailPf')->where('hs_id','[0-9]+');
	// Quản lý DS mẫu hồ sơ đã lưu
	Route::get('/save-profile-list','NhaTuyenDungController@getSaveProfiles')->name('savePf');
	// Theo và bỏ theo dõi mẫu hồ sơ NTV => AJAX
	Route::get('/save-profile/{hs_id}','NhaTuyenDungController@saveProfile');
	Route::get('/unsave-profile/{hs_id}','NhaTuyenDungController@unsaveProfile');
	// Tìm kiếm => như đb :D
	Route::get('/tim-kiem','NhaTuyenDungController@search');	
	// Show DS mẫu hồ sơ => nhảm vcc :D 
	Route::get('/danh-sach-ho-so','NhaTuyenDungController@getProfiles');
	// Gửi mail đến các hồ sơ ứng tuyển
	Route::get('/ung-tuyen','NhaTuyenDungController@recruit')->name('recruit');
	// Quản lý DS hồ sơ xin việc
	Route::get('/ho-so-cho-duyet/{job_id}','NhaTuyenDungController@getAppliedProfiles')->where('job_id','[0-9]+');
	// Quản lý DS hồ sơ đã xử lý
	Route::get('/ho-so-da-xu-ly/{job_id}','NhaTuyenDungController@getProcessedProfiles')->where('job_id','[0-9]+');
	// PDF
	Route::get('/ung-tuyen/pdf/{user_id}/{job_id}','PDFController@viewPDFApplied');
	// Xoá hồ sơ đã xử lý
	Route::get('/xoa-ho-so','NhaTuyenDungController@deleteAppliedPrf');
	// Tìm kiếm hồ sơ ứng tuyển theo ID tin tuyển dụng
	Route::get('/tim-kiem-hs-ung-tuyen','NhaTuyenDungController@searchByIDJob')->name('searchByIDJob');
	// Ngỏ ý Người tìm việc
	Route::post('/ngo-y','NhaTuyenDungController@offerSeeker');
	// Tìm kiếm ứng viên và ngỏ ý
	Route::get('/tim-kiem-ung-vien/{job_id}','NhaTuyenDungController@searchSeekers')->where('job_id','[0-9]+');
	// 
	Route::get('/nhieu-ngo-y','NhaTuyenDungController@offerManySeekers');
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
	Route::get('/test',function(){
		return view('admins.tintuyendung.list1');
	});

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

		Route::get('/ung-tuyen','AdminController@getAppliedPrfList');
		Route::get('/ung-tuyen/{ttd_id}/{usr_id}','AdminController@approvedAppliedPrf')->where(['ttd_id','usr_id'], '[0-9]+');
	});

	Route::group(['prefix' => 'bai-viet'], function () {
		Route::get('/danh-sach','AdminController@getBlogList');
		Route::get('/phe-duyet/{blog_id}','AdminController@ApprovedBlog')->where('blog_id', '[0-9]+');
		Route::get('/ds-binh-luan/{blog_id}','AdminController@getCommentList')->where('blog_id', '[0-9]+');
		Route::get('/xoa-binh-luan/{cmt_id}','AdminController@deleteCmt')->where('cmt_id', '[0-9]+');
	});
	
	Route::group(['prefix' => 'nguoi-dung'], function () {
		Route::get('/nguoi-tim-viec','AdminController@getJobSeekerList');
		Route::get('/nha-tuyen-dung','AdminController@getBusinessList');
		Route::get('/quan-tri-vien','AdminController@getAdminList');
	});

	Route::group(['prefix' => 'thu-thap-y-kien'], function () {
		Route::get('/danh-sach','AdminController@getOpinionList');
		Route::get('/them/{opinion_id}','AdminController@insertOpinion');
		Route::get('/xoa/{opinion_id}','AdminController@deleteOpinion');
	});
});