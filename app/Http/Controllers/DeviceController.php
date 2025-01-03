<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $devices
        ]);
    }

    // Menyimpan perangkat baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'mode' => 'required|string|in:reader,add_card', // Validasi mode
            'is_active' => 'required|integer|in:0,1', // Validasi is_active
        ]);

        $device = Device::create($request->all());

        return response()->json([
            "author" => "Jayadana",
            "status" => 201,
            "jdata" => $device
        ], 201);
    }

    // Menampilkan perangkat berdasarkan ID
    public function show($id)
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Device not found"]
            ], 404);
        }

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $device
        ]);
    }

    // Memperbarui data perangkat berdasarkan ID
    public function update(Request $request, $id)
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Device not found"]
            ], 404);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'mode' => 'required|string|in:reader,add_card',
            'is_active' => 'required|integer|in:0,1',
        ]);

        $device->update($request->all());

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $device
        ]);
    }

    // Menghapus perangkat berdasarkan ID
    public function destroy($id)
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Device not found"]
            ], 404);
        }

        // Hapus perangkat secara permanen
        $device->delete();

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => ["message" => "Device successfully deleted"]
        ]);
    }
}
