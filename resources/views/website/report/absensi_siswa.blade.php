@extends('website.layouts.app', ['title' => 'absensi By Staff'])

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
                        <h1>Presence By Staff</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Presence By Staff</li>
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
                                <a href="{{ route('reports.siswa') }}" class="btn btn-success"><i
                                        class="fa fa-chevron-left"></i> Back</a>
                                <div class="card-title float-right">Detail Staff</div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Department</th>
                                            <th>Position</th>
                                            <th>Phone Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $siswa->nama }}</td>
                                            <td>
                                                @if ($siswa->jenis_kelamin == 1)
                                                    <span class='badge badge-success'>Male</span>
                                                @else
                                                    <span class='badge badge-danger'>Female</span>
                                                @endif

                                            </td>
                                            <td>{{ $siswa->jurusan->nama }}</td>
                                            <td>{{ $siswa->tingkat->nama }}</td>
                                            <td>{{ $siswa->nomor }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @canany(['export excel absensi by siswa', 'export pdf absensi by siswa'])
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Filter</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('reports.siswa.export', $siswa->id) }}" method="GET"
                                        target="_blank">
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col-4">
                                                <label for="">Start Date</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date"
                                                    onChange="datatable()" required>
                                            </div>
                                            <div class="col-4">
                                                <label for="">End Date</label>
                                                <input type="date" class="form-control" id="end_date" name="end_date"
                                                    onChange="datatable()" required>
                                            </div>
                                            @can('export excel absensi by siswa')
                                                <div class="col-1">
                                                    <label>&nbsp;</label>
                                                    <button class="btn btn-success btn-block" type="submit" value="excel"
                                                        name="submit"><i class="fa fa-file-excel"></i></button>
                                                </div>
                                            @endcan

                                            @can('export pdf absensi by siswa')
                                                <div class="col-1">
                                                    <label>&nbsp;</label>
                                                    <button class="btn btn-danger btn-block" type="submit" value="pdf"
                                                        name="submit"><i class="fa fa-file-pdf"></i></button>
                                                </div>
                                            @endcan
                                        </div>
                                    </form>
                                </div>

                            </div>
                        @endcanany
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="datatable" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Clock In</th>
                                            <th>Clock Out</th>
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
            datatable();
        });

        function datatable() {
            var route = '{!! route('reports.siswa.absensis.ajax.datatable', ':id') !!}';
            var link = route.replace(':id', "{{ request()->id }}");


            console.log($('#start_date').val());
            console.log($('#end_date').val());
            $('#datatable').DataTable().destroy();
            $('#datatable').DataTable({
                data: [{
                        "DT_RowIndex": 1,
                        "tanggal": "2021-01-01",
                        "masuk": "08:00",
                        "keluar": "17:00",
                        "status": "Present"
                    }
                    // more static data
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'masuk',
                        name: 'masuk'
                    },
                    {
                        data: 'keluar',
                        name: 'keluar'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                ]
            });

        }
    </script>
@endpush
