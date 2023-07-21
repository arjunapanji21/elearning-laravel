@extends('layouts.main') @section('content') @if(session('alert'))
<script>
    alert("{{ session('alert') }}");
</script>
@endif
<div class="card card-compact w-full">
    <div class="card-body">
        <div class="card-title">
            Anggota {{$kelas->nama}}
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
                href="{{ route('kelas.tugas.detail', [$kelas->id, $kelas->kode]) }}"
                class="p-4 btn rounded-none normal-case font-bold"
                >Tugas</a
            >
            <a
                href="{{ route('kelas.kuis.detail', [$kelas->id, $kelas->kode]) }}"
                class="p-4 btn rounded-none normal-case font-bold"
                >Kuis</a
            >
        </div>
    </div>
</div>
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
    <a
        href="{{route('profile', [$kelas->guru->id, $kelas->guru->user->name])}}"
    >
        <div class="card hover:bg-base-200 text-center bg-base-100 shadow">
            <div class="card-body">
                @if($kelas->guru->foto == '')
                <div class="avatar mx-auto placeholder">
                    <div
                        class="bg-primary text-primary-content rounded-full w-24"
                    >
                        <span
                            class="text-3xl"
                            >{{$kelas->guru->user->name[0]}}</span
                        >
                    </div>
                </div>
                @else
                <div class="avatar mx-auto">
                    <div
                        class="w-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2"
                    >
                        <img
                            src="{{asset('data/profile/'.$kelas->guru->foto)}}"
                        />
                    </div>
                </div>
                @endif
                <div class="card-title justify-center">
                    {{$kelas->guru->user->name}}
                </div>
                <div>{{$kelas->guru->role}}</div>
            </div>
        </div>
    </a>
    @foreach($kelas->siswa as $row)
    <a href="{{route('profile', [$row->siswa->id, $row->siswa->user->name])}}">
        <div class="card hover:bg-base-200 text-center bg-base-100 shadow">
            <div class="card-body">
                @if($row->siswa->foto == '')
                <div class="avatar mx-auto placeholder">
                    <div
                        class="bg-primary text-primary-content rounded-full w-24"
                    >
                        <span
                            class="text-3xl"
                            >{{$row->siswa->user->name[0]}}</span
                        >
                    </div>
                </div>
                @else
                <div class="avatar mx-auto">
                    <div
                        class="w-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2"
                    >
                        <img
                            src="/images/stock/photo-1534528741775-53994a69daeb.jpg"
                        />
                    </div>
                </div>
                @endif
                <div class="card-title justify-center">
                    {{$row->siswa->user->name}}
                </div>
                <div>{{$row->siswa->role}}</div>
            </div>
        </div>
    </a>
    @endforeach
</div>
@endsection @section('script')
<script></script>
@endsection
