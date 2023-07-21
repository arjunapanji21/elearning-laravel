@extends('layouts.main') @section('content')
<div class="font-bold text-xl pb-4">{{ $title . ' ' . $profile->role}}</div>
@if(auth()->user()->profile->id == $profile->id)
<div class="card bg-base-100 shadow">
    <form
        action="{{route('profile.update', auth()->user()->profile->id)}}"
        method="post"
        enctype="multipart/form-data"
    >
        @csrf
        <div class="card-body">
            <div class="">
                <div class="flex flex-col gap-3">
                    <div
                        id="avatar1"
                        class="avatar mx-auto placeholder @if($profile->foto != '') hidden @endif"
                    >
                        <div
                            class="bg-primary text-primary-content rounded-full w-52"
                        >
                            <span
                                class="text-8xl"
                                >{{$profile->user->name[0]}}</span
                            >
                        </div>
                    </div>
                    <div
                        id="avatar2"
                        class="avatar mx-auto @if($profile->foto == '') hidden @endif"
                    >
                        <div
                            class="w-52 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2"
                        >
                            <img
                                id="previewImage"
                                src="{{asset('data/profile/'.$profile->foto)}}"
                            />
                        </div>
                    </div>
                    <input
                        id="input-image"
                        name="foto"
                        type="file"
                        accept=".jpg, .jpeg, .png, .webm"
                        class="file-input file-input-primary file-input-bordered file-input-sm my-2"
                    />
                </div>
                <div class="w-full grid md:grid-cols-2 gap-3">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Nama</span>
                        </label>
                        <input
                            name="nama"
                            type="text"
                            placeholder="Nama"
                            class="input input-bordered w-full"
                            value="{{$profile->user->name}}"
                        />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Tgl. Lahir</span>
                        </label>
                        <input
                            name="tgl_lahir"
                            type="date"
                            class="input input-bordered w-full"
                            value="{{$profile->tgl_lahir}}"
                        />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Alamat</span>
                        </label>
                        <input
                            name="alamat"
                            type="text"
                            placeholder="Alamat"
                            class="input input-bordered w-full"
                            value="{{$profile->alamat}}"
                        />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">No. Telp.</span>
                        </label>
                        <input
                            name="telp"
                            type="text"
                            placeholder="0812XXXXXXX"
                            class="input input-bordered w-full"
                            value="{{$profile->telp}}"
                        />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input
                            name="email"
                            type="email"
                            placeholder="Email"
                            class="input input-bordered w-full"
                            value="{{$profile->user->email}}"
                        />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Username</span>
                        </label>
                        <input
                            disabled
                            type="text"
                            placeholder="Username"
                            class="input input-bordered w-full"
                            value="{{$profile->user->username}}"
                        />
                        <input
                            readonly
                            hidden
                            name="username"
                            type="text"
                            placeholder="Username"
                            class="input input-bordered w-full"
                            value="{{$profile->user->username}}"
                        />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input
                            name="password"
                            type="text"
                            placeholder="Password"
                            class="input input-bordered w-full"
                        />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Ulangi Password</span>
                        </label>
                        <input
                            name="password_confirmation"
                            type="text"
                            placeholder="Password"
                            class="input input-bordered w-full"
                        />
                    </div>
                </div>
            </div>
            <div class="card-actions mt-2 justify-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a onclick="return window.history.back()" class="btn btn-ghost"
                    >Kembali</a
                >
            </div>
        </div>
    </form>
</div>
@else
<div class="card bg-base-100 shadow">
    <div class="card-body">
        <div class="flex flex-col lg:flex-row">
            <div class="flex flex-col gap-3">
                <div
                    id="avatar1"
                    class="avatar mx-auto placeholder @if($profile->foto != '') hidden @endif"
                >
                    <div
                        class="bg-primary text-primary-content rounded-full w-52"
                    >
                        <span
                            class="text-8xl"
                            >{{$profile->user->name[0]}}</span
                        >
                    </div>
                </div>
                <div
                    id="avatar2"
                    class="avatar mx-auto @if($profile->foto == '') hidden @endif"
                >
                    <div
                        class="w-52 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2"
                    >
                        <img
                            id="previewImage"
                            src="{{asset('data/profile/'.$profile->foto)}}"
                        />
                    </div>
                </div>
            </div>
            <div class="divider lg:divider-horizontal"></div>
            <div class="w-full">
                <div class="overflow-x-auto">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Nama</th>
                                <td>{{$profile->user->name}}</td>
                            </tr>
                            <tr>
                                <th>Tgl. Lahir</th>
                                <td>
                                    {{date('d M Y', strtotime($profile->tgl_lahir))}}
                                </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>
                                    {{$profile->alamat}}
                                </td>
                            </tr>
                            <tr>
                                <th>No. Telp</th>
                                <td>
                                    {{$profile->telp}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-actions justify-end">
            <a onclick="return window.history.back()" class="btn btn-primary"
                >Kembali</a
            >
        </div>
    </div>
</div>
@endif @endsection @section('script')
<script>
    const imageInput = document.getElementById("input-image");
    const previewImage = document.getElementById("previewImage");
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
            document.getElementById("avatar2").classList.remove("hidden");
            document.getElementById("avatar1").classList.add("hidden");
        };

        // Read the file as a data URL
        reader.readAsDataURL(file);
    });
</script>
@endsection
