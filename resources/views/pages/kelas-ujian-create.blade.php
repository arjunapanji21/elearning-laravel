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
        @if(auth()->user()->profile->role == "Guru")
        <form
            action="{{ route('kelas.ujian.store', [$kelas->id, $kelas->kode]) }}"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf
            <div class="flex flex-col gap-3">
                <div class="form-control w-full ">
                    <input name="judul" type="text" placeholder="Judul Ujian" class="input input-bordered w-full" />
                  </div>
                <textarea
                    name="deskripsi"
                    class="textarea textarea-bordered w-full "
                    placeholder="Deskripsi Ujian"
                ></textarea>
                <div class="grid grid-cols-2 gap-3">
                    <div class="join w-full">
                        <span class="join-item btn">Deadline</span>
                        <input name="deadline" type="date" placeholder="Deadline Tugas" class="input input-bordered w-full join-item" />
                    </div>
                    <div class="join">
                        <span class="join-item btn">Jumlah Soal</span>
                        <select id="jumlahSoal" name="jumlahSoal" class="select select-bordered w-full join-item">
                            <option disabled selected>Jumlah Soal:</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                            <option value="35">35</option>
                            <option value="40">40</option>
                            <option value="45">45</option>
                            <option value="50">50</option>
                          </select>
                    </div>
                </div>
                <div id="container"></div>
                <button type="submit" class="btn btn-primary btn-block">
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
    </div>
</div>
@endsection @section('script')
<script>
    const jumlahSoal = document.getElementById("jumlahSoal");
    const container = document.getElementById("container");
    // Add an event listener to the input element for the change event
    jumlahSoal.addEventListener("change", function (event) {
        var soal = [];
        container.innerHTML = '';
        for(let i = 0; i < jumlahSoal.value; i++){
            soal.push(`
            <div class="card bordered">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="form-control w-full ">
                                <div class="join">
                                    <span class="join-item btn">${i+1}. </span>
                                    <input name="soal[]" type="text" placeholder="Ketikkan pertanyaan" class="input input-bordered w-full join-item" />
                                </div>
                              </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="form-control w-full ">
                                <div class="join">
                                    <span class="join-item btn">A: </span>
                                    <input name="opsi_a[]" type="text" placeholder="Ketikkan opsi jawaban A" class="join-item input input-bordered w-full" />
                                </div>
                              </div>
                            <div class="form-control w-full ">
                                <div class="join">
                                    <span class="join-item btn">B: </span>
                                    <input name="opsi_b[]" type="text" placeholder="Ketikkan opsi jawaban B" class="join-item input input-bordered w-full" />
                                </div>
                              </div>
                            <div class="form-control w-full ">
                                <div class="join">
                                    <span class="join-item btn">C: </span>
                                    <input name="opsi_c[]" type="text" placeholder="Ketikkan opsi jawaban C" class="join-item input input-bordered w-full" />
                                </div>
                              </div>
                            <div class="form-control w-full ">
                                <div class="join">
                                    <span class="join-item btn">D: </span>
                                    <input name="opsi_d[]" type="text" placeholder="Ketikkan opsi jawaban D" class="join-item input input-bordered w-full" />
                                </div>
                              </div>
                        </div>
                        <div class="join">
                            <span class="join-item btn">Jawaban Benar</span>
                            <select name="jawaban[]" class="select select-bordered w-full join-item">
                                <option disabled selected>Pilih Jawaban</option>
                                <option value="A">Opsi A</option>
                                <option value="B">Opsi B</option>
                                <option value="C">Opsi C</option>
                                <option value="D">Opsi D</option>
                              </select>
                        </div>
                    </div>
                </div>
            `);
        }
        container.innerHTML = soal;
    });
</script>
@endsection
