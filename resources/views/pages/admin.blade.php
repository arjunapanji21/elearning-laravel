@extends('layouts.main') @section('content')
<div class="card card-compact w-full">
    <div class="card-body">
        <div class="card-title justify-between items-center">
            <div>
                <span>Admin</span>
                <a
                    href="{{ route('admin.create') }}"
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
            @foreach($admins as $admin)
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
                                <span>{{substr($admin->user->name, 0, 1)
                                }}</span>
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">{{$admin->user->name}}</div>
                            <div class="text-sm opacity-50">
                                {{$admin->user->email}}
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    {{$admin->alamat}}
                    <br />
                    <span class="badge badge-ghost badge-sm"
                        >Telp. {{$admin->telp}}</span
                    >
                </td>
                <td>
                    {{date('d/m/Y', strtotime($admin->created_at))}}
                </td>
                <th>
                    <a
                        href="{{ route('admin.edit', $admin->user_id) }}"
                        class="btn btn-ghost btn-xs"
                        >details</a
                    >
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection @section('script') @endsection
