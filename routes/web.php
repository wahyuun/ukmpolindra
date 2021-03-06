<?php

use App\Http\Controllers\AuthenticationLogController;
use App\Http\Controllers\KegiatanApiController;
use App\Models\UKM;
use App\Models\User;
use App\Models\Logbook;
use App\Models\Kegiatan;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Models\AuthenticationLoggable;
use App\Http\Controllers\UKMController;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProposalController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
Auth::routes(['verify' => true]);


Route::get('/', function () {
    return view('welcome',[
        'title'=>'UKM Application'
    ]);

})->name('/');

// Laravel Manager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Profile
Route::get('/profile',[ProfileController::class,'index'])->middleware(['auth','verified'])->name('profile');
Route::get('/profile/all-user',[ProfileController::class,'all'])->middleware(['auth','verified'])->name('all');
Route::get('/profile/show',[ProfileController::class,'show'])->middleware(['auth','verified'])->name('profile-show');
Route::patch('/profile/update',[ProfileController::class,'update'])->middleware(['auth','verified'])->name('profile-update');
// Route::post('/profile/updateFoto',[ProfileController::class,'updateFoto'])->middleware(['auth','verified'])->name('updateFoto');


Route::resource('/dashboard/ukm',UKMController::class)->middleware('auth');
Route::get('/dashboard',[UKMController::class,'index'])->middleware('auth')->name('dashboard');
Route::get('/ukm/aktif',[UKMController::class,'updateAktif'])->middleware('auth')->name('ukm-aktif');
Route::get('/ukm/nonaktif',[UKMController::class,'updateNonaktif'])->middleware('auth')->name('ukm-nonaktif');
Route::get('/ukm/deleted',[UKMController::class,'destroy'])->middleware('auth')->name('ukm-deleted');
Route::get('/ukm',[UKMController::class,'show'])->middleware('auth')->name('desc-ukm');
// Membuat route Slug menambahkan UKM
Route::get('/dashboard/checkSlug',[UKMController::class,'checkSlug'])->middleware('auth');


// Kegiatan
Route::resource('/kegiatan',KegiatanController::class)->middleware(['auth','verified']);
Route::get('/act-detailKegiatan',[KegiatanController::class,'show'])->middleware('auth')->name('act-detailKegiatan');
Route::put('/act-kegiatanDiterima',[KegiatanController::class,'kegiatanDiterima'])->middleware('auth')->name('act-kegiatanDiterima');
Route::put('/act-kegiatanDitolak',[KegiatanController::class,'kegiatanDitolak'])->middleware('auth')->name('act-kegiatanDitolak');
Route::patch('/act-kegiatanPending',[KegiatanController::class,'kegiatanPending'])->middleware('auth')->name('act-kegiatanPending');
Route::get('/act-komentar',[KegiatanController::class,'komentar'])->middleware('auth')->name('act-komentar');
Route::get('/act-editKomentar/{Komentar:slug}',[KegiatanController::class,'edit'])->middleware('auth')->name('act-editKomentar');
Route::put('/act-updateKomentar/{kegiatan}',[KegiatanController::class,'update'])->middleware('auth')->name('act-updateKomentar');
Route::put('/act-deleteKomentar/{kegiatan}',[KegiatanController::class,'deleteKomentar'])->middleware('auth')->name('act-deleteKomentar');
Route::get('/act-showKegiatan',[KegiatanController::class,'swKegiatan'])->middleware(['auth','verified'])->name('swKegiatan');
// Ajax DataTables Kegiatan
Route::get('/data-kegiatan',[KegiatanController::class,'data_kegiatan'])->middleware('auth')->name('data-kegiatan');

//proposal
Route::get('/proposal',[ProposalController::class,'index'])->middleware('auth')->name('proposal');
Route::get('/ac-detailProposal',[ProposalController::class,'show'])->middleware('auth')->name('ac-detailProposal');
Route::put('/ac-proposalDiterima',[ProposalController::class,'proposalDiterima'])->middleware('auth')->name('ac-proposalDiterima');
Route::put('/ac-proposalDitolak',[ProposalController::class,'proposalDitolak'])->middleware('auth')->name('ac-proposalDitolak');
Route::patch('/ac-proposalPending',[ProposalController::class,'proposalPending'])->middleware('auth')->name('ac-proposalPending');
Route::get('/ac-komentar',[ProposalController::class,'komentar'])->middleware('auth')->name('ac-komentar');
Route::get('/ac-editKomentar/{proposal}',[ProposalController::class,'edit'])->middleware('auth')->name('ac-editKomentar');
Route::put('/ac-updateKomentar',[ProposalController::class,'update'])->middleware('auth')->name('ac-updateKomentar');
Route::put('/ac-deleteKomentar/{id}',[ProposalController::class,'deleteKomentar'])->middleware('auth')->name('ac-deleteKomentar');
Route::get('/ac-showProposal',[ProposalController::class,'swProposal'])->middleware(['auth','verified'])->name('swProposal');
// Ajax DataTables proposal
Route::get('/data-proposal',[ProposalController::class,'data_proposal'])->middleware('auth')->name('data-proposal');

// Logbook
Route::get('/log-book',[LogbookController::class,'index'])->middleware('auth')->name('logbook');
Route::get('/lg-detailLogbook',[LogbookController::class,'show'])->middleware('auth')->name('lg-detailLogbook');
Route::get('/lg-deleteLogbook',[LogbookController::class,'delLogbook'])->middleware(['auth','verified'])->name('delLogbook');
// Dashboard show detail
Route::get('/lg-showLogbook',[LogbookController::class,'swLogbook'])->middleware(['auth','verified'])->name('swLogbook');
// Ajax DataTables Logbook
Route::get('/data-logbook',[LogbookController::class,'data_logbook'])->middleware('auth')->name('data-logbook');

// Laporan
Route::get('/laporan',[LaporanController::class,'index'])->middleware('auth')->name('laporan');
Route::get('/lp-detailLaporan',[LaporanController::class,'show'])->middleware('auth')->name('lp-detailLaporan');
Route::get('/lp-showLaporan',[LaporanController::class,'swLaporan'])->middleware(['auth','verified'])->name('swLaporan');
// Ajax DataTables laporan
Route::get('/data-laporan',[LaporanController::class,'data_laporan'])->middleware('auth')->name('data-laporan');

// Log-aktivitas atau admin.home.index
Route::get('/log-activity',[AuthenticationLogController::class,'index'])->middleware(['auth'])->name('log-activity');
// Ajax DataTables Kegiatan
Route::get('/data-verification',[AuthenticationLogController::class,'data_verification'])->middleware(['auth','verified'])->name('data-verification');


Route::prefix('admin')->middleware(['auth', 'verified', 'role:1'])->group(function () {

    Route::get('/users/verification', [App\Http\Controllers\UserVerificationController::class, 'index'])->name('users.verification');
    Route::post('/users/qrcode', [App\Http\Controllers\UserVerificationController::class, 'checkQRCode'])->name('users.qrcode');
    Route::post('/users/verify', [App\Http\Controllers\UserVerificationController::class, 'verify'])->name('users.verify');
});

Route::prefix('client')->middleware(['auth', 'verified', 'role:3'])->group(function () {
    Route::get("/", [App\Http\Controllers\ClientHomeController::class, 'index'])->name('client.index');
});
