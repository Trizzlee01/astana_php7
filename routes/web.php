<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\AuthManageController;
use App\Http\Controllers\DashboardManageController;
use App\Http\Controllers\ManageAccountController;
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

Route::get('/', [AuthManageController::class, 'viewLogin'])->middleware('guest');
Route::get('/login', [AuthManageController::class, 'viewLogin'])->name('login')->middleware('guest');
Route::post('/verify_login', [AuthManageController::class, 'verifyLogin'])->middleware('guest');
Route::post('/logout', [AuthManageController::class, 'logoutProcess']);

Route::get('/dashboard', [DashboardManageController::class, 'viewDashboard'])->middleware('auth');

Route::middleware(['auth', 'checkRole:superadmin_pabrik,superadmin_distributor'])->group(function () {
    Route::resource('/manage_account/users', ManageAccountController::class);
    Route::post('fetch-cities', [ManageAccountController::class, 'fetchCity']);
});