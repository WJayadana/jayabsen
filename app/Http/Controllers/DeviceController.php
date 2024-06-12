<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\DeviceRequest;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.device.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website.device.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeviceRequest $request)
    {
        Device::create($request->all());
        toastr('Device Berhasil Ditambah', 'success', 'Device', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('devices.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        return view('website.device.edit', compact('device'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeviceRequest $request, Device $device)
    {
        $device->update($request->all());
        toastr('Device Telah Diupdate', 'success', 'Device', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('devices.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        $device->delete();
        toastr('Device Berhasil Terhapus', 'success', 'Device', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('devices.index');
    }

    public function datatable()
    {
        $devices = Device::orderBy('created_at', 'DESC');

        return DataTables::of($devices)
            ->addIndexColumn()
            ->editColumn('mode', function($data) {
                return $data->mode == 1 ? "Absensi" : "Pembaca Kartu";
            })
            ->editColumn('is_active', function($data) {
                return $data->is_active == 1 ? "<span class='badge badge-success'>Aktif</span>" : "<span class='badge badge-danger'>Non-Aktif</span>";
            })
            ->addColumn('action', function($data){
                return '<a href="'.route('devices.edit', $data->id).'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> </a>
                        <button onclick="deleteConfirm(\''.$data->id.'\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        <form method="POST" action="'.route('devices.destroy', $data->id).'" style="display:inline-block;" id="submit_'.$data->id.'">
                            '.method_field('delete').csrf_field().'
                        </form>';
            })
            ->rawColumns(['action','is_active'])
            ->make(true);
    }
}
