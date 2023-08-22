@extends('layouts.main') @section('content')
@if(session('alert'))
<script>
    alert("{{ session('alert') }}");
</script>
@endif
<div class="card card-compact w-full">
    <div class="card-body">
        <div class="card-title justify-between items-center">
            <div>
                <span>Siswa</span>
                <a
                    href="{{ route('siswa.create') }}"
                    class="btn btn-primary btn-sm normal-case text-base-100"
                    >Tambah</a
                >
            </div>
            <div class="ml-auto join">
                <div>
                    <input
                        class="input input-bordered join-item"
                        placeholder="Search..."
                    />
                </div>
                <button class="btn join-item">Search</button>
            </div>
        </div>
    </div>
</div>

<div class="overflow-x-auto">
    <table class="table">
        <!-- head -->
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Tgl. Bergabung</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswas as $siswa)
            <tr>
                <th>
                    {{$loop->iteration}}
                </th>
                <td>
                    <div class="flex items-center space-x-3">
                        <div class="avatar placeholder">
                            <div
                                class="bg-neutral-focus text-neutral-content rounded-full w-12"
                            >
                                <span>{{substr($siswa->user->name, 0, 1)
                                }}</span>
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">{{$siswa->user->name}}</div>
                            <div class="text-sm opacity-50">
                                {{$siswa->user->email}}
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    {{$siswa->alamat}}
                    <br />
                    <span class="badge badge-ghost badge-sm"
                        >Telp. {{$siswa->telp}}</span
                    >
                </td>
                <td>
                    {{date('d/m/Y', strtotime($siswa->created_at))}}
                </td>
                <th>
                    <a
                        href="{{ route('siswa.edit', $siswa->user_id) }}"
                        class="btn btn-ghost btn-xs"
                        >details</a
                    >
                    @if(auth()->user()->profile->role == 'Admin' or auth()->user()->profile->role == 'Super Admin')
                    <a
                    onclick="return confirm('Hapus data siswa ini?')"
                        href="{{ route('siswa.hapus', $siswa->user_id) }}"
                        class="btn btn-ghost text-error btn-xs"
                        >hapus</a
                    >
                    @endif
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection @section('script') @endsection
