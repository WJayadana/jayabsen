<?php

namespace App\Http\Controllers;

use App\Models\Tingkat;
use Illuminate\Http\Request;

class TingkatController extends Controller
{

    public function index()
    {
        $tingkat = Tingkat::all();
        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $tingkat,
        ], 200);
    }

    // Get a single record
    public function show($id)
    {
        $tingkat = Tingkat::find($id);

        if (!$tingkat) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Tingkat not found"],
            ], 404);
        }

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $tingkat,
        ], 200);
    }

    // Create a new record
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $tingkat = Tingkat::create($request->all());

        return response()->json([
            "author" => "Jayadana",
            "status" => 201,
            "jdata" => $tingkat,
        ], 201);
    }

    // Update a record
    public function update(Request $request, $id)
    {
        $tingkat = Tingkat::find($id);

        if (!$tingkat) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Tingkat not found"],
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'is_active' => 'sometimes|required|boolean',
        ]);

        $tingkat->update($request->all());

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $tingkat,
        ], 200);
    }

    // Delete a record
    public function destroy($id)
    {
        $tingkat = Tingkat::find($id);

        if (!$tingkat) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Tingkat not found"],
            ], 404);
        }

        $tingkat->delete();

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => ["message" => "Tingkat deleted"],
        ], 200);
    }
}
