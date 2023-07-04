<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasSiswa;
use Illuminate\Http\Request;

class KelasController extends Controller
{
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
            return back()->with('success', 'Berhasil Join Kelas');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->profile->role != 'Siswa') {
            $kelas = Kelas::where('profile_id', auth()->user()->profile->id)->get();
            return view('pages.kelas', [
                'title' => 'Kelas',
                'kelas' => $kelas,
            ]);
        } else if (auth()->user()->profile->role == 'Siswa') {
            $kelas = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
            return view('pages.kelas', [
                'title' => 'Kelas',
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
        return view('pages.kelas-create', [
            'title' => 'Buat Kelas Baru',
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
            return redirect(route('kelas.index'));
        } catch (\Throwable $th) {
            dd($th);
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
        //
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
