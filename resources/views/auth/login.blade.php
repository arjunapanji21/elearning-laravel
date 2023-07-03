@extends('layouts.secondary') @section('content')
<div class="hero min-h-screen bg-base-200">
    <div class="hero-content flex-col">
        <div class="flex flex-col justify-center text-center">
            <img
                src="{{ asset('img/logo.png') }}"
                alt="logo.png"
                width="90"
                class="mx-auto"
            />
            <h1 class="text-2xl font-bold">E-Learning</h1>
            <h3 class="text-xl">SMK Negeri 4 Kota Jambi</h3>
        </div>
        <div class="card w-full shadow-2xl bg-base-100">
            <div class="card-body">
                <form action="{{ route('user.auth') }}" method="post">
                    @csrf
                    <div class="block">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Username</span>
                            </label>
                            <input
                                name="username"
                                type="text"
                                placeholder="username"
                                class="input input-bordered"
                            />
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Password</span>
                            </label>
                            <input
                                name="password"
                                type="password"
                                placeholder="password"
                                class="input input-bordered"
                            />
                        </div>
                    </div>
                    <div class="form-control my-4">
                        <button type="submit" class="btn btn-primary">
                            Masuk
                        </button>
                    </div>
                </form>

                <label class="label mx-auto">
                    <a
                        href="{{ route('user.forgot') }}"
                        class="label-text-alt link link-hover"
                        >Lupa password?</a
                    >
                </label>
            </div>
        </div>
    </div>
</div>
@endsection
