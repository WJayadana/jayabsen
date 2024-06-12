<?php

namespace App\Http\Controllers;

use App\Models\Kartu;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Tingkat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\SiswaRequest;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = Jurusan::where('is_active', true)->get();
        $tingkats = Tingkat::where('is_active', true)->get();
        $kartus = Kartu::all();

        return view('website.siswa.create', compact('jurusans', 'tingkats', 'kartus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SiswaRequest $request)
    {
        Siswa::create($request->all());
        Kartu::where('kode', $request->kode)->delete();

        toastr('Siswa Berhasil Ditambah', 'success', 'Siswa', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('siswa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return view('website.siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $jurusans = Jurusan::where('is_active', true)->get();
        $tingkats = Tingkat::where('is_active', true)->get();

        return view('website.siswa.edit', compact('siswa', 'jurusans', 'tingkats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SiswaRequest $request, Siswa $siswa)
    {
        $siswa->update($request->all());
        toastr('Siswa Telah Diubah', 'success', 'Siswa', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        toastr('Siswa Berhasil Dihapus', 'success', 'Siswa', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('siswa.index');
    }

    public function datatable()
    {
        $siswa = Siswa::with(['jurusan', 'tingkat'])->orderBy('created_at', 'DESC');

        return DataTables::of($siswa)
            ->addIndexColumn()
            ->editColumn('jenis_kelamin', function($data) {
                return $data->jenis_kelamin == 1 ? "<span class='badge badge-success'>Laki-Laki</span>" : "<span class='badge badge-danger'>Perempuan</span>";
            })
            ->editColumn('kode', function($data) {
                return $data->kode ? $data->kode : "<span class='badge badge-danger'>No rfid yet</span>";
            })
            ->addColumn('jurusan', function($data) {
                return $data->jurusan ? $data->jurusan->nama : 'N/A';
            })
            ->addColumn('tingkat', function($data) {
                return $data->tingkat ? $data->tingkat->nama : 'N/A';
            })
            ->addColumn('action', function($data){
                return '<a href="'.route('siswa.show', $data->id).'" class="btn btn-info btn-sm m-1"><i class="fas fa-th"></i> </a>
                        <a href="'.route('siswa.edit', $data->id).'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> </a>
                        <button onclick="deleteConfirm(\''.$data->id.'\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        <form method="POST" action="'.route('siswa.destroy', $data->id).'" style="display:inline-block;" id="submit_'.$data->id.'">
                            '.method_field('delete').csrf_field().'
                        </form>';
            })
            ->rawColumns(['action','jenis_kelamin', 'kode'])
            ->make(true);
    }
}
