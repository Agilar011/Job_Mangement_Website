@extends('layouts.admin')

@section('content')
    <div class="content-wrapper bg-white">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="color: #000;">PRESENSI HARIAN</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v2</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        @php
            $checkInToday = DB::table('activity')
                ->whereDate('created_at', now()->toDateString())
                ->where('id_user', auth()->id())
                ->exists();
        @endphp
        <form method="POST" action="{{ route('checkin.checkin') }}">
            @csrf <!-- Tambahkan CSRF token -->
            <section class="content px-5" id="checkInSection"
                @if ($checkInToday) style="display: none;" @endif>
                <h5>Rencana Kegiatan :</h5>
                <textarea class="form-control bg-white" id="deskripsiCheckIn" placeholder="Hari ini rencana mau ngapain..."
                    name="deskripsi" required></textarea>

                <h5>Sekarang Pukul : <span id="jamCheckIn" name="jamCheckIn"></span></h5>
                <div class="btn-check">
                    <button class="check-in" type="submit">Check In</button>
                </div>
            </section>
        </form>

        <form method="POST" action="{{ route('checkout.checkout') }}" enctype="multipart/form-data">
            @csrf <!-- Tambahkan CSRF token -->
            <section class="content px-5" id="checkOutSection"
                @unless ($checkInToday) style="display: none;" @endunless>
                <h5>Laporan Hari ini :</h5>
                <textarea class="form-control bg-white" id="deskripsiCheckOut" placeholder="Apa yang telah kamu kerjakan hari ini?"
                    name="deskripsi" required></textarea>

                <h5>Upload Foto Dokumentasi Laporan</h5>
                <div class="foto-doc">
                    <input type="file" name="foto1" required>
                    <input type="file" name="foto2" required>
                </div>

                <h5>Skala Progress(1-10)</h5>
                <input type="number" class="skala-progress" required min="1" max="10" name="skala_progress">

                <h5>Sekarang Pukul : <span id="jamCheckOut"></span></h5>
                <div class="btn-check">
                    <button class="check-in" type="submit">Check Out</button>
                </div>


            </section>
        </form>


        {{-- <section class="content px-5" id="checkOutSection">
            <h5>Laporan Hari ini :</h5>
            <textarea class="form-control bg-white" id="deskripsiCheckOut" placeholder="Apa yang telah kamu kerjakan hari ini?"
                name="deskripsi" required></textarea>

            <h5>Upload Foto Dokumentasi Laporan</h5>
            <div class="foto-doc">
                <input type="file" required>
                <input type="file" required>
            </div>

            <h5>Skala Progress(1-10)</h5>
            <input type="number" class="skala-progress" required min="1" max="10">

            <h5>Sekarang Pukul : <span id="jamCheckOut"></span></h5>
            <div class="btn-check">
                <button class="check-in">Check Out</button>
            </div>
            @php
                $checkInToday = DB::table('activity')
                    ->whereDate('created_at', now()->toDateString())
                    ->where('id_user', auth()->id())
                    ->doesntExist();
            @endphp
        </section> --}}
    </div>

    <script>
        // Menangani pengiriman formulir secara asynchronous
        // document.querySelector('form').addEventListener('submit', function (e) {
        //     e.preventDefault(); // Menghentikan pengiriman formulir secara biasa

        //     // Lakukan pengiriman formulir menggunakan JavaScript Fetch API atau AJAX sesuai kebutuhan Anda
        //     // ...

        //     // Setelah formulir berhasil disubmit, jalankan fungsi checkIn()
        //     checkIn();
        // });

        // function checkIn() {
        //     document.getElementById('checkInSection').style.display = 'none';
        //     document.getElementById('checkOutSection').style.display = 'block';
        //     localStorage.setItem('viewStatus', 'checkIn'); // Simpan status terakhir
        // }

        // function checkOut() {
        //     document.getElementById('checkInSection').style.display = 'block';
        //     document.getElementById('checkOutSection').style.display = 'none';
        //     localStorage.setItem('viewStatus', 'checkOut'); // Simpan status terakhir
        // }

        // function updateViewStatus() {
        //     const viewStatus = localStorage.getItem('viewStatus');
        //     if (viewStatus === 'checkOut') {
        //         checkOut();
        //     } else {
        //         checkIn();
        //     }
        // }

        // Memanggil fungsi updateJam untuk menginisialisasi jam awal
        function updateJam() {
            const spanJamCheckIn = document.getElementById('jamCheckIn');
            const spanJamCheckOut = document.getElementById('jamCheckOut');

            function update() {
                const sekarang = new Date();
                const jam = sekarang.getHours().toString().padStart(2, '0');
                const menit = sekarang.getMinutes().toString().padStart(2, '0');
                const detik = sekarang.getSeconds().toString().padStart(2, '0');

                spanJamCheckIn.textContent = `${jam}:${menit}:${detik}`;
                spanJamCheckOut.textContent = `${jam}:${menit}:${detik}`;
            }

            // Memperbarui jam setiap detik
            update();
            setInterval(update, 1000);
        }

        // Memeriksa status terakhir saat halaman dimuat ulang
        window.addEventListener('load', () => {
            // updateViewStatus();
            updateJam();
        });
    </script>
@endsection
