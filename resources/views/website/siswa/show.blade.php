@extends('website.layouts.app', ['title' => 'Detail Siswa'])

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Detail Siswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Detail Siswa</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('siswa.index') }}" class="btn btn-success"><i class="fa fa-chevron-left"></i> Back</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th>Kartu</th>
                                        <td>:</td>
                                        <td>{{ $siswa->kode }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>:</td>
                                        <td>{{ $siswa->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jurusan</th>
                                        <td>:</td>
                                        <td>{{ $siswa->jurusan->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tingkat / Kelas</th>
                                        <td>:</td>
                                        <td>{{ $siswa->tingkat->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>:</td>
                                        <td>{{ $siswa->jenis_kelamin == 1 ? "Laki-Laki" : "Perempuan" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>:</td>
                                        <td>{{ $siswa->tanggal_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>:</td>
                                        <td>{{ $siswa->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor</th>
                                        <td>:</td>
                                        <td>{{ $siswa->nomor }}</td>
                                    </tr>
                                    <tr>
                                        <th>Start Date</th>
                                        <td>:</td>
                                        <td>{{ $siswa->start_date }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
