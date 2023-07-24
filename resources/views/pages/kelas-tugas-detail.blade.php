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
                href="{{ route('kelas.ujian', [$kelas->id, $kelas->kode]) }}"
                class="p-4 btn rounded-none normal-case font-bold"
                >Ujian</a
            >
            <a
                href="{{ route('kelas.anggota', [$kelas->id, $kelas->kode]) }}"
                class="p-4 btn rounded-none normal-case font-bold"
            >
                Anggota
            </a>
        </div>
        <div class="card border my-4 card-compact w-full shadow">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div class="flex gap-2 items-center justify-start">
                        <div class="avatar placeholder">
                            <div
                                class="bg-neutral-focus text-neutral-content rounded-full w-8"
                            >
                                <span
                                    class="text-sm font-semiboldcapitalize"
                                    >{{$tugas->profile->user->name[0]}}</span
                                >
                            </div>
                        </div>
                        <div class="font-bold">
                            {{$tugas->profile->user->name}}
                        </div>
                    </div>
                    <!-- <div class="text-primary">
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
                    <div class="">Bahasa Indonesia TBS12</div> -->
                    <div class="opacity-50">
                        {{ date("D, d M Y", strtotime($tugas->created_at)) }} -
                        {{ date("D, d M Y", strtotime($tugas->deadline)) }}
                    </div>
                </div>
                <div class="p-4 border-t">
                    <div class="card-title">{{$tugas->judul}}</div>
                    <div class="">{!! $tugas->deskripsi !!}</div>
                    <div class="divider"></div>
                    @if($tugas->files != '')
                    <a
                        href="/data/tugas/files/{{$tugas->files}}"
                        class="font-bold bg-base-200 p-1"
                        download
                    >
                        {{$tugas->files}}
                    </a>
                    @endif @if($tugas->images != '')
                    <div>
                        <img
                            src="/data/tugas/images/{{$tugas->images}}"
                            alt="tugas-image"
                            class="my-2"
                        />
                    </div>
                    @endif
                </div>
                @if(auth()->user()->profile->role == 'Guru')
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama Siswa</th>
                                <th class="text-right">Nilai</th>
                                <th class="text-center">Submission</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tugas->siswa as $row)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <td>{{$row->profile->user->name}}</td>
                                <td class="text-right">{{$row->nilai}}/100</td>
                                <td class="text-center">
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
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif @if(auth()->user()->profile->role == 'Siswa')
                <div class="grid grid-cols-2 gap-3">
                    @if($tugas_siswa->file != '')
                    <a
                        href="{{asset('data/tugas/siswa/'.$tugas_siswa->file)}}"
                        target="_blank"
                        class="btn btn-xs btn-info"
                        >Lihat Submission</a
                    >
                    @endif
                    <span>Nilai: {{$tugas_siswa->nilai}}/100</span>
                </div>
                <div class="divider"></div>
                <form
                    action="{{route('kelas.tugas.submit', [$kelas->id, $kelas->kode, $tugas->id])}}"
                    enctype="multipart/form-data"
                    method="post"
                >
                    @csrf
                    <input
                        name="files"
                        type="file"
                        class="file-input file-input-bordered w-full"
                        accept=".doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf"
                    />
                    <div class="py-2"></div>
                    <button type="submit" class="btn btn-primary btn-block">
                        Kirim Tugas
                    </button>
                </form>
                @endif
                <a
                    onclick="return window.history.back()"
                    class="btn btn-ghost btn-block"
                    >Kembali</a
                >
            </div>
        </div>
    </div>
</div>
@endsection @section('script')
<script>
    function btnInput(type) {
        if (type == "files") {
            document.getElementById("input-files").click();
        } else if (type == "images") {
            document.getElementById("input-images").click();
        }
    }

    function removeFileInput(type) {
        // Get the input element and preview image element
        if (type == "images") {
            const imageInput = document.getElementById("input-images");
            const previewImage = document.getElementById("previewImage");
            imageInput.value = "";
            previewImage.src = "#";
            previewImage.classList.add("hidden");
        } else if (type == "files") {
            const fileInput = document.getElementById("input-files");
            const inputFileName = document.getElementById("previewFile");
            fileInput.value = "";
            inputFileName.innerHTML = "";
            document.getElementById("btnHapusFile").classList.add("hidden");
        }
    }

    // Get the input element and preview image element
    const imageInput = document.getElementById("input-images");
    const previewImage = document.getElementById("previewImage");
    const fileInput = document.getElementById("input-files");
    const inputFileName = document.getElementById("previewFile");

    // Add an event listener to the input element for the change event
    imageInput.addEventListener("change", function (event) {
        // Get the selected file from the input element
        const file = event.target.files[0];

        // Create a FileReader object to read the file
        const reader = new FileReader();

        // Set up the FileReader onload event
        reader.onload = function (event) {
            // Set the preview image source to the data URL
            previewImage.src = event.target.result;
            previewImage.classList.remove("hidden");
        };

        // Read the file as a data URL
        reader.readAsDataURL(file);
    });
    // Add an event listener to the input element for the change event
    fileInput.addEventListener("change", function (event) {
        // Get the selected file from the input element
        const file = fileInput.files[0];

        // Get the filename from the file object
        const filename = file.name;

        // Log the filename or perform any desired action with it
        inputFileName.innerHTML = filename;
        document.getElementById("btnHapusFile").classList.remove("hidden");
    });
</script>
@endsection
