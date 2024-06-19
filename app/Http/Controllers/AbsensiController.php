<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:view absensi', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.absensi.index');
    }

    public function datatable()
{
    $absensi = Absensi::with(['siswa.jurusan', 'siswa.tingkat'])
                      ->where('tanggal', Carbon::now()->format('Y-m-d'))
                      ->orderBy('created_at', 'DESC')
                      ->get();

    return DataTables::of($absensi)
        ->addIndexColumn()
        ->addColumn('siswa', function($data) {
            return $data->siswa ? $data->siswa->nama : 'N/A';
        })
        ->addColumn('jurusan', function($data) {
            return $data->siswa && $data->siswa->jurusan ? $data->siswa->jurusan->nama : 'N/A';
        })
        ->addColumn('tingkat', function($data) {
            return $data->siswa && $data->siswa->tingkat ? $data->siswa->tingkat->nama : 'N/A';
        })
        ->editColumn('keluar', function($data) {
            return empty($data->keluar) ? '-' : $data->keluar;
        })
        ->make(true);
}

}
