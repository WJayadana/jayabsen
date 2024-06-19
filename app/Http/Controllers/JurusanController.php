<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\JurusanRequest;

class JurusanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view jurusan|create jurusan|edit jurusan|delete jurusan', ['only' => ['index']]);
        $this->middleware('permission:create jurusan', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit jurusan', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete jurusan', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.jurusan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JurusanRequest $request)
    {
        Jurusan::create($request->all());
        toastr('Jurusan Berhasil Dibuat', 'success', 'Jurusan', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('jurusans.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        return view('website.jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JurusanRequest $request, Jurusan $jurusan)
    {
        $jurusan->update($request->all());
        toastr('Jurusan Telah Diupdate', 'success', 'Jurusan', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('jurusans.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        toastr('Jurusan Berhasil Dihapus', 'success', 'Jurusan', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('jurusans.index');
    }

    public function datatable()
    {
        $jurusan = Jurusan::orderBy('created_at', 'DESC');

        return DataTables::of($jurusan)
            ->addIndexColumn()
            ->editColumn('is_active', function($data) {
                return $data->is_active == 1 ? "<span class='badge badge-success'>Aktif</span>" : "<span class='badge badge-danger'>Non-Aktif</span>";
            })
            ->addColumn('action', function($data){
                return '<a href="'.route('jurusans.edit', $data->id).'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> </a>
                        <button onclick="deleteConfirm(\''.$data->id.'\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        <form method="POST" action="'.route('jurusans.destroy', $data->id).'" style="display:inline-block;" id="submit_'.$data->id.'">
                            '.method_field('delete').csrf_field().'
                        </form>';
            })
            ->rawColumns(['action','is_active'])
            ->make(true);
    }
}
