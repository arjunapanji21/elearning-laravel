<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Materi;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\Tugas;
use App\Models\TugasSiswa;
use App\Models\Ujian;
use App\Models\UjianSiswa;
use App\Models\UjianSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class KelasController extends Controller
{
    public function kelas_ujian($id, $kode)
    {
        if (auth()->user()->profile->role == "Siswa") {
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Guru") {
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Super Admin" || auth()->user()->profile->role == "Admin") {
            $kelas_list = Kelas::all();
        }
        return view('pages.kelas-ujian', [
            'title' => 'Ujian',
            'kelas' => Kelas::with(['guru', 'siswa'])->where('id', $id)->where('kode', $kode)->get()->first(),
            'kelas_list' => $kelas_list,
            'ujian' => Ujian::with(['soal', 'siswa'])->where('kelas_id', $id)->get(),
        ]);
    }
    public function kelas_ujian_create($id, $kode)
    {
        if (auth()->user()->profile->role == "Siswa") {
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Guru") {
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Super Admin" || auth()->user()->profile->role == "Admin") {
            $kelas_list = Kelas::all();
        }
        return view('pages.kelas-ujian-create', [
            'title' => 'Buat Soal Ujian',
            'kelas' => Kelas::with(['guru', 'siswa'])->where('id', $id)->where('kode', $kode)->get()->first(),
            'kelas_list' => $kelas_list,
            'ujian' => Ujian::with(['siswa', 'soal'])->where('kelas_id', $id)->get(),
        ]);
    }
    public function kelas_ujian_detail($id, $kode, $ujian_id)
    {
        if (auth()->user()->profile->role == "Siswa") {
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Guru") {
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Super Admin" || auth()->user()->profile->role == "Admin") {
            $kelas_list = Kelas::all();
        }
        if (auth()->user()->profile->role == 'Siswa') {
            $ujian_siswa = UjianSiswa::where('ujian_id', $ujian_id)->where('profile_id', auth()->user()->profile->id)->get()->first();
            return view('pages.kelas-ujian-detail', [
                'title' => 'Mulai Ujian',
                'kelas' => Kelas::with(['guru', 'siswa'])->where('id', $id)->where('kode', $kode)->get()->first(),
                'kelas_list' => $kelas_list,
                'ujian' => Ujian::with(['siswa', 'soal'])->find($ujian_id),
                'ujian_siswa' => $ujian_siswa,
            ]);
        } else {
            return view('pages.kelas-ujian-detail', [
                'title' => 'Mulai Ujian',
                'kelas' => Kelas::with(['guru', 'siswa'])->where('id', $id)->where('kode', $kode)->get()->first(),
                'kelas_list' => $kelas_list,
                'ujian' => Ujian::with(['siswa', 'soal'])->find($ujian_id),
            ]);
        }
    }
    public function kelas_ujian_mulai($id, $kode, $ujian_id)
    {
        if (auth()->user()->profile->role == "Siswa") {
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Guru") {
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Super Admin" || auth()->user()->profile->role == "Admin") {
            $kelas_list = Kelas::all();
        }
        $ujianSiswa = UjianSiswa::where('ujian_id', $ujian_id)->where('profile_id', auth()->user()->profile->id)->get()->first();
        $ujianSiswa->update([
            'open' => 1,
        ]);
        if (auth()->user()->profile->role == 'Siswa') {
            $ujian_siswa = UjianSiswa::where('ujian_id', $ujian_id)->where('profile_id', auth()->user()->profile->id)->get()->first();
            return view('pages.kelas-ujian-mulai', [
                'title' => 'Mulai Ujian',
                'kelas' => Kelas::with(['guru', 'siswa'])->where('id', $id)->where('kode', $kode)->get()->first(),
                'kelas_list' => $kelas_list,
                'ujian' => Ujian::with(['siswa', 'soal'])->find($ujian_id),
                'ujian_siswa' => $ujian_siswa,
            ]);
        } else {
            return view('pages.kelas-ujian-mulai', [
                'title' => 'Mulai Ujian',
                'kelas' => Kelas::with(['guru', 'siswa'])->where('id', $id)->where('kode', $kode)->get()->first(),
                'kelas_list' => $kelas_list,
                'ujian' => Ujian::with(['siswa', 'soal'])->find($ujian_id),
            ]);
        }
    }

    public function kelas_ujian_submit($id, $kode, $ujian_id, Request $request)
    {
        $data = $request->all();
        $soal = Ujian::with('soal')->find($ujian_id)->soal;
        $nilai = 0;
        foreach ($soal as $key => $row) {
            if ($data['jawab'][$key] == $row->jawaban) {
                $nilai += 1;
            }
        }
        $nilai = (int)($nilai * 100 / count($soal));
        $ujianSiswa = UjianSiswa::where('ujian_id', $ujian_id)->where('profile_id', auth()->user()->profile->id)->get()->first();
        $ujianSiswa->update([
            'jawaban' => implode('#', $data['jawab']),
            'nilai' => $nilai,
        ]);
        return redirect(route('kelas.ujian', [$id, $kode]))->with('alert', 'Data Ujian Telah Disimpan.');
    }

    public function kelas_ujian_store($id, $kode, Request $request)
    {
        $data = $request->all();
        try {
            $ujian_id = Ujian::create([
                'judul' => $data['judul'],
                'deskripsi' => $data['deskripsi'],
                'profile_id' => auth()->user()->profile->id,
                'kelas_id' => $id,
                'deadline' => $data['deadline'],
            ])->id;
            foreach ($data['soal'] as $key => $row) {
                // if ($data['jawaban'][$key] == 'A') {
                //     $jawaban = $data['opsi_a'][$key];
                // } else if ($data['jawaban'][$key] == 'B') {
                //     $jawaban = $data['opsi_b'][$key];
                // } else if ($data['jawaban'][$key] == 'C') {
                //     $jawaban = $data['opsi_c'][$key];
                // } else if ($data['jawaban'][$key] == 'D') {
                //     $jawaban = $data['opsi_d'][$key];
                // }
                UjianSoal::create([
                    'ujian_id' => $ujian_id,
                    'soal' => $data['soal'][$key],
                    'opsi_a' => $data['opsi_a'][$key],
                    'opsi_b' => $data['opsi_b'][$key],
                    'opsi_c' => $data['opsi_c'][$key],
                    'opsi_d' => $data['opsi_d'][$key],
                    'jawaban' => $data['jawaban'][$key],
                ]);
            }
            foreach (KelasSiswa::all() as $row) {
                UjianSiswa::create([
                    'ujian_id' => $ujian_id,
                    'profile_id' => $row->profile_id,
                ]);
            }
            Post::create([
                'text' => 'Membuat soal ujian <a class="font-bold text-primary hover:text-primary-focus" href="' . str_replace('store', '', $_SERVER['REQUEST_URI']) . '">' . $data['judul'] . '</a>',
                'kelas_id' => $id,
                'profile_id' => auth()->user()->profile->id,
            ]);
            return redirect(route('kelas.ujian', [$id, $kode]))->with('alert', 'Berhasil membuat ujian baru.');
        } catch (\Throwable $th) {
            return back()->with('alert', 'Gagal membuat ujian baru.');
        }
    }
    public function kelas_ujian_delete($id, $kode, $ujian_id)
    {
        $ujian = Ujian::find($ujian_id);
        foreach (UjianSoal::where('ujian_id', $ujian_id) as $row) {
            $row->delete();
        }
        foreach (UjianSiswa::where('ujian_id', $ujian_id) as $row) {
            $row->delete();
        }
        $post = Post::where('text', 'like', '%' . $ujian->judul . '%')->first();
        try {
            $post->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
        return back()->with('alert', 'Ujian Berhasil Dihapus.');
    }
    public function kelas_tugas($id, $kode)
    {
        if (auth()->user()->profile->role == "Siswa") {
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Guru") {
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Super Admin" || auth()->user()->profile->role == "Admin") {
            $kelas_list = Kelas::all();
        }
        return view('pages.kelas-tugas', [
            'title' => 'Tugas',
            'kelas' => Kelas::with(['guru', 'siswa'])->where('id', $id)->where('kode', $kode)->get()->first(),
            'kelas_list' => $kelas_list,
            'tugas' => Tugas::with(['profile', 'kelas', 'siswa'])->where('kelas_id', $id)->get(),
        ]);
    }

    public function kelas_tugas_new($id, $kode, Request $request)
    {
        $data = $request->all();
        try {
            $data['profile_id'] = auth()->user()->profile->id;
            $data['kelas_id'] = $id;
            if ($request->hasFile('files')) {
                $files = $request->file('files');
                $filename = date('YmdHi') . $files[0]->getClientOriginalName();
                $files[0]->move(public_path('data/tugas/files'), $filename);
                $data['files'] = $filename;
            }
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $filename = date('YmdHi') . $images[0]->getClientOriginalName();
                $images[0]->move(public_path('data/tugas/images'), $filename);
                $data['images'] = $filename;
            }
            $tugas_id = Tugas::create($data)->id;
            foreach (KelasSiswa::where('kelas_id', $id)->get() as $row) {
                TugasSiswa::create([
                    'tugas_id' => $tugas_id,
                    'profile_id' => $row->profile_id,
                ]);
            }
            Post::create([
                'text' => 'Menambahkan tugas <a class="font-bold text-primary hover:text-primary-focus" href="' . str_replace('new', '', $_SERVER['REQUEST_URI']) . '">' . $data['judul'] . '</a>',
                'kelas_id' => $id,
                'profile_id' => $data['profile_id'],
            ]);
            return back()->with('alert', 'Berhasil membuat tugas baru.');
        } catch (\Throwable $th) {
            return back()->with('alert', 'Gagal membuat tugas baru.');
        }
    }

    public function kelas_tugas_detail($id, $kode, $tugas_id)
    {
        if (auth()->user()->profile->role == "Siswa") {
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Guru") {
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Super Admin" || auth()->user()->profile->role == "Admin") {
            $kelas_list = Kelas::all();
        }
        if (auth()->user()->profile->role == 'Guru') {
            return view('pages.kelas-tugas-detail', [
                'title' => 'Materi',
                'kelas' => Kelas::with(['guru', 'siswa'])->where('id', $id)->where('kode', $kode)->get()->first(),
                'kelas_list' => $kelas_list,
                'tugas' => Tugas::with(['profile', 'kelas', 'siswa'])->where('id', $tugas_id)->get()->first(),
            ]);
        } elseif (auth()->user()->profile->role == 'Siswa') {
            return view('pages.kelas-tugas-detail', [
                'title' => 'Materi',
                'kelas' => Kelas::with(['guru', 'siswa'])->where('id', $id)->where('kode', $kode)->get()->first(),
                'kelas_list' => $kelas_list,
                'tugas' => Tugas::with(['profile', 'kelas', 'siswa'])->where('id', $tugas_id)->get()->first(),
                'tugas_siswa' => TugasSiswa::where('tugas_id', $tugas_id)->where('profile_id', auth()->user()->profile->id)->get()->first(),
            ]);
        }
    }

    public function kelas_tugas_submit($id, $kode, $tugas_id, Request $request)
    {
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $filename = date('YmdHi') . $files->getClientOriginalName();
            $files->move(public_path('data/tugas/siswa'), $filename);
        }
        $tugas = TugasSiswa::where('tugas_id', $tugas_id)->where('profile_id', auth()->user()->profile->id)->get()->first();
        $tugas->update([
            'file' => $filename
        ]);
        return back()->with('alert', 'Berhasil mengumpulkan tugas.');
    }

    public function kelas_tugas_submit_nilai($id, $kode, $tugas_id, $tugas_siswa_id, Request $request)
    {
        $data = $request->all();
        $tugas = TugasSiswa::find($tugas_siswa_id);
        $tugas->update([
            'nilai' => $data['nilai'],
        ]);
        return back()->with('alert', 'Berhasil mengupdate nilai tugas.');
    }

    public function kelas_tugas_delete($id, $kode, $tugas_id)
    {
        $tugas = Tugas::find($tugas_id);
        $post = Post::where('text', 'like', '%' . $tugas->judul . '%')->first();
        try {
            $post->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
        $tugas->delete();
        foreach (TugasSiswa::where('tugas_id', $tugas_id)->get() as $row) {
            $row->delete();
        }
        return back()->with('alert', 'Berhasil menghapus tugas.');
    }

    public function kelas_post(Request $request, $kelas_id, $kelas_kode)
    {
        $data = $request->all();
        $data['profile_id'] = auth()->user()->profile->id;
        $data['kelas_id'] = $kelas_id;
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $filename = date('YmdHi') . $files[0]->getClientOriginalName();
            $files[0]->move(public_path('data/post/files'), $filename);
            $data['files'] = $filename;
        }
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $filename = date('YmdHi') . $images[0]->getClientOriginalName();
            $images[0]->move(public_path('data/post/images'), $filename);
            $data['images'] = $filename;
        }
        Post::create($data);
        return back()->with('alert', 'Berhasil membuat postingan baru.');
    }

    public function kelas_post_hapus($post_id)
    {
        Post::find($post_id)->delete();
        return back()->with('alert', 'Berhasil menghapus postingan.');
    }

    public function kelas_comment(Request $request, $kelas_id, $kelas_kode, $post_id)
    {
        $data = $request->all();
        $data['profile_id'] = auth()->user()->profile->id;
        $data['post_id'] = $post_id;
        PostComment::create($data);
        return back()->with('alert', 'Berhasil mengirim komentar.');
    }

    public function kelas_comment_hapus($comment_id)
    {
        PostComment::find($comment_id)->delete();
        return back()->with('alert', 'Berhasil menghapus komentar.');
    }

    public function kelas_materi($id, $kode)
    {
        if (auth()->user()->profile->role == "Siswa") {
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Guru") {
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Super Admin" || auth()->user()->profile->role == "Admin") {
            $kelas_list = Kelas::all();
        }
        return view('pages.materi-detail', [
            'title' => 'Materi',
            'kelas' => Kelas::with(['guru', 'siswa'])->where('id', $id)->where('kode', $kode)->get()->first(),
            'kelas_list' => $kelas_list,
            'materi' => Materi::with(['profile', 'kelas'])->where('kelas_id', $id)->get(),
        ]);
    }

    public function kelas_materi_upload($id, $kode, Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
        }
        if ($request->hasFile('video')) {
            $file = $request->file('video');
        }
        $originalName = explode('.', $file->getClientOriginalName());
        $fileFormat = $originalName[count($originalName) - 1];
        $data['file'] = $data['judul'] . date(' [His].') . $fileFormat;
        $data['profile_id'] = auth()->user()->profile->id;
        $data['kelas_id'] = $id;
        $file->move(public_path('data/materi'), $data['file']);
        try {
            Materi::create($data);
            Post::create([
                'text' => 'Menambahkan materi <a class="font-bold text-primary hover:text-primary-focus" href="' . str_replace('upload', '', $_SERVER['REQUEST_URI']) . '">' . $data['judul'] . '</a>',
                'kelas_id' => $id,
                'profile_id' => $data['profile_id'],
            ]);
            return back()->with('alert', 'Berhasil mengupload materi.');
        } catch (\Throwable $th) {
            return back()->with('alert', 'Gagal mengupload materi.');
        }
    }

    public function kelas_materi_delete($id, $kode, $materi_id)
    {
        $materi = Materi::find($materi_id);
        $post = Post::where('text', 'like', '%' . $materi->judul . '%')->first();
        try {
            $post->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
        try {
            $materi->delete();
            return back()->with('alert', 'Berhasil menghapus materi.');
        } catch (\Throwable $th) {
            return back()->with('alert', 'Gagal menghapus materi.');
        }
    }

    public function kelas_detail($id, $kode)
    {
        if (auth()->user()->profile->role == "Siswa") {
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Guru") {
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Super Admin" || auth()->user()->profile->role == "Admin") {
            $kelas_list = Kelas::all();
        }
        return view('pages.kelas-detail', [
            'title' => 'Kelas',
            'kelas' => Kelas::with(['guru', 'siswa'])->where('id', $id)->where('kode', $kode)->get()->first(),
            'kelas_list' => $kelas_list,
            'posts' => Post::with(['comments', 'profile'])->where('kelas_id', $id)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function kelas_hapus($id, $kode)
    {
        Kelas::find($id)->delete();
        return back()->with('alert', 'Berhasil menghapus kelas.');
    }

    public function join(Request $request)
    {
        $kelas_id = Kelas::where('kode', $request['kode'])->get()->first()->id;
        $cek_duplikasi = KelasSiswa::where('kelas_id', $kelas_id)->where('profile_id', auth()->user()->profile->id)->get();
        if (count($cek_duplikasi) > 0) {
            return back()->with('error', 'Join Kelas Gagal! Anda sudah berada di kelas ini.');
        } else {
            KelasSiswa::create([
                'kelas_id' => $kelas_id,
                'profile_id' => auth()->user()->profile->id,
            ]);
            return back()->with('alert', 'Berhasil Join Kelas');
        }
    }

    public function kelas_anggota($id, $kode)
    {
        if (auth()->user()->profile->role == "Siswa") {
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Guru") {
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Super Admin" || auth()->user()->profile->role == "Admin") {
            $kelas_list = Kelas::all();
        }
        return view('pages.kelas-anggota', [
            'title' => 'Anggota',
            'kelas' => Kelas::with(['guru', 'siswa'])->where('id', $id)->where('kode', $kode)->get()->first(),
            'kelas_list' => $kelas_list,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->profile->role == 'Super Admin' || auth()->user()->profile->role == 'Admin') {
            $kelas_list = Kelas::all();
            $kelas = Kelas::all();
            return view('pages.kelas', [
                'title' => 'Kelas',
                'kelas' => $kelas,
                'kelas_list' => $kelas_list
            ]);
        } else if (auth()->user()->profile->role == 'Guru') {
            $kelas = Kelas::where('profile_id', auth()->user()->profile->id)->get();
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->get();
            return view('pages.kelas', [
                'title' => 'Kelas',
                'kelas' => $kelas,
                'kelas_list' => $kelas_list,
            ]);
        } else if (auth()->user()->profile->role == 'Siswa') {
            $kelas = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
            return view('pages.kelas', [
                'title' => 'Kelas',
                'kelas_list' => $kelas_list,
                'kelas' => $kelas,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->profile->role == "Siswa") {
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Guru") {
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Super Admin" || auth()->user()->profile->role == "Admin") {
            $kelas_list = Kelas::all();
        }
        return view('pages.kelas-create', [
            'title' => 'Buat Kelas Baru',
            'kelas_list' => $kelas_list
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
        ]);

        $length = 8; // Specify the desired length of the random string
        $characters = '1234567890abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        try {
            $data['profile_id'] = auth()->user()->profile->id;
            $data['kode'] = $randomString;
            Kelas::create($data);
            return redirect(route('kelas.index'))->with('alert', 'Berhasil membuat kelas baru.');
        } catch (\Throwable $th) {
            return back()->with('alert', 'Gagal membuat kelas.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        dd($kelas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        //
    }
}
