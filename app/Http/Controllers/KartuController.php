<?php

namespace App\Http\Controllers;

use App\Models\Kartu;
use Illuminate\Http\Request;

class KartuController extends Controller
{
    public function index()
    {
        $kartus = Kartu::all();

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $kartus
        ]);
    }

    // Menyimpan kartu baru
    public function store(Request $request)
{
    $request->validate([
        'kode' => 'required|string|unique:kartus,kode|max:255',
    ]);

    // Debug: Log request data
    \Log::info('Request Data:', $request->all());

    $kartu = Kartu::create([
        'kode' => $request->kode, // Harus diisi
    ]);

    return response()->json([
        "author" => "Jayadana",
        "status" => 201,
        "jdata" => $kartu,
    ], 201);
}



    // Menampilkan detail kartu berdasarkan ID
    public function show($id)
    {
        $kartu = Kartu::find($id);

        if (!$kartu) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Kartu not found"]
            ], 404);
        }

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $kartu
        ]);
    }

    // Menghapus kartu
    public function destroy($id)
    {
        $kartu = Kartu::find($id);

        if (!$kartu) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Kartu not found"]
            ], 404);
        }

        $kartu->delete();

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => ["message" => "Kartu successfully deleted"]
        ]);
    }
}
