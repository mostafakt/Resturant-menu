<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MediumController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Firebase\JWT\JWT;
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

// <editor-fold default-state="collapsed" desc="Auth">
Route::group(['prefix' => 'auth'], function () {
    Route::get('me', [AuthController::class, 'getMe']);
    Route::put('me', [AuthController::class, 'updateMe']);

    Route::get('client/me', [AuthController::class, 'clientGetMe']);
    Route::put('client/me', [AuthController::class, 'clientUpdateMe']);
    Route::put('client/verify-mobile', [AuthController::class, 'verifyMobile']);
    Route::post('me/change-language', [AuthController::class, 'changeLanguage']);
    Route::post('me/change-fcm-token', [AuthController::class, 'changeFCMToken']);

    Route::get('investor/me', [AuthController::class, 'investorGetMe']);
    Route::put('investor/me', [AuthController::class, 'investorUpdateMe']);

    Route::get('driver/me', [AuthController::class, 'driverGetMe']);
    Route::put('driver/me', [AuthController::class, 'driverUpdateMe']);

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('client-login', [AuthController::class, 'clientLogin']);
    Route::post('driver-login', [AuthController::class, 'driverLogin']);
    Route::post('investor-login', [AuthController::class, 'investorLogin']);
    Route::post('send-otp', [AuthController::class, 'sendOtp'])->middleware('throttle:5,1');

    Route::post('verify', [AuthController::class, 'verify']);
    Route::post('resend-verification-code', [AuthController::class, 'resendVerificationCode']);

    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::post('forget-password', [AuthController::class, 'forgetPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
});
// </editor-fold>
// <editor-fold default-state="collapsed" desc="Media">
Route::post('media/multiple', [MediumController::class, 'storeMultiple']);
Route::apiResource('/media', MediumController::class);
// </editor-fold>

// <editor-fold default-state="collapsed" desc="Roles & Permission">
Route::apiResource('/roles', RoleController::class);
Route::apiResource('/permissions', PermissionController::class)->only('index');
// </editor-fold>

// <editor-fold default-state="collapsed" desc="Category & Attribute">
Route::apiResource('/category', CategoryController::class);

// </editor-fold>

// <editor-fold default-state="collapsed" desc="Employees">
Route::apiResource('/employees', EmployeeController::class);
// </editor-fold>
// <editor-fold default-state="collapsed" desc="Client">
Route::apiResource('/clients', ClientController::class)->except('store');
// </editor-fold>
// <editor-fold default-state="collapsed" desc="items">
Route::apiResource('/items', ItemController::class);
// </editor-fold>
// <editor-fold default-state="collapsed" desc="menu">
Route::apiResource('/menus', MenuController::class);
// </editor-fold>


route::get('test', function (Request $request) {

});
