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
                href="{{ route('kelas.tugas', [$kelas->id, $kelas->kode]) }}"
                class="p-4 btn rounded-none normal-case font-bold"
                >Tugas</a
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
        @if(auth()->user()->profile->role == "Guru")
        <form
            action="{{ route('kelas.materi.upload', [$kelas->id, $kelas->kode]) }}"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf
            <div class="flex flex-col gap-2">
                <input
                    type="text"
                    name="judul"
                    class="input input-bordered w-full"
                    placeholder="Ketikkan Judul Materi"
                />
                <div class="join">
                    <select
                        id="select-file"
                        name="type"
                        class="select select-bordered bg-base-200 select-sm join-item"
                    >
                        <option value="Dokumen" selected>Dokumen</option>
                        <option value="Video">Video</option>
                    </select>
                    <input
                        id="input-dokumen"
                        name="dokumen"
                        type="file"
                        accept=".doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf"
                        class="file-input file-input-sm file-input-bordered w-full file-input-primary join-item"
                    />
                    <input
                        id="input-video"
                        name="video"
                        type="file"
                        accept=".mp4, .webm"
                        class="file-input file-input-sm file-input-bordered w-full file-input-primary join-item hidden"
                    />
                </div>
                <button
                    type="submit"
                    class="btn btn-primary btn-block text-base-100"
                >
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
        </form>
        @endif
        <div class="divider"></div>
        <div class="font-bold text-xl">Materi</div>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="bg-primary text-primary-content">
                        <th>No.</th>
                        <th>Judul Materi</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materi as $row)
                    <tr class="hover">
                        <th>{{$loop->iteration}}</th>
                        <td>{{ $row->judul }}</td>
                        <td>{{ $row->type }}</td>
                        <td class="text-center">
                            <a
                                href="{{asset('data/materi/'.$row->file)}}"
                                class="btn btn-sm btn-square btn-primary"
                                target="_blank"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-eye-fill"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"
                                    />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"
                                    />
                                </svg>
                            </a>
                            @if(auth()->user()->profile->role == 'Guru')
                            <a
                                onclick="return confirm('Hapus materi ini?')"
                                href="{{route('kelas.materi.delete', [$kelas->id, $kelas->kode, $row->id])}}"
                                class="btn btn-sm btn-square btn-error"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-trash3-fill"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"
                                    />
                                </svg>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection @section('script')
<script>
    // Add an event listener to the input element for the change event
    const fileInput = document.getElementById("select-file");
    const inputDokumen = document.getElementById("input-dokumen");
    const inputVideo = document.getElementById("input-video");
    fileInput.addEventListener("change", function (event) {
        // Get the selected file from the input element
        if (fileInput.value == "Dokumen") {
            inputDokumen.classList.remove("hidden");
            inputVideo.classList.add("hidden");
            inputDokumen.value = "";
            inputVideo.value = "";
        } else if (fileInput.value == "Video") {
            inputDokumen.classList.add("hidden");
            inputVideo.classList.remove("hidden");
            inputDokumen.value = "";
            inputVideo.value = "";
        }
    });
</script>
@endsection
