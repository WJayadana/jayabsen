@extends('website.layouts.app', ['title' => 'Presences'])

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
                    <h1>Presences</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Presences</li>
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
                            <h3 class="card-title">Presence Today {{ \Carbon\Carbon::now()->format('d F Y') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jurusan</th>
                                        <th>Tingkat</th>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Keluar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

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

@push('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            responsive : true,
            processing : false,
            serverSide : true,
            ajax : {
                url : '{!! route('absensis.ajax.datatable') !!}',
            },
            columns : [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'siswa', name: 'siswa', orderable: true, searchable: true},
                {data: 'jurusan', name: 'jurusan', orderable: true, searchable: true},
                {data: 'tingkat', name: 'tingkat', orderable: true, searchable: true},
                {data: 'tanggal', name: 'tanggal', orderable: false, searchable: false},
                {data: 'masuk', name: 'masuk', orderable: false, searchable: false},
                {data: 'keluar', name: 'keluar', orderable: false, searchable: false},
                {data: 'status', name: 'status', orderable: false, searchable: false},
            ]
        });

        // Set interval for reloading the data
        setInterval(function(){
            table.ajax.reload(null, false); // User paging is not reset on reload
        }, 1000); // 30000 milliseconds = 30 seconds
    });
</script>
@endpush
