@extends('layouts.main') @section('content')
<div class="font-bold text-xl pb-4">Dashboard</div>
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
                <div class="">{{$post->kelas->nama}}</div>
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
            <div class="card-actions">
                <a
                    href="{{route('kelas.detail', [$post->kelas->id, $post->kelas->kode])}}"
                    class="btn btn-block normal-case"
                    >Lihat</a
                >
            </div>
        </div>
    </div>
</div>
@endforeach @endsection
