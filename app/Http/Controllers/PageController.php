<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {
        $user = User::with('profile')->find(auth()->user()->id);
        return view('pages.dashboard', [
            'title' => 'Dashboard | ' . $user->profile->role,
            'user' => $user,
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
