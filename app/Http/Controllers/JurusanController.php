<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;

use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::all();
        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $jurusan,
        ], 200);
    }

    // Get a single record
    public function show($id)
    {
        $jurusan = Jurusan::find($id);

        if (!$jurusan) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Jurusan tidak ditemukan"],
            ], 404);
        }

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $jurusan,
        ], 200);
    }

    // Create a new record
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $jurusan = Jurusan::create($request->all());

        return response()->json([
            "author" => "Jayadana",
            "status" => 201,
            "jdata" => $jurusan,
        ], 201);
    }

    // Update a record
    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::find($id);

        if (!$jurusan) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Jurusan tidak ditemukan"],
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'is_active' => 'sometimes|required|boolean',
        ]);

        $jurusan->update($request->all());

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $jurusan,
        ], 200);
    }

    // Delete a record
    public function destroy($id)
    {
        $jurusan = Jurusan::find($id);

        if (!$jurusan) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Jurusan tidak ditemukan"],
            ], 404);
        }

        $jurusan->delete();

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => ["message" => "Jurusan dihapus"],
        ], 200);
    }
}
