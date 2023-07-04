<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/fa/all.min.css') }}" rel="stylesheet" />
        <link
            rel="icon"
            type="image/x-icon"
            href="{{ asset('img/logo.png') }}"
        />

        <title>{{ $title }}</title>
    </head>
    <body>
        <div class="drawer">
            <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col">
                <!-- Navbar -->
                <div class="w-full navbar bg-primary text-base-100">
                    <div class="flex-none lg:hidden">
                        <label
                            for="my-drawer-3"
                            class="btn btn-square btn-ghost"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                class="inline-block w-6 h-6 stroke-current"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                ></path>
                            </svg>
                        </label>
                    </div>
                    <div class="flex-1 px-2 mx-2">
                        <div class="flex gap-2 items-center">
                            <img
                                src="{{ asset('img/logo.png') }}"
                                alt="logo.png"
                                width="52"
                            />
                            <span class="text-lg font-bold hidden lg:flex"
                                >E-Learning SMKN 4 Kota Jambi</span
                            >
                        </div>
                        <!-- <div class="join mx-auto">
                            <input
                                class="input input-bordered w-full lg:w-[400px] join-item text-base-content"
                                placeholder="Search"
                            />
                            <button class="btn join-item rounded-r-full">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-search w-6 h-6"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"
                                    />
                                </svg>
                            </button>
                        </div> -->
                    </div>
                    <div class="flex-none">
                        <div class="dropdown dropdown-end">
                            <label
                                tabindex="0"
                                class="btn btn-sm m-1 btn-ghost normal-case"
                            >
                                {{auth()->user()->name}}
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-caret-down-fill"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"
                                    />
                                </svg>
                            </label>
                            <ul
                                tabindex="0"
                                class="dropdown-content z-[1] menu p-2 shadow bg-primary rounded-box w-52"
                            >
                                <li><a>Profile</a></li>
                                <li>
                                    <a href="{{ route('user.logout') }}"
                                        >Keluar</a
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div
                        class="w-1/5 min-h-screen bg-base-200 hidden lg:flex lg:flex-col"
                    >
                        <div class="p-4">
                            <div class="flex gap-3 items-center">
                                <div class="avatar online placeholder">
                                    <div
                                        class="bg-neutral-focus text-neutral-content rounded-full w-12"
                                    >
                                        <span
                                            class="text-xl"
                                            >{{substr(auth()->user()->name, 0, 1)}}</span
                                        >
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold text-primary">
                                        {{auth()->user()->name}}
                                    </div>
                                    <div class="text-sm opacity-50">
                                        {{ auth()->user()->profile->role }}
                                    </div>
                                </div>
                            </div>
                            <ul class="menu bg-base-300 my-5 rounded-box">
                                <li>
                                    <h2 class="menu-title">Halaman</h2>
                                    <ul class="font-bold opacity-70">
                                        <li>
                                            <a href="{{ route('dashboard') }}">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-house-fill"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"
                                                    />
                                                    <path
                                                        d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"
                                                    />
                                                </svg>
                                                Dashboard</a
                                            >
                                        </li>
                                        @if(auth()->user()->profile->role ==
                                        "Super Admin" or
                                        auth()->user()->profile->role ==
                                        "Admin")
                                        <li>
                                            <a
                                                href="{{
                                                    route('admin.index')
                                                }}"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-people-fill"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"
                                                    />
                                                </svg>
                                                Admin</a
                                            >
                                        </li>
                                        <li>
                                            <a href="{{ route('guru.index') }}">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-people-fill"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"
                                                    />
                                                </svg>
                                                Guru</a
                                            >
                                        </li>
                                        <li>
                                            <a
                                                href="{{
                                                    route('siswa.index')
                                                }}"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-people-fill"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"
                                                    />
                                                </svg>
                                                Siswa</a
                                            >
                                        </li>
                                        @endif
                                        <li>
                                            <a
                                                href="{{
                                                    route('kelas.index')
                                                }}"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-bookmarks-fill"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4z"
                                                    />
                                                    <path
                                                        d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1H4.268z"
                                                    />
                                                </svg>
                                                Kelas</a
                                            >
                                        </li>
                                        <li>
                                            <a href="{{ route('materi') }}">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-bookmarks-fill"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4z"
                                                    />
                                                    <path
                                                        d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1H4.268z"
                                                    />
                                                </svg>
                                                Materi</a
                                            >
                                        </li>
                                        <li>
                                            <a href="{{ route('tugas') }}">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-bookmarks-fill"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4z"
                                                    />
                                                    <path
                                                        d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1H4.268z"
                                                    />
                                                </svg>
                                                Tugas</a
                                            >
                                        </li>
                                        <li>
                                            <a href="{{ route('kuis') }}">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-bookmarks-fill"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4z"
                                                    />
                                                    <path
                                                        d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1H4.268z"
                                                    />
                                                </svg>
                                                Kuis</a
                                            >
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div
                        class="w-full lg:w-3/5 min-h-screen bg-base-100 overflow-y-auto"
                    >
                        <div class="p-4">
                            <!-- Page content here -->
                            @yield('content')
                        </div>
                    </div>
                    <div
                        class="w-1/5 min-h-screen bg-base-200 hidden lg:flex lg:flex-col"
                    >
                        <div class="p-4">
                            <ul class="menu bg-base-200 w-56 rounded-box">
                                <li>
                                    <h2 class="menu-title">Kelas Anda</h2>
                                    <ul class="font-bold opacity-70">
                                        <li><a>Kelas A</a></li>
                                        <li><a>Kelas B</a></li>
                                        <li><a>Kelas C</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="drawer-side">
                <label for="my-drawer-3" class="drawer-overlay"></label>
                <ul
                    class="menu p-4 w-80 h-full bg-primary text-base-100 text-xl"
                >
                    <!-- Sidebar content here -->
                    <li class="border-b border-b-primary-focus">
                        <a href="{{ route('dashboard') }}">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-house-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"
                                />
                                <path
                                    d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"
                                />
                            </svg>
                            Dashboard</a
                        >
                    </li>
                    <li class="border-b border-b-primary-focus">
                        <a href="{{ route('admin.index') }}">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-people-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"
                                />
                            </svg>
                            Admin</a
                        >
                    </li>
                    <li class="border-b border-b-primary-focus">
                        <a href="{{ route('guru.index') }}">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-people-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"
                                />
                            </svg>
                            Guru</a
                        >
                    </li>
                    <li class="border-b border-b-primary-focus">
                        <a href="{{ route('siswa.index') }}">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-people-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"
                                />
                            </svg>
                            Siswa</a
                        >
                    </li>
                    <li class="border-b border-b-primary-focus">
                        <a href="{{ route('kelas.index') }}">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-bookmarks-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4z"
                                />
                                <path
                                    d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1H4.268z"
                                />
                            </svg>
                            Kelas</a
                        >
                    </li>
                    <li class="border-b border-b-primary-focus">
                        <a href="{{ route('materi') }}">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-bookmarks-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4z"
                                />
                                <path
                                    d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1H4.268z"
                                />
                            </svg>
                            Materi</a
                        >
                    </li>
                    <li class="border-b border-b-primary-focus">
                        <a href="{{ route('tugas') }}">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-bookmarks-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4z"
                                />
                                <path
                                    d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1H4.268z"
                                />
                            </svg>
                            Tugas</a
                        >
                    </li>
                    <li class="border-b border-b-primary-focus">
                        <a href="{{ route('kuis') }}">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-bookmarks-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4z"
                                />
                                <path
                                    d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1H4.268z"
                                />
                            </svg>
                            Kuis</a
                        >
                    </li>
                </ul>
            </div>
        </div>
        {{-- @yield('content') --}}
    </body>
    <script src="{{ asset('js/fa/all.min.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/chartjs/chart.min.js') }}"></script>
    @yield('script')
</html>
