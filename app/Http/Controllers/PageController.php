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
    public function materi()
    {
        $user = User::with('profile')->find(auth()->user()->id);
        return view('pages.materi', [
            'title' => 'Materi',
            'user' => $user,
        ]);
    }
    public function tugas()
    {
        $user = User::with('profile')->find(auth()->user()->id);
        return view('pages.tugas', [
            'title' => 'Tugas',
            'user' => $user,
        ]);
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
