@extends('layouts.main') @section('content') @if(session('alert'))
<script>
    alert("{{ session('alert') }}");
</script>
@endif
<div class="card card-compact w-full">
    <div class="card-body">
        <div class="card-title justify-between">
            <span> Ujian {{$ujian->judul}} </span>
            <span id="timer">01:59:00 </span>
        </div>
        <div>
            <p>{{$ujian->deskripsi}}</p>
        </div>
        <div class="grid grid-cols-1 gap-3">
            <form
                action="{{ route('kelas.ujian.submit', [$kelas->id, $kelas->kode, $ujian->id]) }}"
                method="post"
            >
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
                                <input
                                    name="jawab[{{$loop->iteration - 1}}]"
                                    type="radio"
                                    class="radio radio-primary"
                                    value="A"
                                />
                                <div class="join">
                                    <span class="join-item btn">A: </span>
                                    <input
                                        type="text"
                                        placeholder="Ketikkan opsi jawaban A"
                                        class="join-item input input-bordered w-full"
                                        value="{{$row->opsi_a}}"
                                        readonly
                                    />
                                </div>
                            </div>
                            <div
                                class="form-control flex-row items-center gap-2 w-full"
                            >
                                <input
                                    name="jawab[{{$loop->iteration - 1}}]"
                                    type="radio"
                                    class="radio radio-primary"
                                    value="B"
                                />
                                <div class="join">
                                    <span class="join-item btn">B: </span>
                                    <input
                                        readonly
                                        value="{{$row->opsi_b}}"
                                        type="text"
                                        placeholder="Ketikkan opsi jawaban B"
                                        class="join-item input input-bordered w-full"
                                    />
                                </div>
                            </div>
                            <div
                                class="form-control flex-row items-center gap-2 w-full"
                            >
                                <input
                                    name="jawab[{{$loop->iteration - 1}}]"
                                    type="radio"
                                    class="radio radio-primary"
                                    value="C"
                                />
                                <div class="join">
                                    <span class="join-item btn">C: </span>
                                    <input
                                        readonly
                                        value="{{$row->opsi_c}}"
                                        type="text"
                                        placeholder="Ketikkan opsi jawaban C"
                                        class="join-item input input-bordered w-full"
                                    />
                                </div>
                            </div>
                            <div
                                class="form-control flex-row items-center gap-2 w-full"
                            >
                                <input
                                    name="jawab[{{$loop->iteration - 1}}]"
                                    type="radio"
                                    class="radio radio-primary"
                                    value="D"
                                />
                                <div class="join">
                                    <span class="join-item btn">D: </span>
                                    <input
                                        readonly
                                        value="{{$row->opsi_d}}"
                                        type="text"
                                        placeholder="Ketikkan opsi jawaban D"
                                        class="join-item input input-bordered w-full"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="card-actions mt-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection @section('script')
<script>
    let timeRemaining = 120 * 60; // 120 minutes in seconds
    let timerInterval; // Variable to store the interval ID for the timer

    function updateTimer() {
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        const formattedTime = `${String(minutes).padStart(2, "0")}:${String(
            seconds
        ).padStart(2, "0")}`;

        const timerElement = document.getElementById("timer");
        timerElement.textContent = formattedTime;

        if (timeRemaining <= 0) {
            clearInterval(timerInterval);
            timerElement.textContent = "Time's up!";
        }
    }
    if (!timerInterval) {
        timerInterval = setInterval(() => {
            timeRemaining--;
            updateTimer();
        }, 1000);
    }
    updateTimer();
</script>
@endsection
