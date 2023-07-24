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
        @if(auth()->user()->profile->role == "Guru")
        <form
            action="{{ route('kelas.tugas.new', [$kelas->id, $kelas->kode]) }}"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf
            <div class="form-control w-full py-2">
                <input name="judul" type="text" placeholder="Judul Tugas" class="input input-bordered w-full" />
              </div>
            <textarea
                name="deskripsi"
                class="textarea textarea-bordered w-full py-2"
                placeholder="Deskripsi Tugas"
            ></textarea>
            <div class="join w-full">
                <span class="join-item btn">Deadline</span>
                <input name="deadline" type="date" placeholder="Deadline Tugas" class="input input-bordered w-full join-item" />
            </div>
            <div class="flex items-center">
                <div
                    id="previewFile"
                    class="bg-base-200 font-bold w-max my-2"
                ></div>
                <label
                    onclick="removeFileInput('files')"
                    id="btnHapusFile"
                    class="btn btn-square btn-xs btn-error btn-outline hidden"
                >
                    x
                </label>
            </div>
            <img
                onclick="removeFileInput('images')"
                id="previewImage"
                src="#"
                alt="Preview Image"
                class="w-20 h-20 object-cover hover:brightness-50 hover:cursor-pointer p-2 my-2 bg-base-200 rounded hidden"
            />
            <div class="flex justify-between">
                <div class="flex gap-1">
                    <input
                        id="input-images"
                        name="images[]"
                        type="file"
                        accept="image/png, image/gif, image/jpeg"
                        class="file-input w-full max-w-xs"
                        hidden
                    />
                    <input
                        id="input-files"
                        name="files[]"
                        type="file"
                        accept=".doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf"
                        class="file-input w-full max-w-xs"
                        hidden
                    />
                    <label
                        onclick="btnInput('images')"
                        class="btn opacity-50 btn-square btn-outline"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-images"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"
                            />
                            <path
                                d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"
                            />
                        </svg>
                    </label>
                    <label
                        onclick="btnInput('files')"
                        class="btn opacity-50 btn-square btn-outline"
                    >
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
                    </label>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">
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
        </form>
        @endif
        <div class="divider"></div>
        <div class="font-bold text-xl">Tugas</div>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="bg-primary text-primary-content">
                        <th>No.</th>
                        <th>Tugas</th>
                        <th>Deadline</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tugas as $row)
                    <tr class="hover">
                        <th>{{$loop->iteration}}</th>
                        <td>{{ $row->judul }}</td>
                        <td>{{ date('d M Y', strtotime($row->deadline)) }}</td>
                        <td class="text-center">
                            <a
                                href="{{route('kelas.tugas.detail', [$kelas->id, $kelas->kode, $row->id])}}"
                                class="btn btn-sm btn-square btn-primary"
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
                                onclick="return confirm('Hapus tugas ini?')"
                                href="{{route('kelas.tugas.delete', [$kelas->id, $kelas->kode, $row->id])}}"
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
