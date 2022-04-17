<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimeKeeperController;
use App\Http\Controllers\ViewJobController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\CompanyTypeController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\MyavailabilityController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentStatusController;
use App\Http\Controllers\RoasterStatusController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UpcomingeventController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\InductedsiteController;

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
    return view('auth.login');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
Route::get('/super-admin/home', [HomeController::class, 'SuperadminHome'])->name('super-admin.home')->middleware('super_admin');
//Company Routes
Route::get('/super-admin/companies', [CompanyController::class, 'index'])->name('companies')->middleware('super_admin');
Route::post('/super-admin/company/store', [UserController::class, 'storeCompanies'])->name('company-store')->middleware('super_admin');
Route::post('/super-admin/company/update', [UserController::class, 'updateCompany'])->name('company-update')->middleware('super_admin');
Route::get('/super-admin/company/delete/{id}', [CompanyController::class, 'delete'])->middleware('super_admin');

//super admin profile
Route::get('/super-admin/profile-settings/{id}', [CompanyController::class, 'SuperAdminProfile'])->middleware('super_admin');
Route::post('/super-admin/profile-settings/update', [CompanyController::class, 'profileUpdate'])->name('super-admin-profile-update')->middleware('super_admin');
Route::post('/super-admin/profile-settings/image/update', [CompanyController::class, 'UpdateSuperAdminPhoto'])->name('super-admin-profile-photo-update')->middleware('super_admin');
Route::post('/super-admin/user-password/change-password-store', [CompanyController::class, 'changePassStore'])->name('change-password-store')->middleware('super_admin');
Route::group(['middleware' => ['super_admin']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
//Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
// admin/company routes
Route::get('admin/home/{id}', [HomeController::class, 'adminHome'])->middleware('is_admin');
Route::get('admin/home/admins/{id}', [HomeController::class, 'adminHomeall'])->middleware('super_admin');
Route::get('admin/home/employee/{id}', [EmployeeController::class, 'index'])->middleware('is_admin');
Route::post('admin/home/employee/store', [EmployeeController::class, 'store'])->name('store-employee')->middleware('is_admin');
Route::post('admin/home/employee/update', [EmployeeController::class, 'update'])->name('update-employee')->middleware('is_admin');
Route::get('admin/home/employee/delete/{id}', [EmployeeController::class, 'delete'])->middleware('is_admin');

//admin/company profile routes
Route::get('/admin/company/profile-settings/{id}', [CompanyController::class, 'AdminProfile'])->middleware('is_admin');
Route::post('/admin/company/profile-settings/update', [CompanyController::class, 'AdminprofileUpdate'])->name('admin-profile-update')->middleware('is_admin');
Route::post('/admin/company/profile-settings/image/update', [CompanyController::class, 'UpdateAdminPhoto'])->name('admin-profile-photo-update')->middleware('is_admin');
Route::post('/admin/company/user-password/change-password-store', [CompanyController::class, 'AdminchangePassStore'])->name('admin-change-password-store')->middleware('is_admin');
//admin add clients
Route::get('admin/home/client/{id}', [ClientController::class, 'index'])->middleware('is_admin');
Route::post('admin/home/client/store', [ClientController::class, 'store'])->name('store-client')->middleware('is_admin');
Route::post('admin/home/client/update', [ClientController::class, 'update'])->name('update-client')->middleware('is_admin');
Route::get('admin/home/client/delete/{id}', [ClientController::class, 'delete'])->middleware('is_admin');

//admin add project
Route::get('admin/home/project/{id}', [ProjectController::class, 'index'])->middleware('is_admin');
Route::post('admin/home/project/store', [ProjectController::class, 'store'])->name('store-project')->middleware('is_admin');
Route::post('admin/home/project/update', [ProjectController::class, 'update'])->name('update-project')->middleware('is_admin');
Route::get('admin/home/project/delete/{id}', [ProjectController::class, 'delete'])->middleware('is_admin');

//admin timekeeper
Route::get('admin/home/timekeeper/{id}', [TimeKeeperController::class, 'index'])->middleware('is_admin');
Route::post('admin/home/timekeeper/store', [TimeKeeperController::class, 'storeTimeKeeper'])->name('store-timekeeper')->middleware('is_admin');
Route::post('admin/home/timekeeper/update', [TimeKeeperController::class, 'update'])->name('update-timekeeper')->middleware('is_admin');
Route::get('admin/home/timekeeper/delete/{id}', [TimeKeeperController::class, 'delete'])->middleware('is_admin');

Route::get("client/project/{id?}", [TimeKeeperController::class, "getProject"])->name("ajax.client.project")->middleware('is_admin');


//admin viewjob
Route::get('admin/home/viewjob/{id}', [ViewJobController::class, 'index'])->middleware('is_admin');
Route::post('admin/home/timekeeper/store', [TimeKeeperController::class, 'storeTimeKeeper'])->name('store-timekeeper')->middleware('is_admin');
Route::post('admin/home/timekeeper/update', [TimeKeeperController::class, 'update'])->name('update-timekeeper')->middleware('is_admin');
Route::get('admin/home/timekeeper/delete/{id}', [TimeKeeperController::class, 'delete'])->middleware('is_admin');


//admin payment
Route::get('admin/home/payment/{id}', [PaymentController::class, 'index'])->middleware('is_admin');
Route::post('admin/home/timekeeper/store', [TimeKeeperController::class, 'storeTimeKeeper'])->name('store-timekeeper')->middleware('is_admin');
Route::post('admin/home/timekeeper/update', [TimeKeeperController::class, 'update'])->name('update-timekeeper')->middleware('is_admin');
Route::get('admin/home/timekeeper/delete/{id}', [TimeKeeperController::class, 'delete'])->middleware('is_admin');
Route::post('admin/home/payment/search', [PaymentController::class, 'search'])->name('searchData')->middleware('is_admin');


Route::post('admin/home/viewjob/search', [ViewJobController::class, 'search'])->name('search')->middleware('is_admin');
Route::post('admin/home/timekeeper/search', [TimeKeeperController::class, 'search'])->name('searchTimekeeper')->middleware('is_admin');

//admin calender
Route::get('admin/home/calender/{id}', [CalenderController::class, 'index'])->middleware('is_admin');
Route::get('home/calender/{id}', [CalenderController::class, 'userIndex']);

// weekly report
Route::get('admin/home/status/{company_code}', [StatusController::class, 'index']);
Route::post('/status', [StatusController::class, 'store'])->name('status.store');
Route::post('/status/edit', [StatusController::class, 'update'])->name('status.update');
Route::get('status/delete/{id}', [StatusController::class, 'destroy']);


#roaster status
Route::get('admin/home/roaster/status/{company_code}', [RoasterStatusController::class, 'index']);
Route::post('roaster/status', [RoasterStatusController::class, 'store'])->name('roasterStatus.store');
Route::post('roaster/status/edit', [RoasterStatusController::class, 'update'])->name('roasterStatus.update');
Route::get('roaster/status/delete/{id}', [RoasterStatusController::class, 'destroy']);

#payment status
Route::get('admin/home/payment/status/{company_code}', [PaymentStatusController::class, 'index'])->name('payment.status');
Route::post('payment/status', [PaymentStatusController::class, 'store'])->name('paymentStatus.store');
Route::post('payment/status/edit', [PaymentStatusController::class, 'update'])->name('paymentStatus.update');
Route::get('payment/status/delete/{id}', [PaymentStatusController::class, 'destroy']);

#company type
Route::get('admin/home/company/type/{company_code}', [CompanyTypeController::class, 'index'])->name('company.type');
Route::post('company/type', [CompanyTypeController::class, 'store'])->name('companyType.store');
Route::post('company/type/edit', [CompanyTypeController::class, 'update'])->name('companyType.update');
Route::get('company/type/delete/{id}', [CompanyTypeController::class, 'destroy']);

#job type
Route::get('admin/home/job/type/{company_code}', [JobTypeController::class, 'index'])->name('job.type');
Route::post('job/type', [JobTypeController::class, 'store'])->name('jobType.store');
Route::post('job/type/edit', [JobTypeController::class, 'update'])->name('jobType.update');
Route::get('job/type/delete/{id}', [JobTypeController::class, 'destroy']);

#my availability
Route::get('admin/home/myavailability/{company_code}', [MyavailabilityController::class, 'index']);

Route::get('home/myavailability/{id}', [MyavailabilityController::class, 'userIndex']);

Route::post('myavailability', [MyavailabilityController::class, 'store'])->name('myAvailability.store');
Route::post('myavailability/edit', [MyavailabilityController::class, 'update'])->name('myAvailability.update');
Route::get('myavailability/delete/{id}', [MyavailabilityController::class, 'destroy']);


// Upcoming event routes
Route::get('admin/home/upcomingevent/{id}', [UpcomingeventController::class, 'index'])->middleware('is_admin');
Route::post('admin/home/upcomingevent/store', [UpcomingeventController::class, 'store'])->name('store-upcomingevent')->middleware('is_admin');
Route::post('admin/home/upcomingevent/update', [UpcomingeventController::class, 'update'])->name('update-upcomingevent')->middleware('is_admin');
Route::get('admin/home/upcomingevent/delete/{id}', [UpcomingeventController::class, 'delete'])->middleware('is_admin');

// Revenue routes
Route::get('admin/home/revenue/{id}', [RevenueController::class, 'index'])->middleware('is_admin');
Route::post('admin/home/revenue/store', [RevenueController::class, 'store'])->name('store-revenue')->middleware('is_admin');
Route::post('admin/home/revenue/update', [RevenueController::class, 'update'])->name('update-revenue')->middleware('is_admin');
Route::get('admin/home/revenue/delete/{id}', [RevenueController::class, 'delete'])->middleware('is_admin');

// Induction routes
Route::get('admin/home/inducted/site/{id}', [InductedsiteController::class, 'index'])->middleware('is_admin');
Route::post('admin/home/inducted/site/store', [InductedsiteController::class, 'store'])->name('store-induction')->middleware('is_admin');
Route::post('admin/home/inducted/site/update', [InductedsiteController::class, 'update'])->name('update-induction')->middleware('is_admin');
Route::get('admin/home/inducted/site/delete/{id}', [InductedsiteController::class, 'delete'])->middleware('is_admin');



// User Profile
Route::get('/user/employee/profile-settings/{id}', [EmployeeController::class, 'userProfile']);
Route::post('/user/employee/profile-settings/update', [EmployeeController::class, 'userProfileUpdate'])->name('user-profile-update');
Route::post('user/employee/profile-settings/image/update', [EmployeeController::class, 'updateUserPhoto'])->name('user-profile-photo-update');
Route::post('/user/employee/user-password/change-password-store', [EmployeeController::class, 'userchangePassStore'])->name('user-change-password-store');

