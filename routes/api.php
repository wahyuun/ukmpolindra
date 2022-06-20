<?php

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\KegiatanApiController;
use App\Http\Controllers\LaporanApiController;
use App\Http\Controllers\LogbookApiController;
use App\Http\Controllers\ProposalApiController;
use App\Http\Controllers\UKMApiController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });`
Route::post('/auth/register', [AuthApiController::class, 'register']);
Route::post('/auth/login', [AuthApiController::class, 'login']);
Route::get('/ukm',[UKMApiController::class, 'index']);
Route::post('/ukm',[UKMApiController::class, 'store']);
Route::get('/ukm/{id}/edit',[UKMApiController::class, 'edit']);
Route::get('ukm/{id}',[UKMApiController::class, 'show']);
Route::put('/ukm/{id}',[UKMApiController::class, 'update']);
Route::delete('/ukm/{id}',[UKMApiController::class, 'destroy']);

Route::get('/kegiatan',[KegiatanApiController::class, 'index']);
Route::post('/kegiatan',[KegiatanApiController::class, 'store']);
Route::get('/kegiatan/{id}/edit',[KegiatanApiController::class, 'edit']);
Route::get('kegiatan/{id}',[KegiatanApiController::class, 'show']);
Route::put('/kegiatan/{id}',[KegiatanApiController::class, 'update']);
Route::delete('/kegiatan/{id}',[KegiatanApiController::class, 'destroy']);

Route::get('/laporan',[LaporanApiController::class, 'index']);
Route::post('/Laporan',[LaporanApiController::class, 'store']);
Route::get('/laporan/{id}/edit',[LaporanApiController::class, 'edit']);
Route::get('laporan/{id}',[LaporanApiController::class, 'show']);
Route::put('/laporan/{id}',[LaporanApiController::class, 'update']);
Route::delete('/laporan/{id}',[LaporanApiController::class, 'destroy']);

Route::get('/proposal',[ProposalApiController::class, 'index']);
Route::post('/proposal',[ProposalApiController::class, 'store']);
Route::get('/proposal/{id}/edit',[ProposalApiController::class, 'edit']);
Route::get('proposal/{id}',[ProposalApiController::class, 'show']);
Route::put('/proposal/{id}',[ProposalApiController::class, 'update']);
Route::delete('/proposal/{id}',[ProposalApiController::class, 'destroy']);

Route::get('/logbook',[LogbookApiController::class, 'index']);
Route::post('/logbook',[LogbookApiController::class, 'store']);
Route::get('/logbook/{id}/edit',[LogbookApiController::class, 'edit']);
Route::get('logbook/{id}',[LogbookApiController::class, 'show']);
Route::put('/logbook/{id}',[LogbookApiController::class, 'update']);
Route::delete('/logbook/{id}',[LogbookApiController::class, 'destroy']);
