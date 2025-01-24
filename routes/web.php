<?php

use Illuminate\Support\Facades\Route;

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
Route::get('phpinfo', function () {
	phpinfo();
});
Route::get('privacy-policy', function(){
	return view('privacy_policy');
});
Route::get('about-us', function(){
	return view('about_us');
});
Route::get('terms-conditions', function(){
	return view('terms_conditions');
});

Route::get('/', [BreadcrumbController::class, 'showPage']);

Route::get("/page", 'BreadcrumbController@showPage');


Route::get('iframe-policy', function(){
	return view('iframe_policy');
});
Route::get('/clear-cache', function () {
	$exitCode = Artisan::call('config:clear');
	$exitCode = Artisan::call('cache:clear');
	$exitCode = Artisan::call('config:cache');
	$exitCode = Artisan::call('route:clear');
	$exitCode = Artisan::call('view:clear');
	return 'DONE'; //Return anything
});

Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

Route::get("/cron/graduation-student", 'CronController@changeStudentStatus');
Route::get("/ajax/skills", 'AjaxController@skillData');
Route::prefix('admin')->group(function () {
	Route::get('login', 'AdminAuth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'AdminAuth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('logout', 'AdminAuth\AdminLoginController@logout')->name('admin.logout');
	Route::get('/', 'AdminAuth\AdminController@index')->name('admin.dashboard');	
	Route::get('/password/reset', 'AdminAuth\AdminLoginController@adminPasswordRequest')->name('admin.password.request');
	Route::post('reset_password_without_token', 'AdminAuth\AdminLoginController@validatePasswordRequest');
	//Route::post('reset_password_with_token', 'AdminAuth\AdminLoginController@resetPassword');
    Route::post('/passwords/reset', 'AdminAuth\AdminLoginController@PasswordsReset')->name('admin.password.update');
	Route::get('/ad-password/reset/{token}', 'AdminAuth\AdminLoginController@adPasswordRequest');
});

	Route::get('/passwords/reset', 'Auth\LoginController@PasswordRequest')->name('password.cuRequest');
	Route::post('reset_password_without_token', 'Auth\LoginController@validatePasswordRequest');
    Route::post('/passwords/reset', 'Auth\LoginController@PasswordsReset')->name('passwords.update');
	
	
	 Route::get('/verifyaccount/{link}', 'Auth\LoginController@verifyaccount')->name('verifyaccount');
	
	
Route::namespace('Admin')->name('admin.')->group(function () {
	Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {
		Route::get("/", 'AdminController@dashboard')->name('dashboard');
		Route::get("/dashboard", 'AdminController@dashboard')->name('dashboard');
			Route::get("/change_password", 'AdminController@change_password')->name("change_password");
		Route::put("/update_password", 'AdminController@update_password')->name("update_password");
		Route::get("/profile", 'AdminController@profile')->name("profile");
		Route::put("/profile", 'AdminController@updateProfile')->name("updateProfile");
		Route::get("/users-list/{name}", 'UsersListController@userListBy')->name('userListBy');
		Route::get("/user-details/{user}", 'UsersListController@userDetails')->name("userDetails");
		Route::get("/user-edit/{user}", 'UsersListController@editUser')->name("userEdit");
		Route::put("/user-update/{user}", 'UsersListController@updateUser')->name("updateUser");
		Route::get("/user-delete/{user}", 'UsersListController@userDelete')->name("userDelete");
		Route::get("/school-list", 'UsersListController@schoolListBy')->name('schoolListBy');
		Route::get("/school-details/{user}", 'UsersListController@schoolDetails')->name("schoolDetails");
		Route::get("/school-add", 'UsersListController@addSchool')->name("addSchool");
		Route::put("/school-store", 'UsersListController@storeSchool')->name("storeSchool");
		Route::get("/school-edit/{user}", 'UsersListController@editSchool')->name("editSchool");
		Route::put("/school-update/{user}", 'UsersListController@updateSchool')->name("updateSchool");
		Route::get("/student-edit/{user}", 'UsersListController@editStudent')->name("editStudent");
		Route::get("/non-school-list", 'UsersListController@nonSchoolListBy')->name('nonSchoolListBy');
		Route::get("/non-school-details/{user}", 'UsersListController@nonSchoolDetails')->name("nonSchoolDetails");
		Route::get("/non-school-add", 'UsersListController@addNonSchool')->name("addNonSchool");
		Route::put("/non-school-store", 'UsersListController@storeNonSchool')->name("storeNonSchool");
		Route::get("/non-school-edit/{user}", 'UsersListController@editNonSchool')->name("editNonSchool");

		Route::put("/payment-store/{user}", 'UsersListController@storePayment')->name("storePayment");
		Route::get("/payment-delete/{payment}", 'UsersListController@paymentDelete')->name("paymentDelete");
		Route::post("/change-status/{user_id}", 'UsersListController@changeUserStatus')->name("changeUserStatus");
			Route::get("/change-status/{user_id}", 'UsersListController@changeUserStatuss')->name("changeUserStatuss");
		Route::post("/change-school-status/{id}", 'UsersListController@changeSchoolStatus')->name("changeSchoolStatus");
		Route::get("/change-school-status/{id}", 'UsersListController@changeSchoolStatus')->name("changeSchoolStatuss");
		
		Route::get("/manager-list", 'UsersListController@managerListBy')->name('managerListBy');
		Route::get("/manager-details/{user}", 'UsersListController@managerDetails')->name("managerDetails");
		Route::get("/manager-add", 'UsersListController@addManager')->name("addManager");
		Route::put("/manager-store", 'UsersListController@storeManager')->name("storeManager");
		Route::get("/manager-edit/{user}", 'UsersListController@editManager')->name("editManager");
		Route::put("/manager-update/{user}", 'UsersListController@updateManager')->name("updateManager");
		
		Route::get("/employer-list", 'UsersListController@employerListBy')->name('employerListBy');
		Route::get("/employer-add", 'UsersListController@addEmployer')->name("addEmployer");
		Route::get("/employer-details/{user}", 'UsersListController@detailsEmployer')->name("detailsEmployer");
		Route::put("/employer-store", 'UsersListController@storeEmployer')->name("storeEmployer");
		Route::get("/employer-edit/{user}", 'UsersListController@editEmployer')->name("editEmployer");
		Route::put("/employer-update/{user}", 'UsersListController@updateEmployer')->name("updateEmployer");

		Route::get("/import/school", 'csvImportExport@importSchool')->name("importSchool");
		Route::put("/import/school", 'csvImportExport@putImportSchool')->name("putImportSchool");
		
		Route::get("/plans", 'PlanController@index')->name('plans');
		//Route::get("/plan-detail/{plan}", 'PlanController@planDetails')->name("planDetails");
		Route::get("/plan-add", 'PlanController@addPlan')->name("addPlan");
		Route::put("/plan-store", 'PlanController@storePlan')->name("storePlan");
		Route::get("/plan-edit/{plan}", 'PlanController@editPlan')->name("editPlan");		
			Route::get("/plan-detail/{plan}", 'PlanController@detailsPlan')->name("detailsPlan");		
		Route::put("/plan-update/{plan}", 'PlanController@updatePlan')->name("updatePlan");
		Route::get("/plan-update-status/{plan}", 'PlanController@updateStatusPlan')->name("updateStatusPlan");
		
		
		Route::get("/chat/{alertId}", 'UsersListController@chat')->name('chat');
		
		Route::get("/send-notification", 'AlertController@sendNotification')->name("sendNotification");
		Route::put("/send-notification", 'AlertController@putSendNotification')->name('putSendNotif');
		Route::get("/sent-notification", 'AlertController@sentNotification')->name("sentNotification");
		Route::get("/send-mail", 'AlertController@sendMailMess')->name('sendMailMess');
		Route::put("/send-mail", 'AlertController@putSendMailMess')->name('putSendMailMess');
	});
});

Route::group(['prefix' => 'crm'], function(){
Route::name('employer.')->group(function(){
	Route::group(['middleware' => ['auth', 'employer']], function (){
		Route::get("/", 'EmployerController@dashbords')->name('dashbords');
		Route::get("/job_list", 'EmployerController@jobListBy')->name('jobListBy');
		Route::get("/profile", 'EmployerController@profile')->name("profile");
		Route::put("/profile", 'EmployerController@updateProfile')->name("updateProfile");
	Route::get("/change_password", 'EmployerController@change_password')->name("change_password");
		Route::put("/change_password", 'EmployerController@update_change_password')->name("update_change_password");
		Route::get("/job-add", 'EmployerController@addJob')->name("addJob");
		Route::post("/job-store", 'EmployerController@storeJob')->name("storeJob");

		Route::get("job-details/{job}", 'EmployerController@jobDetail')->name('jobDetail');
		Route::get("jobsettrash/{job}", 'EmployerController@changeJobStatus')->name('jobSetTrash');
		Route::get("job-edit/{job}", 'EmployerController@editJob')->name('editJob');
	    Route::get("job-view/{job}", 'EmployerController@viewJob')->name('viewJob');
		Route::put("job-update/{job}", 'EmployerController@jobUpdate')->name('jobUpdate');
	
	//Route::get("job-delete/{job}", 'EmployerController@jobDelete')->name('jobDelete');
		Route::post("change-job-status/{job}", 'EmployerController@changeJobStatus')->name('changeJobStatus');
		
		Route::get("/projects", 'EmployerController@projectListBy')->name('projectListBy');
		Route::get("/project-add", 'EmployerController@addProject')->name("addProject");
		Route::put("/project-store", 'EmployerController@storeProject')->name("storeProject");
		Route::get("project-edit/{project}", 'EmployerController@editProject')->name('editProject');
		Route::put("project-update/{project}", 'EmployerController@projectUpdate')->name('projectUpdate');
		Route::post("change-project-status/{project}", 'EmployerController@changeProjectStatus')->name('changeProjectStatus');
		
		Route::get("/project-members/{project}", 'EmployerController@projectMembers')->name('projectMembers');
		Route::get("/pm-remove/{project}/{projectMembers}", 'EmployerController@pmRemove')->name('pmRemove');
		Route::get("/student-filter", 'EmployerController@studentFilter')->name('studentFilter');
		
		Route::get("applications/{job_id}","EmployerController@applications")->name("applications");
		Route::get("applications-all","EmployerController@applications_all")->name("applications_all");
	    
	    Route::get("/user-job-data/{user_id}/{job_id}", "EmployerController@jobUserDetails")->name("jobUserDetails");
	    
	    Route::post("/add-user-in-project", "EmployerController@addUserInProject")->name("addUserInProject");

		
	});
});
});

Route::post("/message/{alertId}", "Admin\UsersListController@sentMessage")->name("sentMessage");

//Route::get("/manager", function (){});
Route::get("/interviewsdata","Manager\ManagerController@manageallInterviews");
Route::get("/interviews","Manager\ManagerController@interviewSlots")->name("interviewSlots");
Route::get("/interview-edit/{index}/{day}","Manager\ManagerController@interviewSlotEdit")->name("interviewSlotsEdit");
Route::get("/interview-delete/{index}/{day}","Manager\ManagerController@interviewSlotDelete")->name("interviewSlotDelete");
Route::patch("/interview-update/{index}/{day}","Manager\ManagerController@interviewSlotUpdate")->name("interviewSlotUpdate");
Route::post("/interview-store","Manager\ManagerController@interviewSlotStore")->name("interviewSlotStore");
Route::get("/interview-list","Manager\ManagerController@getInterviewerList")->name("getInterviewerList");
Route::put("ivideo-update/{id}", 'Manager\ManagerController@updateIVideo')->name('updateIVideo');
Route::post("/change-isb-status/{id}", 'Manager\ManagerController@changeISBStatus')->name("changeISBStatus");
Route::get("/interview/{id}","Manager\ManagerController@getInterview")->name("getInterview");
Route::get("/change_password", 'Manager\ManagerController@change_password')->name("change_password");
Route::put("/change_password", 'Manager\ManagerController@update_change_password')->name("update_change_password");
Route::get("/my-profile", 'Manager\ManagerController@profile')->name("myProfile");
Route::put("/my-profile", 'Manager\ManagerController@updateProfile')->name("updateMyProfile");