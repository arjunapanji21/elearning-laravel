@extends('layouts.main') @section('content')
<div class="card card-compact w-full">
    <form action="{{ route('admin.store') }}" method="post">
        @csrf
        <div class="card-body">
            <div class="card-title">
                <span>Buat Admin Baru</span>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Nama</span>
                </label>
                <input
                    name="name"
                    type="text"
                    placeholder="Nama"
                    class="input input-bordered w-full"
                />
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input
                    name="email"
                    type="email"
                    placeholder="Email"
                    class="input input-bordered w-full"
                />
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Username</span>
                </label>
                <input
                    name="username"
                    type="text"
                    placeholder="Username"
                    class="input input-bordered w-full"
                />
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Password</span>
                </label>
                <input
                    name="password"
                    type="password"
                    placeholder="Password"
                    class="input input-bordered w-full"
                />
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Ulangi Password</span>
                </label>
                <input
                    name="password_confirmation"
                    type="password"
                    placeholder="Type here"
                    class="input input-bordered w-full"
                />
            </div>
            <div class="my-4 card-actions justify-end">
                <button type="submit" class="btn btn-primary text-base-100">
                    Simpan
                </button>
                <a href="{{ route('admin.index') }}" class="btn btn-ghost"
                    >Batal</a
                >
            </div>
        </div>
    </form>
</div>
@endsection @section('script') @endsection
