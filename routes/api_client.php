<?php

use App\Http\Controllers\Api\CheckinController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\DepController;
use App\Http\Controllers\Api\EditController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\AddController;
use App\Http\Controllers\Api\RecordController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::resource('store', CheckinController::class);
Route::resource('upload', UploadController::class);
Route::post('checkout', [CheckinController::class, 'checkout']);

// Route::post('logout', [AuthController::class, 'logout']);

// Route::middleware('guest')->group(function () {
//     Route::post('login', [AuthController::class, 'login']);
// });

// Route::middleware('auth:sanctum')->group(function () { 
//     Route::get('user', UserController::class);
//     Route::post('reportDay', [ReportController::class, 'reportDay']);
//     Route::resource('dep', DepController::class);
//     Route::get('editin/{id}', [EditController::class, 'editin']);
//     Route::get('editout/{id}', [EditController::class, 'editout']);
//     Route::post('updatein', [EditController::class, 'updatein']);
//     Route::post('updateout', [EditController::class, 'updateout']);
//     Route::resource('member', MemberController::class);
//     Route::post('reportMember', [ReportController::class, 'reportMember']);
//     Route::get('showname/{uid}', [AddController::class, 'showname']);
//     Route::post('addin', [AddController::class, 'addin']);
//     Route::post('addout', [AddController::class, 'addout']);
//     Route::resource('record', RecordController::class);
// });
