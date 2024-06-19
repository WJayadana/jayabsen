<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiDateExport;
use App\Exports\AbsensiSiswaExcel;
use Carbon\Carbon;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->middleware('permission:view absensi by date', ['only' => ['reportDate']]);
        $this->middleware('permission:view absensi by siswa', ['only' => ['reportSiswa']]);
        $this->excel = $excel;
    }

    public function reportDate()
    {
        return view('website.report.date');
    }

    public function reportDateDatatable(Request $request)
    {
        $prensences = Absensi::query();
        if (isset($request->date) && !empty($request->date)) $prensences->where('tanggal', $request->date);
        $prensences->with(['siswa', 'siswa.jurusan', 'siswa.tingkat'])->orderBy('tanggal', 'DESC');

        return DataTables::of($prensences)
            ->addIndexColumn()
            ->editColumn('keluar', function ($data) {
                return empty($data->keluar) ? '-' : $data->keluar;
            })
            ->make(true);
    }

    public function reportDateExport(Request $request)
    {
        $date = Carbon::parse($request->date);
        $absensis = Absensi::where('tanggal', $request->date)->with(['siswa', 'siswa.jurusan', 'siswa.tingkat'])->orderBy('tanggal', 'DESC')->get();

        if ($request->submit == "pdf") {
            $pdf = Pdf::loadView('website.report.report_date_pdf', ['absensis' => $absensis, 'tanggal' => $date])->setPaper('a4', 'landscape');
            return $pdf->stream();
        }

        if ($request->submit == "excel") {
            return $this->excel->download(new AbsensiDateExport($absensis, $date), 'laporan_absensi' . $date->format('d_F_Y') . '.xlsx');
        }
    }

    public function reportSiswa()
    {
        return view('website.report.siswa');
    }

    public function siswaDatatable()
    {
        $siswa = Siswa::with(['jurusan', 'tingkat'])->orderBy('created_at', 'DESC');

        return DataTables::of($siswa)
            ->addIndexColumn()
            ->editColumn('jenis_kelamin', function ($data) {
                return $data->jenis_kelamin == 1 ? "<span class='badge badge-success'>Male</span>" : "<span class='badge badge-danger'>Female</span>";
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('reports.siswa.absensi', $data->id) . '" class="btn btn-info btn-sm"><i class="fas fa-th"></i></a>';
            })
            ->rawColumns(['action', 'jenis_kelamin', 'kode'])
            ->make(true);
    }

    public function absensiSiswa($id)
    {
        $siswa = Siswa::with(['jurusan', 'tingkat'])->find($id);
        return view('website.report.absensi_siswa', compact('siswa'));
    }

    public function siswaPresenceDatatable(Request $request, $id)
    {
        $absensis = Absensi::query();
        if (!empty($request->start_date) && !empty($request->end_date)) $absensis->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        $absensis->where('id_siswa', $id)->orderBy('tanggal', 'DESC');

        return DataTables::of($absensis)
            ->addIndexColumn()
            ->editColumn('keluar', function ($data) {
                return empty($data->keluar) ? '-' : $data->keluar;
            })
            ->make(true);
    }


    public function reportSiswaExport(Request $request, $id)
    {
        $siswa = Siswa::with(['jurusan', 'tingkat'])->find($id);
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $absensis = Absensi::where('id_siswa', $id)->whereBetween('tanggal', [$request->start_date, $request->end_date])->orderBy('tanggal', 'DESC')->get();

        if ($request->submit == "pdf") {
            $pdf = Pdf::loadView('website.report.report_siswa_pdf', ['absensis' => $absensis, 'startDate' => $startDate, 'endDate' => $endDate, 'siswa' => $siswa])->setPaper('a4', 'landscape');

            return $pdf->stream();
        }

        if ($request->submit == "excel") {
            return $this->excel->download(new AbsensiSiswaExcel($absensis, $startDate, $endDate, $siswa), 'laporan_absensi' . $siswa->nama . '.xlsx');
        }
    }
}
