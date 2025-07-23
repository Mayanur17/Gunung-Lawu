<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesonaController;
use App\Http\Controllers\PeralatanTektokController;
use App\Http\Controllers\PeralatanCampController;
use App\Http\Controllers\PersiapanController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\JalurController;
use App\Http\Controllers\PendakiController;
use App\Http\Controllers\CeritaPendakiController;
use App\Http\Controllers\CemorokandangKuotaController;
use App\Http\Controllers\CemorosewuKuotaController;
use App\Http\Controllers\CethoKuotaController;
use App\Http\Controllers\BookingKandangController;
use App\Http\Controllers\BookingSewuController;
use App\Http\Controllers\BookingCethoController;
use App\Http\Middleware\RoleMiddleware;



Route::get('/', function () {
    return view('beranda');
})->name('beranda');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/jalur', function () {
    return view('jalurutama');
})->name('jalurutama');
Route::get('/pendaki/cerita', [CeritaPendakiController::class, 'index'])->name('cerita.index');
    Route::post('/pendaki/cerita', [CeritaPendakiController::class, 'simpan'])->name('cerita.simpan');
    Route::post('/pendaki/cerita/{id}/balas', [CeritaPendakiController::class, 'balas'])->name('cerita.balas');

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::resource('admin/pesona', PesonaController::class)->names('pesona');
    Route::resource('admin/peralatantektok', PeralatanTektokController::class)->names('peralatantektok');
    Route::resource('admin/peralatancamp', PeralatanCampController::class)->names('peralatancamp');
    Route::resource('admin/persiapan', PersiapanController::class)->names('persiapan');
    Route::resource('admin/info', InfoController::class)->names('info');
    Route::resource('admin/berita', BeritaController::class)->names('berita')->parameters(['berita' => 'berita']);
    Route::get('/admin/jalur', [JalurController::class, 'index'])->name('jalur.index');
    Route::get('/admin/jalur/edit/{jalur}', [JalurController::class, 'edit'])->name('jalur.edit');
    Route::put('/admin/jalur/update/{jalur}', [JalurController::class, 'update'])->name('jalur.update');
    Route::get('/admin/booking/cemorokandang', [BookingKandangController::class, 'index'])->name('admin.booking.cemorokandang.index');
    Route::post('/admin/booking/cemorokandang/{id}/approve', [BookingKandangController::class, 'approve'])->name('booking.cemorokandang.approve');
    Route::get('/admin/booking/cemorokandang/{id}/detail', [BookingKandangController::class, 'show'])->name('booking.cemorokandang.detail');
    Route::post('/admin/booking/cemorokandang{id}/decline', [BookingKandangController::class, 'decline'])->name('booking.cemorokandang.decline');
    Route::get('/admin/booking/cemorosewu', [BookingSewuController::class, 'index'])->name('admin.booking.cemorosewu.index');
    Route::post('/admin/booking/cemorosewu/{id}/approve', [BookingSewuController::class, 'approve'])->name('booking.cemorosewu.approve');
    Route::get('/admin/booking/cemorosewu/{id}/detail', [BookingSewuController::class, 'show'])->name('booking.cemorosewu.detail');
    Route::post('/admin/booking/cemorosewu/{id}/decline', [BookingSewuController::class, 'decline'])->name('booking.cemorosewu.decline');
    Route::get('/admin/booking/cetho', [BookingCethoController::class, 'index'])->name('admin.booking.cetho.index');
    Route::post('/admin/booking/cetho/{id}/approve', [BookingCethoController::class, 'approve'])->name('booking.cetho.approve');
    Route::get('/admin/booking/cetho/{id}/detail', [BookingCethoController::class, 'show'])->name('booking.cetho.detail');
    Route::post('/admin/booking/cetho/{id}/decline', [BookingCethoController::class, 'decline'])->name('booking.cetho.decline');
    Route::get('/kuota/cemorokandang', [CemorokandangKuotaController::class, 'index'])->name('admin.kuota.cemorokandang');
    Route::post('/kuota/cemorokandang', [CemorokandangKuotaController::class, 'store'])->name('kuota.cemorokandang.store');
    Route::post('/kuota/cemorokandang/update/{id}', [CemorokandangKuotaController::class, 'update'])->name('kuota.cemorokandang.update');
    Route::delete('/kuota/cemorokandang/{id}', [CemorokandangKuotaController::class, 'destroy'])->name('kuota.cemorokandang.destroy');
    Route::get('/kuota/cemorosewu', [CemorosewuKuotaController::class, 'index'])->name('admin.kuota.cemorosewu');
    Route::post('/kuota/cemorosewu/update/{id}', [CemorosewuKuotaController::class, 'update'])->name('kuota.cemorosewu.update');
    Route::delete('/kuota/cemorosewu/{id}', [CemorosewuKuotaController::class, 'destroy'])->name('kuota.cemorosewu.destroy');
    Route::post('/kuota/cemorosewu', [CemoroSewuKuotaController::class, 'store'])->name('kuota.cemorosewu.store');
    Route::get('/kuota/cetho', [CethoKuotaController::class, 'index'])->name('admin.kuota.cetho');
    Route::post('/kuota/cetho', [CethoKuotaController::class, 'store'])->name('kuota.cetho.store');
    Route::post('/kuota/cetho/update/{id}', [CethoKuotaController::class, 'update'])->name('kuota.cetho.update');
    Route::delete('/kuota/cetho/{id}', [CethoKuotaController::class, 'destroy'])->name('kuota.cetho.destroy');
    Route::get('/admin/booking/', function () {return view('admin.booking.booking');})->name('booking.index');

});

Route::middleware(['auth', RoleMiddleware::class . ':pendaki'])->group(function () {
    Route::get('/pendaki/pesona', [PendakiController::class, 'pesona'])->name('pendaki.pesona');
    Route::get('/pendaki/peralatantektok', [PendakiController::class, 'peralatanTektok'])->name('pendaki.peralatantektok');
    Route::get('/pendaki/peralatancamp', [PendakiController::class, 'peralatanCamp'])->name('pendaki.peralatancamp');
    Route::get('/pendaki/info', [PendakiController::class, 'info'])->name('pendaki.info');
    Route::get('/pendaki/berita', [PendakiController::class, 'berita'])->name('pendaki.berita');
    Route::get('/pendaki/persiapan', [PendakiController::class, 'persiapan'])->name('pendaki.persiapan');
    Route::get('/pendaki/cemorosewu', [PendakiController::class, 'cemoroSewu'])->name('pendaki.cemorosewu');
    Route::get('/pendaki/cemorokandang', [PendakiController::class, 'cemoroKandang'])->name('pendaki.cemorokandang');
    Route::get('/pendaki/cetho', [PendakiController::class, 'cetho'])->name('pendaki.cetho');
    Route::get('/pendaki/bookingcemorokandang', [BookingKandangController::class, 'form'])->name('booking.cemorokandang.form');
    Route::post('/pendaki/bookingcemorokandang', [BookingKandangController::class, 'simpan'])->name('booking.cemorokandang.simpan');
    Route::get('/cek-kuota-kandang', [BookingKandangController::class, 'cekKuota'])->name('cek.kuota.kandang');
    Route::get('/pendaki/bookingcemorosewu', [BookingSewuController::class, 'form'])->name('booking.cemorosewu.form');
    Route::post('/pendaki/bookingcemorosewu', [BookingSewuController::class, 'simpan'])->name('booking.cemorosewu.simpan');
    Route::get('/cek-kuota-sewu', [BookingSewuController::class, 'cekKuota'])->name('cek.kuota.sewu');
    Route::get('/pendaki/bookingcetho', [BookingCethoController::class, 'form'])->name('booking.cetho.form');
    Route::post('/pendaki/bookingcetho', [BookingCethoController::class, 'simpan'])->name('booking.cetho.simpan');
    Route::get('/cek-kuota-cetho', [BookingCethoController::class, 'cekKuota'])->name('cek.kuota.cetho');
    Route::get('/pendaki/book', function () {return view('pendaki.book');})->name('book.index');

});