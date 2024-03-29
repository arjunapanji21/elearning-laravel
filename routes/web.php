<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');
Route::get('/forgot', [AuthController::class, 'forgot_password'])->name('user.forgot');
Route::post('/forgot', [AuthController::class, 'reset_password'])->name('user.reset');
Route::post('/auth', [AuthController::class, 'auth'])->name('user.auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/{profile_id}/{nama}', [PageController::class, 'profile'])->name('profile');
    Route::post('/profile/{profile_id}/update', [PageController::class, 'profile_update'])->name('profile.update');
    Route::resource('/admin', AdminController::class);
    Route::get('/admin/{user_id}/hapus', [AdminController::class, 'admin_hapus'])->name('admin.hapus');
    Route::resource('/guru', GuruController::class);
    Route::get('/guru/{id}/delete', [GuruController::class, 'guru_hapus'])->name('guru.hapus');
    Route::resource('/siswa', SiswaController::class);
    Route::get('/siswa/{id}/delete', [SiswaController::class, 'siswa_hapus'])->name('siswa.hapus');

    // Kelas
    Route::resource('/kelas', KelasController::class);
    Route::post('/kelas/join', [KelasController::class, 'join'])->name('kelas.join');
    Route::get('/kelas/{id}/{kode}', [KelasController::class, 'kelas_detail'])->name('kelas.detail');
    Route::get('/kelas/{id}/{kode}/delete', [KelasController::class, 'kelas_hapus'])->name('kelas.hapus');
    Route::post('/kelas/{id}/{kode}/post/store', [KelasController::class, 'kelas_post'])->name('kelas.post');
    Route::post('/kelas/{id}/{kode}/{post_id}/store', [KelasController::class, 'kelas_comment'])->name('kelas.post.comment');
    Route::get('/kelas/post/{post_id}/delete', [KelasController::class, 'kelas_post_hapus'])->name('kelas.post.hapus');
    Route::get('/kelas/post/{comment_id}/delete', [KelasController::class, 'kelas_comment_hapus'])->name('kelas.post.comment.hapus');

    // Materi
    Route::get('/kelas/{id}/{kode}/materi', [KelasController::class, 'kelas_materi'])->name('kelas.materi.detail');
    Route::post('/kelas/{id}/{kode}/materi/upload', [KelasController::class, 'kelas_materi_upload'])->name('kelas.materi.upload');
    Route::get('/kelas/{id}/{kode}/materi/{materi_id}/delete', [KelasController::class, 'kelas_materi_delete'])->name('kelas.materi.delete');

    // Tugas
    Route::get('/kelas/{id}/{kode}/tugas', [KelasController::class, 'kelas_tugas'])->name('kelas.tugas');
    Route::get('/kelas/{id}/{kode}/tugas/{tugas_id}', [KelasController::class, 'kelas_tugas_detail'])->name('kelas.tugas.detail');
    Route::get('/kelas/{id}/{kode}/tugas/{tugas_id}/delete', [KelasController::class, 'kelas_tugas_delete'])->name('kelas.tugas.delete');
    Route::post('/kelas/{id}/{kode}/tugas/new', [KelasController::class, 'kelas_tugas_new'])->name('kelas.tugas.new');
    Route::post('/kelas/{id}/{kode}/tugas/{tugas_id}/submit', [KelasController::class, 'kelas_tugas_submit'])->name('kelas.tugas.submit');
    Route::post('/kelas/{id}/{kode}/tugas/{tugas_id}/{tugas_siswa_id}/', [KelasController::class, 'kelas_tugas_submit_nilai'])->name('kelas.tugas.submit.nilai');

    // Ujian
    Route::get('/kelas/{id}/{kode}/ujian', [KelasController::class, 'kelas_ujian'])->name('kelas.ujian');
    Route::get('/kelas/{id}/{kode}/ujian/create', [KelasController::class, 'kelas_ujian_create'])->name('kelas.ujian.create');
    Route::get('/kelas/{id}/{kode}/ujian/{ujian_id}', [KelasController::class, 'kelas_ujian_detail'])->name('kelas.ujian.detail');
    Route::get('/kelas/{id}/{kode}/ujian/{ujian_id}/start', [KelasController::class, 'kelas_ujian_mulai'])->name('kelas.ujian.mulai');
    Route::get('/kelas/{id}/{kode}/ujian/{ujian_id}/{ujian_siswa_id}', [KelasController::class, 'kelas_ujian_siswa'])->name('kelas.ujian.siswa');
    Route::post('/kelas/{id}/{kode}/ujian/{ujian_id}/submit', [KelasController::class, 'kelas_ujian_submit'])->name('kelas.ujian.submit');
    Route::get('/kelas/{id}/{kode}/ujian/{ujian_id}/delete', [KelasController::class, 'kelas_ujian_delete'])->name('kelas.ujian.delete');
    Route::post('/kelas/{id}/{kode}/ujian/create/store', [KelasController::class, 'kelas_ujian_store'])->name('kelas.ujian.store');

    // Anggota
    Route::get('/kelas/{id}/{kode}/anggota', [KelasController::class, 'kelas_anggota'])->name('kelas.anggota');

    Route::get('/materi', [PageController::class, 'materi'])->name('materi');
    Route::get('/tugas', [PageController::class, 'tugas'])->name('tugas');
    Route::get('/kuis', [PageController::class, 'kuis'])->name('kuis');
});
