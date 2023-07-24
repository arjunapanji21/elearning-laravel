<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Materi;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class GuruController extends Controller
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
        return view('pages.guru', [
            'title' => 'Guru',
            'gurus' => Profile::where('role', 'Guru')->get(),
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
        return view('pages.guru-create', [
            'title' => 'Buat Guru Baru',
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
                'role' => 'Guru',
            ]);
            return redirect(route('guru.index'));
        } catch (\Throwable $th) {
            dd($th);
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
        return view('pages.guru-update', [
            'title' => 'Profil Guru',
            'guru' => $user,
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
            return redirect(route('guru.index'))->with('alert', 'Data Guru Berhasil di Update!');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'Gagal melakukan perubahan data! Periksa nama dan email.']);
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

    public function guru_hapus($user_id)
    {
        $user = User::find($user_id);
        foreach (Post::where('profile_id', $user->profile->id)->get() as $row) {
            foreach (PostComment::where('post_id', $row->id)->get() as $row2) {
                $row2->delete();
            }
            $row->delete();
        }
        foreach (Materi::where('profile_id', $user->profile->id)->get() as $row) {
            $row->delete();
        }
        foreach (Kelas::where('profile_id', $user->profile->id)->get() as $row) {
            foreach (KelasSiswa::where('kelas_id', $row->id)->get() as $row2) {
                $row2->delete();
            }
            $row->delete();
        }
        Profile::find($user->profile->id)->delete();
        $user->delete();
        return back()->with('alert', 'Berhasil menghapus data guru.');
    }
}
