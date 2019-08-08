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
use App\Models\Role;
Route::get('/','Sites\WelcomeController@index');

Route::get('beneficiary_lists','Sites\CategoryController@beneficiary_lists'); 
Route::get('form', function () {
    return view('form');
});

//image resize 
Imgfly::routes();

Route::get('profile', function () {
    return view('donors.profile.profile');
});
Route::get('privacypolicy', function () {
    return view('sites.pages.privacypolicy');
});
Route::get('terms', function () {
    return view('sites.pages.terms');
});
Route::get('payment_success', function () {
    return view('sites.pages.confirm');
});
Route::get('faq', function () {
    return view('sites.pages.faq');
});
Route::get('contact', function () {
    return view('sites.pages.contact');
});
Route::get('plans', function () {
    return view('sites.pages.plans');
});
Route::get('careers', function () {
    return view('sites.pages.careers');
});
Route::get('blog', function () {
    return view('sites.pages.blog');
});
Route::get('partners', function () {
    $ngos = Role::where('name','ngo')->first()->users()->get(); 
   // return $ngos;
    return view('sites.pages.partners',compact('ngos'));
});
Route::get('ngos', function () {
    return view('sites.pages.ngos');
});
Route::get('donars', function () {
    return view('sites.pages.donars');
});
Route::get('donate', function () {
    return view('sites.pages.donate');
});
Route::get('works', function () {
    return view('sites.pages.works');
});

Route::get('beneficiarydetails', function () {
    return view('beneficiarydetails');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//invoice
Route::get('invoice', function () {
    return view('email.invoice');
}); 
//facebook Authentication 
Route::get('login/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\RegisterController@handleProviderCallback');

//Google+ Authentication
Route::get('google/redirect','Auth\GoogleController@redirect');
Route::get('google/callback','Auth\GoogleController@callback');

//donor registration
Route::get('donor_register',function(){
    return view('auth.donor_register');
});

//search fileter based on category and feature
Route::get('beneficiary_category_filters/{id}','Sites\CategoryController@category_fileters');
Route::get('beneficiary_feature_filters/{id}','Sites\CategoryController@feature_fileters');

//beneficiary details page
Route::get('beneficiary_detail/{id}','Sites\BeneficiaryController@beneficiary_detail');

//get beneficiary comments
 Route::get('get_comments','Sites\CommentController@get_comments');
//storing comments
 Route::post('comment_store','Sites\CommentController@store_comment');

//getting top donors 
 Route::get('top_donors','Sites\CommentController@top_donors');

 //razorpay payment gateway integration
Route::post('proceed_to_donate','Sites\PaymentController@proceed_to_pay');

Route::post('paysuccess','Sites\PaymentController@success');

//donate without login
Route::post('donate_without_login','Sites\PaymentController@donate_without_login');

//search option implementation api
Route::get('live_search','Sites\CategoryController@live_search');

//search results display
Route::get('search_result','Sites\CategoryController@search_result');


//donor profile 
Route::get('donor_dashboard','Sites\DonorController@donor_dashboard')->middleware('auth');
//user profile update
Route::post('user_profile_update','Sites\DonorController@user_profile_update');

//payment status
Route::get('payumoney_status','Sites\PaymentController@payumoney_status');

//Super-Admin routes start here 
Route::group(['prefix' =>'admin','middleware'=>['role:admin','auth']],function(){
  Route::get('dashboard','Admin\DashboardController@index');
  Route::resource('ngo','Admin\NgoController');
  Route::resource('beneficiary','Admin\BeneficiaryController');

  //ngo profile update
  Route::post('ngo/update','Admin\NgoController@update_ngo');

  //ngo douments update
  Route::post('ngo/documents_update','Admin\NgoController@documents_update');
  //beneficiary approve and reject
  Route::get('beneficiary/approve/{id}','Admin\BeneficiaryController@approve_beneficiary');
  Route::get('beneficiary/reject/{id}','Admin\BeneficiaryController@reject_beneficiary');

  //category management
  Route::resource('category','Admin\CategoryController');

  //feature management
  Route::resource('feature','Admin\FeatureController');

  //state management
  Route::resource('state','Admin\StateController');
  Route::post('csv_upload','Admin\StateController@csv_upload');
  //city management
  Route::resource('city','Admin\CityController');

  //donors management
  Route::resource('donors','Admin\DonorController');
  //donors role change
  Route::post('role_change','Admin\DonorController@role_change');

  //get city
  Route::get('get_city','Admin\DashboardController@get_city');

  //manage ngo users
  Route::resource('ngo_users','Admin\NgoUserController');

  //track fund details
  Route::get('track_fund','Admin\TrackController@track_fund');
  Route::get('beneficiary_track/{id}','Admin\TrackController@beneficiary_track');
  Route::get('track_fund_details/{id}','Admin\TrackController@track_fund_details');
  //download csv for payments of ngo
  Route::post('download_csv_fund','Admin\TrackController@download_csv');

  //donor register 
  Route::get('donor_email_check','Admin\DonorController@email_check');
  Route::post('donor_register','Admin\DonorController@donor_register');
  Route::post('donor_payment','Admin\DonorController@donor_payment');

});

//ngo routes start here
Route::group(['prefix' =>'ngo','middleware'=>['role:ngo','auth']],function(){
    Route::get('dashboard','NGO\DashboardController@index');

    //ngo profile 
    Route::get('profile/general','NGO\NgoProfileController@general');
    //get cities respect to state
    Route::get('profile/get_city','NGO\NgoProfileController@getCity');

    //ngo douments
    Route::get('profile/documents','NGO\NgoProfileController@documents');

    //ngo general update
    Route::post('ngo_profile_general','NGO\NgoProfileController@update_general');

    //ngo document update
    Route::post('ngo_profile_document','NGO\NgoProfileController@update_document');

    //beneficary
    Route::resource('beneficiary','NGO\BeneficiaryController');
    Route::get('beneficiary/create/{id}','NGO\BeneficiaryController@create');

    //createing users
    Route::resource('users','NGO\NgoUserController');

    //tracking of fundraise
    Route::get('track_rasied_amount','NGO\FundTrackController@index');
    Route::get('track_details/{id}','NGO\FundTrackController@track_details');

    //beneficiary updates
    Route::get('beneficairy_updates/{id}','NGO\BeneficiaryUpdateController@index');
    Route::post('benficiary_update_store','NGO\BeneficiaryUpdateController@store');


});


//ngo registration 
Route::resource('ngo','NGO\NgoRegisterController');

//contact enquiry store
Route::post('contact_store','Sites\WelcomeController@contact_store');

//support email 
Route::post('support_email','Sites\WelcomeController@support_email');
