@extends('layouts.admin')

@section('content')
    <div class="content-wrapper bg-white">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="color: #000;">DATA PENGGUNA</h1>
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
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No Telp</th>
                        <th scope="col">Divisi</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tgl Join</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $user)
                        <tr>
                            <td scope="row">{{ $user->name }}</td>
                            <td>
                                {{ $user->alamat }}
                            </td>
                            <td>
                                {{ $user->no_telp }}
                            </td>
                            <td>
                                Admin Purchasing
                            </td>
                            <td>
                                {{ $user->role }}
                            </td>
                            <td>
                                {{ $user->tanggal_daftar }}

                            </td>
                            <td style="display: grid; align-items:center; justify-content:start; gap:2px;">

                                <form method="POST" action="{{ route('changeRole', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Ubah Peran</button>
                                </form>

                                <form method="POST" action="{{ route('updateUser', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>

                                <form method="POST" action="{{ route('deleteUser', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </section>

        <!-- /.content -->
    </div>
@endsection
