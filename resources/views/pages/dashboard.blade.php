@extends('layouts.main') @section('content')
<div class="font-bold text-xl pb-4">Dashboard</div>
@for($i=0;$i<5;$i++)
<div class="flex gap-4">
    <div class="divider divider-horizontal">
        <span class="text-xs">{{ date("d/m/y") }}</span>
    </div>
    <div class="card border card-compact w-full">
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
