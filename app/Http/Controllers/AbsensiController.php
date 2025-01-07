<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::with(['siswa', 'device'])->get();
        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $absensi]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|exists:siswas,id',
            'id_device' => 'required|exists:devices,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i',
            'status' => 'required|in:present,absent,alpha,izin,sakit',
        ]);

        $absensi = Absensi::create($validatedData);

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $absensi], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $absensi = Absensi::with(['siswa', 'device'])->find($id);

        if (!$absensi) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 200,
                "message" => "Kartu successfully deleted"], 404);
        }

        return response()->json($absensi, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $absensi = Absensi::find($id);

        if (!$absensi) {
            return response()->json(['message' => 'Absensi not found'], 404);
        }

        $absensi->delete();

        return response()->json(['message' => 'Absensi deleted'], 200);
    }
}
