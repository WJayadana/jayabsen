<?php

namespace App\Http\Controllers;

use App\Models\Kartu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KartuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.kartu.index');
    }

    public function destroy(Kartu $kartu)
    {
        $kartu->delete();
        toastr('Kartu Berhasil Dihapus', 'success', 'KARTU', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('kartus.index');
    }

    public function datatable()
    {
        $kartus = Kartu::orderBy('created_at', 'DESC');

        return DataTables::of($kartus)
            ->addIndexColumn()
            ->editColumn('is_active', function($data) {
                return $data->is_active == 0 ? "<span class='badge badge-success'>Ready To Use</span>" : "<span class='badge badge-danger'>Non-Aktif</span>";
            })
            ->addColumn('action', function($data){
                return '<button onclick="deleteConfirm(\''.$data->id.'\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        <form method="POST" action="'.route('kartus.destroy', $data->id).'" style="display:inline-block;" id="submit_'.$data->id.'">
                            '.method_field('delete').csrf_field().'
                        </form>';
            })
            ->rawColumns(['action','is_active'])
            ->make(true);
    }
}
