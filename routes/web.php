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

Route::get('/', 'HomeController@index');

//Auth::routes();
Auth::routes(['verify' => true]);
Route::post('auth/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail') ->name('password.email'); //manual override, because default Auth::Routes not working for whatever reason
Route::get('auth/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset'); //manual override, because default Auth::Routes not working for whatever reason
Route::post('auth/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update'); //manual override, because default Auth::Routes not working for whatever reason

Route::group(['middleware'=>'is-ban'], function(){
	Route::get('/', 'HomeController@index');//->middleware('verified');
	Route::get('contact', 'ContactController@index');
	Route::get('getDownload/{id}', 'DownloadController@getDownload');
	Route::get('download', 'DownloadController@index')->middleware('verified');
	Route::get('profile', 'UserController@profile')->name('profile');
	Route::post('profile', 'UserController@updateProfile');
	Route::get('faq', 'FaqController@index')->name('faq');
	Route::resource('mailpdf', 'MailPdfController')->middleware(['verified','manually-verified']);
	Route::get('mailpdf/resend/{id}', 'MailPdfController@resend')->name('mailpdf.resend');
	Route::post('mailpdf/getFaecherByTestId', 'MailPdfController@getFaecherByTestId');
	Route::post('mailpdf/getExaminerByTestId', 'MailPdfController@getExaminerByTestId');
	Route::post('mailpdf/getExaminerByFach', 'MailPdfController@getExaminerByFach');
	Route::post('mailpdf/loadDates', 'MailPdfController@loadReminderDates');
	Route::get('verifyManually', 'ManualVerificationController@index')->middleware('verified')->name('mailpdf.verifyManually');
});

Route::get('terms', 'TermsController@index')->name('terms');
Route::resource('contact', 'ContactController');

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::get('{path}', 'HomeController@index')->where('path','([A-z\d-\/_.]+)?' );
