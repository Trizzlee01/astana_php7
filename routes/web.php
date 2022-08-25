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

// Route::get('/', [AuthManageController::class, 'viewLogin'])->middleware('guest');
// Route::get('/login', [AuthManageController::class, 'viewLogin'])->name('login')->middleware('guest');
// Route::post('/verify_login', [AuthManageController::class, 'verifyLogin'])->middleware('guest');
// Route::post('/logout', [AuthManageController::class, 'logoutProcess']);

// Route::get('/dashboard', [DashboardManageController::class, 'viewDashboard'])->middleware('auth');

// Route::middleware(['auth', 'checkRole:superadmin_pabrik,superadmin_distributor'])->group(function () {
//     Route::resource('/manage_account/users', ManageAccountController::class);
//     Route::post('fetch-cities', [ManageAccountController::class, 'fetchCity']);
// });

Route::get('/', 'App\Http\Controllers\AuthManageController@viewLogin')->middleware('guest');
Route::get('/login', 'App\Http\Controllers\AuthManageController@viewLogin')->name('login')->middleware('guest');
Route::post('/verify_login', 'App\Http\Controllers\AuthManageController@verifyLogin')->middleware('guest');
Route::post('/logout', 'App\Http\Controllers\AuthManageController@logoutProcess');

Route::get('/dashboard', 'App\Http\Controllers\DashboardManageController@viewDashboard')->middleware('auth');

Route::middleware('auth', 'checkRole:superadmin_pabrik,superadmin_distributor')->group(function(){
    Route::resource('/manage_account/users', 'App\Http\Controllers\ManageAccountController');
    Route::post('/fetch-cities', 'App\Http\Controllers\ManageAccountController@fetchCity');
});

Route::middleware('auth', 'checkRole:superadmin_pabrik,superadmin_distributor,reseller')->group(function(){
    Route::resource('/manage_product/products', 'App\Http\Controllers\ProductManageController');
    Route::get('manage_product/detail_pasok/{product_history}', 'App\Http\Controllers\ProductManageController@detailPasok');
    Route::get('/manage_product/pusat', 'App\Http\Controllers\ProductManageController@indexPusat');
    Route::get('/manage_product/edit_pusat/{product}', 'App\Http\Controllers\ProductManageController@editPusat');
    Route::put('/manage_product/update_pusat/{product}', 'App\Http\Controllers\ProductManageController@updatePusat');
    Route::get('/manage_product/create_new_type/', 'App\Http\Controllers\ProductManageController@createType');
});


