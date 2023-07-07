<?php

namespace App\Http\Controllers;

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
        return view('pages.siswa', [
            'title' => 'Siswa',
            'siswas' => Profile::where('role', 'Siswa')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.siswa-create', [
            'title' => 'Buat Siswa Baru',
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
            return redirect(route('siswa.index'));
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
        $user = User::with('profile')->find($id);
        return view('pages.siswa-update', [
            'title' => 'Profil siswa',
            'siswa' => $user,
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
            return redirect(route('siswa.index'))->with('success', 'Data Siswa Berhasil di Update!');
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
}
