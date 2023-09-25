@extends('layouts.admin')

@section('content')
    <div class="content-wrapper bg-white">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="color: #000;">AKTIVITAS HARIAN</h1>
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
        <section class="content px-5">
            <div class="container-dropdown-omzet" style="display: flex; align-items:center; justify-content:space-between;">
                <div class="container-dropdown" style="display: flex; align-items:center">
                    <div class="dropdown mt-3 mb-3" id="myDropdown1">
                        <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Retail
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                            <li><a class="dropdown-item" href="#">WSS Tingal</a></li>
                            <li><a class="dropdown-item" href="#">WSS Bendogerit</a></li>
                            <li><a class="dropdown-item" href="#">WSS Dawuhan</a></li>
                            <li><a class="dropdown-item" href="#">WSS Jati</a></li>
                        </ul>
                    </div>

                    <div class="dropdown mt-3 mb-3 ml-3" id="myDropdown2">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Time Frame
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                            <li><a class="dropdown-item" href="#">1 Hari</a></li>
                            <li><a class="dropdown-item" href="#">1 Bulan</a></li>
                            <li><a class="dropdown-item" href="#">1 Minggu</a></li>
                            {{-- <li><a class="dropdown-item" href="#">Option 4</a></li> --}}
                        </ul>
                    </div>
                </div>

                <div class="container-omzet">
                    <h5>Total Revenue: <span id="totalRevenue" style="color: green">Rp. 0,-</span></h5>
                </div>
            </div>


            <table class="table table-hover">
                <thead>
                    <tr class="table-success">
                        <th scope="col">ID</th>
                        <th scope="col">Transaksi Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Qty Terjual</th>
                        <th scope="col">Total Transaksi</th>
                        <th scope="col">Retail</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>
                            <li>Apel Fuji</li>
                            <li>Sawi</li>
                            <li>Bayam</li>
                        </td>
                        <td>
                            <li> Rp. 5000,-/Kg</li>
                            <li> Rp. 2500,-/Kg</li>
                            <li> Rp. 4000,-/Kg</li>
                        </td>
                        <td>
                            <li>2Kg</li>
                            <li>4Kg</li>
                            <li>5Kg</li>
                        </td>
                        <td style="color:green;">Rp. 40.000.000,-</td>
                        <td style="color: rgb(0, 0, 0);">WSS Dawuhan</td>
                        <td>
                            {{-- <button type="button" class="btn btn-primary">Update</button> --}}
                            <button type="button" class="btn btn-danger">Hapus</button>
                        </td>
                    </tr>

                </tbody>
            </table>
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
        </script>

@endsection
