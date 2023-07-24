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
        <div class="divider"></div>
        <div class="font-bold text-xl flex flex-row items-center gap-3">
            <span>Soal Ujian</span>
            @if(auth()->user()->profile->role == 'Guru')<span class="btn btn-primary btn-sm">+ Create</span>@endif
        </div>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="bg-primary text-primary-content">
                        <th>No.</th>
                        <th>Ujian</th>
                        <th>Deadline</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
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
