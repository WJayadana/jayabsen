@extends('website.layouts.app', ['title' => 'Report By Staff'])

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
          <h1>Report By Staff</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Report By Staff</li>
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
            <!-- /.card-header -->
            <div class="card-body">
              <table id="datatable" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Departement</th>
                  <th>Position</th>
                  <th>Phone Number</th>
                  <th>Action</th>
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
    $('#datatable').DataTable({
      responsive    : true,
      processing    : true,
      serverSide    : true,
      ajax          : {
          url     : '{!! route('reports.siswa.ajax.datatable') !!}',
      },
      columns       : [
          {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'nama', name: 'nama', orderable: true, searchable: true},
          {data: 'jenis_kelamin', name: 'jenis_kelamin', orderable: true, searchable: true},
          {data: 'jurusan.nama', name: 'jurusan.nama', orderable: true, searchable: true},
          {data: 'tingkat.nama', name: 'tingkat.nama', orderable: true, searchable: true},
          {data: 'nomor', name: 'nomor', orderable: true, searchable: true},
          {data: 'action', name: 'action', orderable: false, searchable: false,}
      ]
    });
  });

  function deleteConfirm(id) {
    Swal.fire({
      text: "Are you sure you want to delete data ?",
      type: 'warning',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete'
      }).then((result) => {
      if (result.value) {
        $('#submit_'+id).submit();
        Swal.fire(
        'Deleted!',
        'Staff data deleted',
        'success'
          )
      }
    })
  }
</script>
@endpush
