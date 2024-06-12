@extends('website.layouts.app', ['title' => 'Tambah Siswa'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Siswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Siswa</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- /.card -->
                    <!-- Horizontal Form -->
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('siswa.index') }}" class="btn btn-success"><i class="fa fa-chevron-left"></i> Back</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="{{ route('siswa.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kartu</label>
                                    <div class="col-sm-10">
                                        <select name="kode" class="form-control @error('kode') is-invalid @enderror"">
                                            <option value="">[ Pilih Kartu ]</option>
                                            @foreach($kartus as $kartu)
                                                <option value="{{ $kartu->kode }}" @selected(old('kode') == $kartu->kode)>{{ $kartu->kode }}</option>
                                            @endforeach
                                        </select>
                                        @error('kode')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Name" name="nama" value="{{ old('nama') }}">
                                        @error('nama')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                            <option value="">[ Jenis Kelamin ]</option>
                                            <option value="1" @selected(old('jenis_kelamin') == "1")>Laki Laki</option>
                                            <option value="2" @selected(old('jenis_kelamin') == "2")>Perempuan</option>
                                        </select>
                                        @error('gender')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="Birth Of Date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                        @error('tanggal_lahir')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jurusan</label>
                                    <div class="col-sm-10">
                                        <select name="id_jurusan" class="form-control @error('id_jurusan') is-invalid @enderror">
                                            <option value="">[ Pilih Jurusan ]</option>
                                            @foreach($jurusans as $jurusan)
                                                <option value="{{ $jurusan->id }}" @selected(old('id_jurusan') == $jurusan->id)>{{ $jurusan->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_jurusan')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tingkat</label>
                                    <div class="col-sm-10">
                                        <select name="id_tingkat" class="form-control @error('id_tingkat') is-invalid @enderror">
                                            <option value="">[ Pilih Tingkat ]</option>
                                            @foreach($tingkats as $tingkat)
                                                <option value="{{ $tingkat->id }}" @selected(old('id_tingkat') == $tingkat->id)>{{ $tingkat->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_tingkat')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea name="alamat" rows="5" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nomor</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('nomor') is-invalid @enderror" placeholder="Phone Number" name="nomor" value="{{ old('nomor') }}">
                                        @error('nomor')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Start Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control @error('start_date') is-invalid @enderror" placeholder="Start Date" name="start_date" value="{{ old('start_date') }}">
                                        @error('start_date')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
