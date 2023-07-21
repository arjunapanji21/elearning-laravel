<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {
        $posts = [];
        if (auth()->user()->profile->role == "Siswa") {
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->orderBy('created_at', 'desc')->get();
            foreach ($kelas_list as $row) {
                foreach (Post::with(['comments', 'profile'])->where('kelas_id', $row->kelas_id)->orderBy('created_at', 'desc')->get() as $p) {
                    array_push($posts, $p);
                }
            }
        } else if (auth()->user()->profile->role == "Guru") {
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->orderBy('created_at', 'desc')->get();
            foreach ($kelas_list as $row) {
                foreach (Post::with(['comments', 'profile'])->where('profile_id', $row->profile_id)->orderBy('created_at', 'desc')->get() as $p) {
                    array_push($posts, $p);
                }
            }
        } else if (auth()->user()->profile->role == "Super Admin" || auth()->user()->profile->role == "Admin") {
            $kelas_list = Kelas::all();
            foreach ($kelas_list as $row) {
                foreach (Post::with(['comments', 'profile'])->where('profile_id', $row->profile_id)->orderBy('created_at', 'desc')->get() as $p) {
                    array_push($posts, $p);
                }
            }
        }
        return view('pages.dashboard', [
            'title' => 'Dashboard | ' . auth()->user()->profile->role,
            'kelas_list' => $kelas_list,
            'posts' => $posts,
        ]);
    }
    public function profile($profile_id, $nama)
    {
        if (auth()->user()->profile->role == "Siswa") {
            $kelas_list = KelasSiswa::where('profile_id', auth()->user()->profile->id)->orderBy('created_at', 'desc')->get();
        } else if (auth()->user()->profile->role == "Guru") {
            $kelas_list = Kelas::where('profile_id', auth()->user()->profile->id)->orderBy('created_at', 'desc')->get();
        } else if (auth()->user()->profile->role == "Super Admin" || auth()->user()->profile->role == "Admin") {
            $kelas_list = Kelas::all();
        }
        return view('pages.profile', [
            'title' => 'Profile',
            'kelas_list' => $kelas_list,
            'profile' => Profile::find($profile_id),
        ]);
    }

    public function profile_update($profile_id, Request $request)
    {
        $data = $request->all();
        try {
            if ($data['password'] != '') {
                if ($data['password'] == $data['password_confirmation']) {
                    $data['password'] = bcrypt($data['password']);
                }
                User::find(auth()->user()->id)->update([
                    'name' => $data['nama'],
                    'email' => $data['email'],
                    'username' => $data['username'],
                    'password' => $data['password'],
                ]);
            } else {
                User::find(auth()->user()->id)->update([
                    'name' => $data['nama'],
                    'email' => $data['email'],
                    'username' => $data['username'],
                ]);
            }
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('data/profile'), $filename);
                $data['foto'] = $filename;
            } else {
                $data['foto'] = auth()->user()->profile->foto;
            }
            Profile::find(auth()->user()->profile->id)->update([
                'tgl_lahir' => $data['tgl_lahir'],
                'alamat' => $data['alamat'],
                'telp' => $data['telp'],
                'foto' => $data['foto'],
            ]);
            return back()->with('alert', 'Berhasil mengupdate profile.');
        } catch (\Throwable $th) {
            return back()->with('alert', 'Gagal mengupdate profile.');
        }
    }

    public function kuis()
    {
        $user = User::with('profile')->find(auth()->user()->id);
        return view('pages.kuis', [
            'title' => 'Kuis',
            'user' => $user,
        ]);
    }
}
