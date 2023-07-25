@extends('layouts.main') @section('content') @if(session('alert'))
<script>
    alert("{{ session('alert') }}");
</script>
@endif
<div class="card card-compact w-full">
    <div class="card-body">
        <div class="card-title">
            Kelas {{$kelas->nama}}
            <span
                class="badge badge-sm badge-primary font-bold text-base-100"
                >{{$kelas->kode}}</span
            >
        </div>
        <div class="grid grid-cols-4">
            <a
                href="{{ route('kelas.detail', [$kelas->id, $kelas->kode]) }}"
                class="p-4 btn rounded-none normal-case font-bold"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-house-door-fill"
                    viewBox="0 0 16 16"
                >
                    <path
                        d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"
                    />
                </svg>
            </a>
            <a
                href="{{ route('kelas.materi.detail', [$kelas->id, $kelas->kode]) }}"
                class="p-4 btn rounded-none normal-case font-bold"
                >Materi</a
            >
            <a
                href="{{ route('kelas.tugas', [$kelas->id, $kelas->kode]) }}"
                class="p-4 btn rounded-none normal-case font-bold"
                >Tugas</a
            >
            <a
                href="{{ route('kelas.anggota', [$kelas->id, $kelas->kode]) }}"
                class="p-4 btn rounded-none normal-case font-bold"
            >
                Anggota
            </a>
        </div>
        <div class="card bordered shadow">
            <div class="card-body">
                <div class="card-title justify-center items-center">{{$ujian->judul}}</div>
                <div class="flex flex-col justify-center items-center gap-3">
                    <p>Deskripsi: {{$ujian->deskripsi}}</p>
                    <p>Tgl. Mulai: {{date('d M Y', strtotime($ujian->created_at))}}</p>
                    <p>Tgl. Berakhir: {{date('d M Y', strtotime($ujian->deadline))}}</p>
                    <p>Waktu: 120 Menit</p>
                </div>
                @if(auth()->user()->profile->role != 'Siswa')
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama Siswa</th>
                                <th class="text-right">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ujian->siswa as $row)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <td>{{$row->profile->user->name}}</td>
                                <td class="text-right">{{$row->nilai}}/100</td>
                                {{-- <td class="text-center">
                                    @if($row->file != '')
                                    <a
                                        href="{{asset('data/tugas/siswa/'.$row->file)}}"
                                        class="btn btn-success btn-xs"
                                        target="_blank"
                                        >Lihat</a
                                    >
                                    <label
                                        for="modal-nilai"
                                        class="btn btn-xs btn-info"
                                        >Nilai</label
                                    >
                                    <input
                                        type="checkbox"
                                        id="modal-nilai"
                                        class="modal-toggle"
                                    />
                                    <div class="modal">
                                        <div class="modal-box">
                                            <h3 class="font-bold text-lg">
                                                Nilai Tugas
                                                {{$row->profile->user->name}}
                                            </h3>
                                            <form
                                                action="{{route('kelas.tugas.submit.nilai', [$kelas->id, $kelas->kode, $tugas->id, $row->id])}}"
                                                method="post"
                                            >
                                                @csrf
                                                <input
                                                    name="nilai"
                                                    type="text"
                                                    placeholder="Nilai Tugas"
                                                    class="input input-bordered text-center w-full mt-2"
                                                    value="{{$row->nilai}}"
                                                />
                                                <div class="modal-action">
                                                    <button
                                                        type="submit"
                                                        class="btn btn-primary"
                                                    >
                                                        Simpan
                                                    </button>
                                                    <label
                                                        for="modal-nilai"
                                                        class="btn"
                                                        >Tutup</label
                                                    >
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @else
                                    <span class="badge badge-sm badge-error"
                                        >Belum Ada</span
                                    >
                                    @endif
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                <div class="card-actions justify-center">
                    @if(auth()->user()->profile->role == 'Siswa')
                    @if($ujian_siswa->open == 0)
                    <a href="{{route('kelas.ujian.mulai', [$kelas->id, $kelas->kode, $ujian->id])}}" class="btn btn-primary btn-block">Mulai</a>
                    @else
                    <p class="text-center font-bold">Nilai: {{$ujian_siswa->nilai}}/100</p>
                    {{-- <a href="{{route('kelas.ujian.mulai', [$kelas->id, $kelas->kode, $ujian->id])}}" class="btn btn-primary btn-block">Lihat</a> --}}
                    @endif
                    @endif
                    <a onclick="return window.history.back()" class="btn btn-ghost btn-block">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('script')
@endsection
