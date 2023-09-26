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

            <table class="table table-hover">
                <thead>
                    <tr class="table-success">
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Wkt. Check In</th>
                        <th scope="col">Rencana</th>
                        <th scope="col">Wkt. Check Out</th>
                        <th scope="col">Laporan</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">26/09/2023</td>
                        <td>
                            Adimas Surya
                        </td>
                        <td>
                            07:45:12
                        </td>
                        <td style="max-width: 120px">
                           Rekap Laporan Penjualan Toko bulan september
                        </td>
                        <td>
                            16:45:12
                        </td>
                        <td style="max-width: 120px">
                            - Rekap Laporan Penjualan Toko bulan september ✅ <br>
                            - Melaksanakan audit di Toko jl. Wr Supratman ✅ <br>
                            - Membuat Pricetag toko jl. Wr Supratman ✅ <br>

                         </td>
                         <td>

                         </td>
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

@endsection
