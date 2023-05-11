<?php

use App\Http\Controllers\API\OtentikasiController;
use App\Http\Controllers\API\InstrukturController;
use App\Http\Controllers\API\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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

Route::post('/login', [OtentikasiController::class, 'login']);
Route::get('/logout', [OtentikasiController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/profile', [OtentikasiController::class, 'profile'])->middleware('auth:sanctum');

Route::get('/menu', [OtentikasiController::class, 'menu'])->middleware('auth:sanctum');
Route::get('/profile', [OtentikasiController::class, 'profile'])->middleware('auth:sanctum');

//Route untuk Website
Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
    Route::resource('instruktur', InstrukturController::class);
});

Route::group(['middleware' => ['auth:sanctum', 'kasir']], function () {
   
    Route::resource('member', MemberController::class)->only([
        'index', 'show', 'store', 'update', 'destroy'
    ]);
    Route::put('/member/reset-sandi/{id}', [MemberController::class, 'resetPassword']);
});

Route::group(['middleware' => ['auth:sanctum', 'managerOperasional']], function () {
    Route::resource('member', MemberController::class)->only([
        'index', 'show', 'store', 'update', 'destroy'
    ]);
    Route::put('/member/reset-sandi/{id}', [MemberController::class, 'resetPassword']);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('jadwal_harian', JadwalHarianController::class);
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request  
