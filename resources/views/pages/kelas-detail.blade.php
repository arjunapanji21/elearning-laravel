@extends('layouts.main') @section('content')
<div class="card card-compact w-full">
    <div class="card-body">
        <div class="card-title">
            Kelas {{$kelas->nama}}
            <span
                class="badge badge-sm badge-primary font-bold text-base-100"
                >{{$kelas->kode}}</span
            >
        </div>
        <div class="flex">
            <div class="p-4 btn rounded-none normal-case font-bold">Materi</div>
            <div class="p-4 btn rounded-none normal-case font-bold">Tugas</div>
            <div class="p-4 btn rounded-none normal-case font-bold">Kuis</div>
            <div class="p-4 btn rounded-none normal-case font-bold">
                Anggota
            </div>
        </div>
        @if(auth()->user()->profile->role == "Guru")
        <textarea
            class="textarea textarea-primary"
            placeholder="Apa yang ingin anda bagikan hari ini?"
        ></textarea>
        <div class="flex justify-between">
            <div class="btn btn-primary btn-outline normal-case flex">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-paperclip w-6 h-6"
                    viewBox="0 0 16 16"
                >
                    <path
                        d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"
                    />
                </svg>
                Upload File
            </div>
            <div>
                <button class="btn btn-primary">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-send-fill"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"
                        />
                    </svg>
                    Kirim
                </button>
            </div>
        </div>
        @endif
    </div>
</div>
@for($i=0;$i<5;$i++)
<div class="flex gap-4">
    <div class="divider divider-horizontal">
        <span class="font-bold -my-1 text-xs">{{ date("d/m/y") }}</span>
        <span class="-my-1 text-xs">{{ date("H:i") }}</span>
    </div>
    <div class="card border card-compact w-full my-2 hover:shadow">
        <div class="card-body">
            <div class="flex gap-2 items-center justify-start">
                <div class="avatar placeholder">
                    <div
                        class="bg-neutral-focus text-neutral-content rounded-full w-8"
                    >
                        <span class="text-sm font-semiboldcapitalize">S</span>
                    </div>
                </div>
                <div class="font-bold">Siti Nurbaya</div>
                <div class="text-primary">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-caret-right-fill"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"
                        />
                    </svg>
                </div>
                <div class="">Bahasa Indonesia TBS12</div>
            </div>
            <div class="p-4 border-t">
                <div class="card-title">Tugas 1</div>
                <div class="">
                    Carilah artikel berita terkini mengenai isu lingkungan dan
                    buatlah rangkuman serta pendapatmu. Upload tugas di kolom
                    komentar, ditunggu paling lambat hari senin!
                </div>
            </div>
            <div class="card-actions">
                <div class="btn btn-block normal-case">Lihat</div>
            </div>
        </div>
    </div>
</div>
@endfor @endsection
