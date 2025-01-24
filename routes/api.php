<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["prefix" => "auth"], function () {
    Route::post('signin', 'ApiAuth\SignInController');
    Route::post('logout', 'ApiAuth\SignInController@logout');
});
Route::post("register/professional", "ApiAuth\RegisterController@registerProfessional");
Route::post("register/student", "ApiAuth\RegisterController@registerStudent");
Route::post("verify/{type}", "ApiAuth\RegisterController@verify");
Route::post('resend-mail-verify', 'ApiAuth\SignInController@resendMailVerify');

Route::post('forget-password', 'ApiAuth\SignInController@forgetPassword');
Route::post("change-password", "Api\ProfileController@changePassword");
Route::post("student-id/update", "Api\ProfileController@studentIdCardUpdate");
Route::post("user-fln/update", "Api\ProfileController@userFLUpdate");
/*
Route::post("info-by-code", "Api\ProfileController@infoByCode");
Route::post("update-user/lat-lng", "Api\ProfileController@updateLatLg");*/
Route::get("states", "Api\ProfileController@states");
Route::get("school-by-state/{state}", "Api\ProfileController@SchoolByState");

Route::post("/upload-document/{user_id}", "Api\ProfileController@uploadDocument");
Route::get("/lang-docs-appoit/{user_id}", "Api\ProfileController@lanApointDocs")->name("lanApointDocs");
Route::post("/app-appoint", "Api\ProfileController@addAppoint")->name("addAppoint");


Route::get("jobs", "Api\JobProjectController@jobs");

Route::get("favourites", "Api\JobProjectController@favourites");

Route::get("plans", "Api\PlanController@plans");
Route::post("plan-purchase", "Api\PlanController@planPurchase");

Route::post("insertjobfav", "Api\JobProjectController@insertjobfav");
Route::post("removejobfav", "Api\JobProjectController@removejobfav");


Route::get("/interview-list/{user_id}", "Api\PlanController@checkTotalInter");

Route::get("/get-interviewer/{job_id}/{totalDays}","Api\ManagerController@getInterviewer")->name("getInterviewer");

Route::post("/book-interview-slot", "Api\ManagerController@bookInterviewSlot");
Route::get("/book-interview-slot-list/{user_id}", "Api\ManagerController@bookInterviewSlotList");

Route::get("get-resume-profile/{user_id}", "Api\ProfileController@getResumeProfile");

Route::get("user-job-applied-list/{user_id}", "Api\ProfileController@userJobAppliedList");

Route::post("job-apply-store/{user_id}/{job_id}", "Api\ProfileController@applyJob");

Route::post("add-in-multi-table/{user_id}/{type}","Api\ProfileController@addInMultiTable");

Route::post("delete-in-multi-table/{user_id}/{delete_id}/{type}","Api\ProfileController@deleteInMultiTable");

Route::put("update-in-multi-table/{user_id}/{update_id}/{type}","Api\ProfileController@allTableUpdate");


Route::post("profile-image-upload/{user_id}", "Api\ProfileController@profileImage");



Route::put("resume-update/{user_id}","Api\ProfileController@updateUserResume");
Route::get("receive-notification/{user}", "Api\AlertController@receiveNotification");
/*Route::post("school-search", "Api\ProfileController@schoolSearch");
Route::post("user-act_deact", "Api\ProfileController@userActDeact");
Route::get("/chat/{alert_id}", 'Api\ChatController@messageList')->name("chat");
*/
Route::group(["prefix" => "auth", "middleware" => "auth:api"], function () {
    Route::get("me", "ApiAuth\SignInController@me");
    Route::get("test", "ApiAuth\SignInController@test");
});