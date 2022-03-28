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
use App\Http\Controllers\PaymentController;

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

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

});
Route::get('/super-admin/home', [HomeController::class, 'SuperadminHome'])->name('super-admin.home')->middleware('super_admin');
//Company Routes
Route::get('/super-admin/companies', [CompanyController::class, 'index'])->name('companies')->middleware('super_admin');
Route::post('/super-admin/company/store', [UserController::class, 'storeCompanies'])->name('company-store')->middleware('super_admin');
Route::post('/super-admin/company/update', [CompanyController::class, 'updateCompany'])->name('company-update')->middleware('super_admin');
Route::get('/super-admin/company/delete/{id}', [CompanyController::class, 'delete'])->middleware('super_admin');

//super admin profile
Route::get('/super-admin/profile-settings/{id}', [CompanyController::class,'SuperAdminProfile'])->middleware('super_admin');
Route::post('/super-admin/profile-settings/update', [CompanyController::class,'profileUpdate'])->name('super-admin-profile-update')->middleware('super_admin');
Route::post('/super-admin/profile-settings/image/update', [CompanyController::class,'UpdateSuperAdminPhoto'])->name('super-admin-profile-photo-update')->middleware('super_admin');
Route::post('/super-admin/user-password/change-password-store',[CompanyController::class,'changePassStore'])->name('change-password-store')->middleware('super_admin');
Route::group(['middleware' => ['super_admin']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

});
//Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
// admin/company routes
Route::get('admin/home/', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('admin/home/admins/{id}', [HomeController::class, 'adminHomeall'])->middleware('super_admin');
Route::get('admin/home/employee/{id}', [EmployeeController::class, 'index'])->middleware('is_admin');
Route::post('admin/home/employee/store', [EmployeeController::class, 'store'])->name('store-employee')->middleware('is_admin');
Route::post('admin/home/employee/update', [EmployeeController::class, 'update'])->name('update-employee')->middleware('is_admin');
Route::get('admin/home/employee/delete/{id}', [EmployeeController::class, 'delete'])->middleware('is_admin');

//admin/company profile routes
Route::get('/admin/company/profile-settings/{id}', [CompanyController::class,'AdminProfile'])->middleware('is_admin');
Route::post('/admin/company/profile-settings/update', [CompanyController::class,'AdminprofileUpdate'])->name('admin-profile-update')->middleware('is_admin');
Route::post('/admin/company/profile-settings/image/update', [CompanyController::class,'UpdateAdminPhoto'])->name('admin-profile-photo-update')->middleware('is_admin');
Route::post('/admin/company/user-password/change-password-store',[CompanyController::class,'AdminchangePassStore'])->name('admin-change-password-store')->middleware('is_admin');
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
