@extends('layouts.admin')

@section('content')
    <div class="content-wrapper bg-white">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="color: #000;">Halaman Guest</h1>
                    </div><!-- /.col -->
                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v2</li>
                        </ol>
                    </div><!-- /.col --> --}}
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>


        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content px-5">
            <h5>Mohon Maaf anda tidak bisa akses halaman tersebut. Silahkan tunggu konfirmasi dari Admin</h5>
        </section>

        <!-- /.content -->
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function toggleDropdown(dropdownId) {
                var dropdown = document.getElementById(dropdownId);
                var dropdownToggle = dropdown.querySelector(".dropdown-toggle");
                var dropdownMenu = dropdown.querySelector(".dropdown-menu");

                dropdownToggle.addEventListener("click", function() {
                    dropdownMenu.classList.toggle("show");
                });

                document.addEventListener("click", function(event) {
                    if (!dropdown.contains(event.target)) {
                        dropdownMenu.classList.remove("show");
                    }
                });
            }

            toggleDropdown("myDropdown1");
            toggleDropdown("myDropdown2");

        });

        function updateJam() {
            const spanJam = document.getElementById('jam');
            const sekarang = new Date();
            const jam = sekarang.getHours().toString().padStart(2, '0');
            const menit = sekarang.getMinutes().toString().padStart(2, '0');
            const detik = sekarang.getSeconds().toString().padStart(2, '0');
            spanJam.textContent = `${jam}:${menit}:${detik}`;
        }

        // Memperbarui jam setiap detik
        setInterval(updateJam, 1000);

        // Memanggil fungsi updateJam untuk menginisialisasi jam awal
        updateJam();

    </script>
@endsection
