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
        <form
            action="{{ route('kelas.post', [$kelas->id, $kelas->kode]) }}"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf
            <input
                type="number"
                name="kelas_id"
                value="{{$kelas->id}}"
                readonly
                hidden
            />
            <textarea
                name="text"
                class="textarea textarea-primary w-full"
                placeholder="Apa yang ingin anda bagikan hari ini?"
            ></textarea>
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
                        accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf"
                        class="file-input w-full max-w-xs"
                        hidden
                    />
                    <label
                        onclick="btnInput('images')"
                        class="btn btn-primary btn-square btn-outline"
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
                        class="btn btn-primary btn-square btn-outline"
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
    </div>
</div>
@foreach($posts as $post)
<div class="flex gap-4">
    <div class="divider divider-horizontal">
        <span
            class="font-bold -my-1 text-xs"
            >{{ date("d/m/y", strtotime($post->created_at)) }}</span
        >
        <span
            class="-my-1 text-xs"
            >{{ date("H:i", strtotime($post->created_at)) }}</span
        >
    </div>
    <div class="card border card-compact w-full my-2 hover:shadow">
        <div class="card-body">
            <div class="flex gap-2 items-center justify-start">
                <div class="avatar placeholder">
                    <div
                        class="bg-neutral-focus text-neutral-content rounded-full w-8"
                    >
                        <span
                            class="text-sm font-semiboldcapitalize"
                            >{{$post->profile->user->name[0]}}</span
                        >
                    </div>
                </div>
                <div class="font-bold">{{$post->profile->user->name}}</div>
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
            </div>
            <div class="p-4 border-t">
                <div class="">
                    {{$post->text}}
                </div>
                <div class="divider"></div>
                <a
                    href="/data/post/files/{{$post->files}}"
                    class="font-bold bg-base-200 p-1"
                    download
                >
                    {{$post->files}}
                </a>
                <div>
                    <img
                        src="/data/post/images/{{$post->images}}"
                        alt="post-image"
                        class="my-2"
                    />
                </div>
            </div>
            <div class="bg-base-200 rounded-lg mx-4 p-4">
                @foreach($post->comments as $comment)
                @if($comment->profile->user->id == auth()->user()->id)
                <div class="chat chat-end">
                    <div class="chat-header">
                        {{$comment->profile->user->name}}
                        <time
                            class="text-xs opacity-50"
                            >{{date('d/m/y H:i', strtotime($comment->created_at))}}</time
                        >
                    </div>
                    <div class="chat-bubble">{{$comment->text}}</div>
                    <a
                        href="{{ route('kelas.post.comment.hapus', [$comment->id]) }}"
                        class="chat-footer opacity-50"
                        >Hapus</a
                    >
                </div>
                @else
                <div class="chat chat-start">
                    <div class="chat-header">
                        {{$comment->profile->user->name}}
                        <time
                            class="text-xs opacity-50"
                            >{{date('d/m/y H:i', strtotime($comment->created_at))}}</time
                        >
                    </div>
                    <div class="chat-bubble">{{$comment->text}}</div>
                    <!-- <a
                        href="{{ route('kelas.post.comment.hapus', [$comment->id]) }}"
                        class="chat-footer opacity-50"
                        >Hapus</a
                    > -->
                </div>
                @endif @endforeach
                <form
                    action="{{ route('kelas.post.comment', [$kelas->id, $kelas->kode, $post->id]) }}"
                    method="post"
                >
                    @csrf
                    <div>{{auth()->user()->name}}</div>
                    <textarea
                        name="text"
                        class="textarea textarea-bordered w-full"
                        placeholder="Ketikkan sesuatu..."
                    ></textarea>
                    <button
                        type="submit"
                        class="btn btn-primary btn-block text-base-100"
                    >
                        Kirim
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach @endsection @section('script')
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
