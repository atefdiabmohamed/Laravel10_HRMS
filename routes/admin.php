<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Admin_panel_settingController;
use App\Http\Controllers\Admin\Finance_calendersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
define('PAGEINATION_COUNTER',11);
Route::group([ 'prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
/*  بداية الضبط العام */
Route::get('/generalSettings',[Admin_panel_settingController::class,'index'])->name('admin_panel_settings.index');
Route::get('/generalSettingsEdit',[Admin_panel_settingController::class,'edit'])->name('admin_panel_settings.edit');
Route::get('/generalSettingsupdate',[Admin_panel_settingController::class,'update'])->name('admin_panel_settings.update');
/*  بداية  تكويد السنوات المالية */
Route::get('/finance_calender/delete/{id}',[Finance_calendersController::class,'destroy'])->name('finance_calender.delete');
Route::post('/finance_calender/show_year_monthes',[Finance_calendersController::class,'show_year_monthes'])->name('finance_calender.show_year_monthes');
Route::get('/finance_calender/do_open/{id}',[Finance_calendersController::class,'do_open'])->name('finance_calender.do_open');
Route::resource('/finance_calender', Finance_calendersController::class);
});
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
Route::get('login', [LoginController::class, 'show_login_view'])->name('admin.showlogin');
Route::post('login', [LoginController::class, 'login'])->name('admin.login');
});
Route::fallback(function(){
return redirect()->route('admin.showlogin');
});