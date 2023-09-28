@extends('layouts.admin')

@section('content')
<div class="content-wrapper bg-white">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: #000;">Edit Produk</h1>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body bg-white">
                            <form method="POST" action="{{ route('storeUpdateUser', ['id' => $user->id]) }}">
                                @csrf
                                {{-- @method('PUT') --}}

                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" style="background: white; color:#000;" value="{{ $user->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" style="background: rgb(233, 232, 232); color:#000;"value="{{ $user->email }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input name="alamat" class="form-control" style="background: white; color:#000;" value="{{ $user->alamat }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="no_telp">Nomor Telepon</label>
                                    <input type="text" name="no_telp" class="form-control" style="background: white; color:#000;" value="{{ $user->no_telp }}" required>
                                </div>

                                {{-- <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" name="status" class="form-control"   style="background: rgb(233, 232, 232); color:#000;" disabled>
                                </div> --}}

                                {{-- <div class="form-group">
                                    <label for="tgl_join">Tanggal Join</label>
                                    <input type="date" name="tgl_join" class="form-control" style="background: white; color:#000;" value="{{ $user->created_at->format('Y-m-d') }}" disabled>
                                </div> --}}

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
