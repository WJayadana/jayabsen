<?php

namespace App\Http\Controllers;

use App\Models\Tingkat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\TingkatRequest;

class TingkatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.tingkat.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website.tingkat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TingkatRequest $request)
    {
        Tingkat::create($request->all());
        toastr('Tingkat Berhasil Dibuat', 'success', 'Tingkat', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('tingkats.index');
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
    public function edit(Tingkat $tingkat)
    {
        return view('website.tingkat.edit', compact('tingkat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TingkatRequest $request, Tingkat $tingkat)
    {
        $tingkat->update($request->all());
        toastr('Tingkat Berhasil Diupdate', 'success', 'Tingkat', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('tingkats.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tingkat $tingkat)
    {
        $tingkat->delete();
        toastr('Tingkat Berhasil Dihapus', 'success', 'Tingkat', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('tingkats.index');
    }

    public function datatable()
    {
        $tingkats = Tingkat::orderBy('created_at', 'DESC');

        return DataTables::of($tingkats)
            ->addIndexColumn()
            ->editColumn('is_active', function($data) {
                return $data->is_active == 1 ? "<span class='badge badge-success'>Aktif</span>" : "<span class='badge badge-danger'>Non-Aktif</span>";
            })
            ->addColumn('action', function($data){
                return '<a href="'.route('tingkats.edit', $data->id).'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> </a>
                        <button onclick="deleteConfirm(\''.$data->id.'\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        <form method="POST" action="'.route('tingkats.destroy', $data->id).'" style="display:inline-block;" id="submit_'.$data->id.'">
                            '.method_field('delete').csrf_field().'
                        </form>';
            })
            ->rawColumns(['action','is_active'])
            ->make(true);
    }
}
