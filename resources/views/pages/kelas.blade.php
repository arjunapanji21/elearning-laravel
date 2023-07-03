@extends('layouts.main') @section('content')
<div class="card card-compact w-full">
    <div class="card-body">
        <div class="card-title justify-between items-center">
            <div>
                <span>Kelas</span>
                @if(auth()->user()->profile->role != 'Siswa')
                <a
                    href="{{ route('kelas.create') }}"
                    class="btn btn-primary btn-sm normal-case text-base-100"
                    >Tambah</a
                >
                @elseif(auth()->user()->profile->role == 'Siswa')
                <button
                    class="btn btn-sm btn-primary text-base-100"
                    onclick="modal_join_kelas.showModal()"
                >
                    Join Kelas
                </button>
                <dialog id="modal_join_kelas" class="modal">
                    <form method="dialog" class="modal-box">
                        <h3 class="font-bold text-lg">Input Kode Kelas</h3>
                        <input
                            type="text"
                            placeholder="Kode Kelas"
                            class="input input-bordered w-full my-4"
                        />
                        <div class="modal-action">
                            <!-- if there is a button in form, it will close the modal -->
                            <button
                                class="btn btn-sm btn-primary text-base-100"
                            >
                                Join
                            </button>
                            <button class="btn btn-sm">Batal</button>
                        </div>
                    </form>
                </dialog>
                @endif
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
                <th>Nama Kelas</th>
                <th>Jumlah Siswa</th>
                <th>Kode Kelas</th>
                <th>Tgl. Dibuat</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($kelas as $row)
            <tr>
                <th>
                    {{$loop->iteration}}
                </th>
                <td>{{$row->nama}}</td>
                <td>0</td>
                <td>
                    <span
                        class="badge font-bold normal-case"
                        >{{$row->kode}}</span
                    >
                </td>
                <td>{{date('d/m/Y', strtotime($row->created_at))}}</td>
                <td>
                    <a
                        href="{{ route('kelas.edit', $row->id) }}"
                        class="btn btn-ghost btn-xs"
                        >Lihat</a
                    >
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection @section('script') @endsection
