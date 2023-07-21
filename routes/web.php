<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
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
    Route::get('/profile/{profile_id}/{nama}', [PageController::class, 'profile'])->name('profile');
    Route::post('/profile/{profile_id}/update', [PageController::class, 'profile_update'])->name('profile.update');
    Route::resource('/admin', AdminController::class);
    Route::resource('/guru', GuruController::class);
    Route::resource('/siswa', SiswaController::class);

    // Kelas
    Route::resource('/kelas', KelasController::class);
    Route::post('/kelas/join', [KelasController::class, 'join'])->name('kelas.join');
    Route::get('/kelas/{id}/{kode}', [KelasController::class, 'kelas_detail'])->name('kelas.detail');
    Route::post('/kelas/{id}/{kode}/post/store', [KelasController::class, 'kelas_post'])->name('kelas.post');
    Route::post('/kelas/{id}/{kode}/{post_id}/store', [KelasController::class, 'kelas_comment'])->name('kelas.post.comment');
    Route::get('/kelas/post/{post_id}/delete', [KelasController::class, 'kelas_post_hapus'])->name('kelas.post.hapus');
    Route::get('/kelas/post/{comment_id}/delete', [KelasController::class, 'kelas_comment_hapus'])->name('kelas.post.comment.hapus');

    // Materi
    Route::get('/kelas/{id}/{kode}/materi', [KelasController::class, 'kelas_materi'])->name('kelas.materi.detail');
    Route::post('/kelas/{id}/{kode}/materi/upload', [KelasController::class, 'kelas_materi_upload'])->name('kelas.materi.upload');
    Route::get('/kelas/{id}/{kode}/materi/{materi_id}/delete', [KelasController::class, 'kelas_materi_delete'])->name('kelas.materi.delete');

    // Tugas
    Route::get('/kelas/{id}/{kode}/tugas', [KelasController::class, 'kelas_materi'])->name('kelas.tugas.detail');

    // Kuis
    Route::get('/kelas/{id}/{kode}/kuis', [KelasController::class, 'kelas_materi'])->name('kelas.kuis.detail');

    // Anggota
    Route::get('/kelas/{id}/{kode}/anggota', [KelasController::class, 'kelas_anggota'])->name('kelas.anggota');


    Route::get('/materi', [PageController::class, 'materi'])->name('materi');
    Route::get('/tugas', [PageController::class, 'tugas'])->name('tugas');
    Route::get('/kuis', [PageController::class, 'kuis'])->name('kuis');
});
