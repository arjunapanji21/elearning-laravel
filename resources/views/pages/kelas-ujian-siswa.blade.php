@extends('layouts.main') @section('content') @if(session('alert'))
<script>
    alert("{{ session('alert') }}");
</script>
@endif
<div class="card card-compact w-full">
    <div class="card-body">
        <div class="card-title justify-between">
            <span
                >Hasil Ujian {{$ujian_siswa->profile->user->name}} -
                {{$ujian->judul}}
            </span>
        </div>
        <div>
            <p>{{$ujian->deskripsi}}</p>
        </div>
        <div class="grid grid-cols-1 gap-3">
            @csrf @foreach($ujian->soal as $row)
            <div class="card bordered">
                <div class="card-body">
                    <div class="card-title">
                        <div class="form-control w-full">
                            <div class="join">
                                <span class="join-item btn"
                                    >{{$loop->iteration}}.
                                </span>
                                <input
                                    readonly
                                    type="text"
                                    placeholder="Ketikkan pertanyaan"
                                    class="input input-bordered w-full join-item"
                                    value="{{$row->soal}}"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div
                            class="form-control flex-row items-center gap-2 w-full"
                        >
                            @if($ujian_siswa->jawaban[$loop->iteration-1] ==
                            "A")
                            <input
                                name="jawab[{{$loop->iteration - 1}}]"
                                type="radio"
                                disabled
                                class="radio radio-primary"
                                value="A"
                                checked
                            />
                            @else
                            <input
                                name="jawab[{{$loop->iteration - 1}}]"
                                type="radio"
                                disabled
                                class="radio radio-primary"
                                value="A"
                            />
                            @endif
                            <div class="join">
                                <span class="join-item btn">A: </span>
                                <input
                                    type="text"
                                    placeholder="Ketikkan opsi jawaban A"
                                    class="join-item input @if($row->jawaban == 'A') input-primary @else input-error @endif input-bordered w-full"
                                    value="{{$row->opsi_a}}"
                                    readonly
                                />
                            </div>
                        </div>
                        <div
                            class="form-control flex-row items-center gap-2 w-full"
                        >
                            @if($ujian_siswa->jawaban[$loop->iteration-1] ==
                            "B")
                            <input
                                name="jawab[{{$loop->iteration - 1}}]"
                                type="radio"
                                disabled
                                class="radio radio-primary"
                                value="B"
                                checked
                            />
                            @else
                            <input
                                name="jawab[{{$loop->iteration - 1}}]"
                                type="radio"
                                disabled
                                class="radio radio-primary"
                                value="B"
                            />
                            @endif
                            <div class="join">
                                <span class="join-item btn">B: </span>
                                <input
                                    readonly
                                    value="{{$row->opsi_b}}"
                                    type="text"
                                    placeholder="Ketikkan opsi jawaban B"
                                    class="join-item input input-bordered w-full @if($row->jawaban == 'B') input-primary @else input-error @endif"
                                />
                            </div>
                        </div>
                        <div
                            class="form-control flex-row items-center gap-2 w-full"
                        >
                            @if($ujian_siswa->jawaban[$loop->iteration-1] ==
                            "C")
                            <input
                                name="jawab[{{$loop->iteration - 1}}]"
                                type="radio"
                                disabled
                                class="radio radio-primary"
                                value="C"
                                checked
                            />
                            @else
                            <input
                                name="jawab[{{$loop->iteration - 1}}]"
                                type="radio"
                                disabled
                                class="radio radio-primary"
                                value="C"
                            />
                            @endif
                            <div class="join">
                                <span class="join-item btn">C: </span>
                                <input
                                    readonly
                                    value="{{$row->opsi_c}}"
                                    type="text"
                                    placeholder="Ketikkan opsi jawaban C"
                                    class="join-item input input-bordered w-full @if($row->jawaban == 'C') input-primary @else input-error @endif"
                                />
                            </div>
                        </div>
                        <div
                            class="form-control flex-row items-center gap-2 w-full"
                        >
                            @if($ujian_siswa->jawaban[$loop->iteration-1] ==
                            "D")
                            <input
                                name="jawab[{{$loop->iteration - 1}}]"
                                type="radio"
                                disabled
                                class="radio radio-primary"
                                value="D"
                                checked
                            />
                            @else
                            <input
                                name="jawab[{{$loop->iteration - 1}}]"
                                type="radio"
                                disabled
                                class="radio radio-primary"
                                value="D"
                            />
                            @endif
                            <div class="join">
                                <span class="join-item btn">D: </span>
                                <input
                                    readonly
                                    value="{{$row->opsi_d}}"
                                    type="text"
                                    placeholder="Ketikkan opsi jawaban D"
                                    class="join-item input input-bordered w-full @if($row->jawaban == 'D') input-primary @else input-error @endif"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div
                class="text-center py-2 font-bold text-lg border-2 rounded-box w-full"
            >
                Nilai: {{$ujian_siswa->nilai}}/100
            </div>
            <div class="card-actions mt-4">
                <a
                    onclick="return window.history.back()"
                    class="btn btn-primary btn-block"
                >
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection @section('script') @endsection
