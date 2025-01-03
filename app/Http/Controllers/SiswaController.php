<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\Tingkat;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // Get all records
    public function index()
    {
        $siswa = Siswa::with(['jurusan', 'tingkat'])->get();
        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $siswa,
        ], 200);
    }
    // Create a new record
    public function store(Request $request)
    {
        $request->validate([
            'id_jurusan' => 'required|exists:jurusans,id',
            'id_tingkat' => 'required|exists:tingkats,id',
            'kode' => 'nullable|string|max:255|unique:siswas,kode', // Validasi unik kode siswa
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|integer|in:0,1',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nomor' => 'required|string|max:15',
            'start_date' => 'required|date',
        ]);

        // Cek jika siswa dengan kode yang sama sudah ada
        $existingSiswa = Siswa::where('kode', $request->kode)->first();

        if ($existingSiswa) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 409, // Conflict
                "jdata" => ["message" => "Siswa dengan kode tersebut sudah ada."]
            ], 409);
        }

        // Simpan siswa baru
        $siswa = Siswa::create($request->all());


        return response()->json([
            "author" => "Jayadana",
            "status" => 201,
            "jdata" => $siswa,
        ], 201);
    }

    // Update a record
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Siswa not found"],
            ], 404);
        }

        $request->validate([
            'id_jurusan' => 'sometimes|required|exists:jurusans,id',
            'id_tingkat' => 'sometimes|required|exists:tingkats,id',
            'kode' => 'nullable|string|max:255',
            'nama' => 'sometimes|required|string|max:255',
            'jenis_kelamin' => 'sometimes|required|integer|in:0,1',
            'tanggal_lahir' => 'sometimes|required|date',
            'alamat' => 'sometimes|required|string',
            'nomor' => 'sometimes|required|string|max:15',
            'start_date' => 'sometimes|required|date',
        ]);

        $oldTingkatId = $siswa->id_tingkat;
        $oldJurusanId = $siswa->id_jurusan;

        $siswa->update($request->all());



        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $siswa,
        ], 200);
    }

    // Delete a record
    public function destroy($id)
{
    // Cari Siswa berdasarkan ID
    $siswa = Siswa::find($id);

    // Jika Siswa tidak ditemukan
    if (!$siswa) {
        return response()->json([
            "author" => "Jayadana",
            "status" => 404,
            "jdata" => ["message" => "Siswa tidak ditemukan"]
        ], 404);
    }

    // Ambil data Tingkat dan Jurusan yang terkait dengan Siswa
    $tingkat = $siswa->tingkat; // Mengambil relasi tingkat
    $jurusan = $siswa->jurusan; // Mengambil relasi jurusan


    // Hapus Siswa yang bersangkutan
    $siswa->delete();

    return response()->json([
        "author" => "Jayadana",
        "status" => 200,
        "jdata" => ["message" => "Siswa berhasil dihapus"]
    ], 200);
}

}
