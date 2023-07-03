<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/register', [AuthController::class, 'register'])->name('user.register');
Route::get('/', [AuthController::class, 'login'])->name('user.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');
Route::get('/forgot', [AuthController::class, 'forgot_password'])->name('user.forgot');
Route::post('/forgot', [AuthController::class, 'reset_password'])->name('user.reset');
Route::post('/register', [AuthController::class, 'store'])->name('user.store');
Route::post('/auth', [AuthController::class, 'auth'])->name('user.auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::resource('/admin', AdminController::class);
    Route::resource('/guru', GuruController::class);
    Route::resource('/siswa', SiswaController::class);
    Route::resource('/kelas', KelasController::class);
    Route::post('/kelas/join', [KelasController::class, 'join'])->name('kelas.join');
    Route::get('/materi', [PageController::class, 'materi'])->name('materi');
    Route::get('/tugas', [PageController::class, 'tugas'])->name('tugas');
    Route::get('/kuis', [PageController::class, 'kuis'])->name('kuis');
});
