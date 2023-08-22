<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->profile->role == "Siswa") {
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Guru") {
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Super Admin" || auth()->user()->profile->role == "Admin") {
            $kelas_list = Kelas::all();
        }
        return view('pages.siswa', [
            'title' => 'Siswa',
            'siswas' => Profile::where('role', 'Siswa')->get(),
            'kelas_list' => $kelas_list
        ]);
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
        return view('pages.siswa-create', [
            'title' => 'Buat Siswa Baru',
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {
            $data['password'] = bcrypt($data['password']);
            $id = User::create($data)->id;
            Profile::create([
                'user_id' => $id,
                'role' => 'Siswa',
            ]);
            return redirect(route('siswa.index'))->with('alert', 'Berhasil membuat akun siswa.');
        } catch (\Throwable $th) {
            return back()->withErrors('alert', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id, User $user)
    {
        if (auth()->user()->profile->role == "Siswa") {
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Guru") {
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->get();
        } else if (auth()->user()->profile->role == "Super Admin" || auth()->user()->profile->role == "Admin") {
            $kelas_list = Kelas::all();
        }
        $user = User::with('profile')->find($id);
        return view('pages.siswa-update', [
            'title' => 'Profil siswa',
            'siswa' => $user,
            'kelas_list' => $kelas_list
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required',
            ]);
            $user = User::find($userId);
            $data = $request->all();
            if ($data['password'] == $data['password_confirmation'] && $data['password'] != null) {
                $data['password'] = bcrypt($data['password']);
            } else {
                $data['password'] = $user->password;
            }
            $user->update($data);
            return redirect(route('siswa.index'))->with('alert', 'Data Siswa Berhasil di Update!');
        } catch (\Throwable $th) {
            return back()->with(['alert', 'Gagal melakukan perubahan data! Periksa nama dan email.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function siswa_hapus($user_id)
    {
        $user = User::find($user_id);
        Profile::find($user->profile->id)->delete();
        $user->delete();
        return back()->with('alert', 'Berhasil menghapus data siswa.');
    }
}
