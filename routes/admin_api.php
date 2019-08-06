<?php use Illuminate\Http\Request;/*|--------------------------------------------------------------------------| API Routes|--------------------------------------------------------------------------|| Here is where you can register API routes for your application. These| routes are loaded by the RouteServiceProvider within a group which| is assigned the "api" middleware group. Enjoy building your API!|*/Route::middleware('auth:admin_api')->get('/user', function (Request $request) {    return $request->user();});Route::middleware('auth:admin_api')->get('/examiner', function (Request $request) {    return $request->examiner();});Route::middleware('auth:admin_api')->get('/test', function (Request $request) {    return $request->test();});Route::middleware('auth:admin_api')->get('/testexaminer', function (Request $request) {    return $request->testexaminer();});Route::middleware('auth:admin_api')->get('/usertotest', function (Request $request) {    return $request->usertotest();});/*Route::middleware('auth:admin_api')->get('/mailPdf', function (Request $request) {    return $request->mailpdf();});*/Route::middleware('auth:admin_api')->get('/reminder', function (Request $request) {    return $request->reminder();});Route::apiResources(['user'=>'UserController']);Route::apiResources(['examiner'=>'ExaminerController']);Route::apiResources(['test'=>'TestController']);Route::apiResources(['testExaminer'=>'TestExaminerController']);Route::apiResources(['userToTest'=>'UserToTestController']);Route::get('examiners','TestExaminerController@examiners');Route::apiResources(['uploadPdf'=>'UploadPdfController']);Route::apiResources(['reminder'=>'ReminderController']);Route::post('updateUploadPdf','UploadPdfController@updateUploadPdf');Route::get('profile/{id}','UserController@profile');Route::get('findUser','UserController@search');Route::get('findFeedback','UserToTestController@search');Route::put('profile','UserController@updateProfile');Route::get('approvedUser/{id}','UserController@approvedUser');Route::get('banUser/{id}','UserController@ban');Route::get('revokeUser/{id}','UserController@revoke');Route::get('unlockUser/{id}','UserToTestController@unlockUser');Route::get('testDetailByUser/{id}','UserToTestController@testDetailByUser');
Route::get('deleteComment/{id}','UserToTestController@destroyComment');
//Route::group([//    'middleware' => 'admin_api',//    //'prefix' => 'admin'////], function ($router) {////    Route::apiResources(['user'=>'UserController']);//    Route::get('profile','UserController@profile');//    Route::get('findUser','UserController@search');//    Route::put('profile','UserController@updateProfile');////});