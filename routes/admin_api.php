<?php use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------| API Routes|--------------------------------------------------------------------------|| 
Here is where you can register API routes for your application. These| routes are loaded by the RouteServiceProvider within a group which| is assigned the "api" middleware group. 
Enjoy building your API!|
*/
Route::apiResources(['user'=>'UserController']);
Route::apiResources(['examiner'=>'ExaminerController']);
Route::apiResources(['test'=>'TestController']);
Route::apiResources(['testExaminer'=>'TestExaminerController']);
Route::apiResources(['userToTest'=>'UserToTestController']);
Route::get('examiners','TestExaminerController@examiners');
Route::apiResources(['uploadPdf'=>'UploadPdfController']);
Route::apiResources(['reminder'=>'ReminderController']);
Route::apiResources(['statistik'=>'StatsController']);
Route::post('updateUploadPdf','UploadPdfController@updateUploadPdf');
Route::get('profile/{id}','UserController@profile');
Route::get('findUser','UserController@search');
Route::get('findFeedback','UserToTestController@search');
Route::put('profile','UserController@updateProfile');
Route::get('approvedUser/{id}','UserController@approvedUser');
Route::get('unapproveUser/{id}','UserController@unapproveUser');
Route::get('banUser/{id}','UserController@ban');
Route::get('revokeUser/{id}','UserController@revoke');
Route::get('unlockUser/{id}','UserToTestController@unlockUser');
Route::get('testDetailByUser/{id}','UserToTestController@testDetailByUser');
Route::get('deleteComment/{id}','UserToTestController@destroyComment');
