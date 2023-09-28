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
                    @if (Auth::user()->role == 'admin')
                        <!-- Memeriksa apakah pengguna memiliki peran 'admin' -->
                        <!-- Tampilkan konten khusus untuk pengguna dengan peran 'admin' -->
                        <p>Selamat datang, Admin!</p>
                        @if (!empty($activities))
                            <ul>
                                @foreach ($activities as $activity)
                                    <tr>
                                        <td scope="row">{{ date('d-m-Y', strtotime($activity->created_at)) }}</td>
                                        <td>
                                            {{ $activity->nama }}
                                        </td>
                                        <td>{{ date('H:i', strtotime($activity->created_at)) }}</td>
                                        <td style="max-width: 120px">
                                            {{ $activity->rencana_aktifitas }}
                                        </td>
                                        <td>
                                            @if ($activity->updated_at != null)
                                                {{ date('H:i', strtotime($activity->updated_at)) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td style="max-width: 120px;">
                                            @if ($activity->laporan_aktifitas != null)
                                                {{ $activity->laporan_aktifitas }}
                                            @else
                                                -
                                            @endif

                                        </td>
                                        <td>
                                            @if ($activity->foto1 != null)
                                                <img src="{{ asset('storage/' . $activity->foto1) }}"
                                                    alt="" style="width: 100px">
                                            @else
                                                -
                                            @endif

                                            @if ($activity->foto2 != null)
                                            <img src="{{ asset('storage/' . $activity->foto2) }}" alt="Foto 2" style="width: 100px">
                                            @else
                                                -
                                            @endif

                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('destroyActivity', $activity->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </ul>
                        @endif
                    @else
                        <!-- Tampilkan konten khusus untuk pengguna dengan peran selain 'admin' -->
                        <p>Selamat datang, Pengguna!</p>
                        @if (!empty($activityUser))
                            <ul>
                                @foreach ($activityUser as $activity)
                                    <tr>
                                        <td scope="row">{{ date('d-m-Y', strtotime($activity->created_at)) }}</td>
                                        <td>
                                            {{ $activity->nama }}
                                        </td>
                                        <td>{{ date('H:i', strtotime($activity->created_at)) }}</td>
                                        <td style="max-width: 120px">
                                            {{ $activity->rencana_aktifitas }}
                                        </td>
                                        <td>
                                            @if ($activity->updated_at != null)
                                                {{ date('H:i', strtotime($activity->updated_at)) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td style="max-width: 120px">
                                            @if ($activity->laporan_aktifitas != null)
                                                {{ $activity->laporan_aktifitas }}
                                            @else
                                                -
                                            @endif

                                        </td>
                                        <td>
                                            @if ($activity->foto1 != null)
                                                <img src="{{ asset('storage/' . $activity->foto1) }}"
                                                    alt="" style="width: 100px">
                                            @else
                                                -
                                            @endif

                                            @if ($activity->foto2 != null)
                                            <img src="{{ asset('storage/' . $activity->foto2) }}" alt="Foto 2" style="width: 100px">
                                            @else
                                                -
                                            @endif

                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </ul>
                        @endif
                    @endif

                </tbody>
            </table>
        </section>

        <!-- /.content -->
    </div>
@endsection
