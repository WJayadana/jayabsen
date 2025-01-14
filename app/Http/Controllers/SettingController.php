<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $settings
        ]);
    }

    // Menyimpan pengaturan baru dengan secret_key otomatis
    public function store(Request $request)
    {
        $request->validate([
            'mode' => 'required|string|in:clock_in,clock_out',
        ]);

        $setting = Setting::create([
            'mode' => $request->mode,
            'secret_key' => Str::random(32), // Generate random secret key
        ]);

        return response()->json([
            "author" => "Jayadana",
            "status" => 201,
            "jdata" => $setting
        ], 201);
    }

    // Menampilkan pengaturan berdasarkan ID
    public function show($id)
    {
        $setting = Setting::find($id);

        if (!$setting) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Setting tidak ditemukan"]
            ], 404);
        }

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $setting
        ]);
    }

    // Memperbarui hanya mode pengaturan
    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);

        if (!$setting) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Setting tidak ditemukan"]
            ], 404);
        }

        $request->validate([
            'mode' => 'required|string|in:clock_in,clock_out',
        ]);

        $setting->update([
            'mode' => $request->mode,
        ]);

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $setting
        ]);
    }

    // Menghapus pengaturan berdasarkan ID
    public function destroy($id)
    {
        $setting = Setting::find($id);

        if (!$setting) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Setting tidak ditemukan"]
            ], 404);
        }

        $setting->delete();

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => ["message" => "Setting dihapus"]
        ]);
    }
    // Re-generate secret_key
    public function regenerateSecretKey($id)
    {
        $setting = Setting::find($id);

        if (!$setting) {
            return response()->json([
                "author" => "Jayadana",
                "status" => 404,
                "jdata" => ["message" => "Setting tidak ditemukan"]
            ], 404);
        }

        // Generate secret_key baru
        $setting->update([
            'secret_key' => Str::random(32),
        ]);

        return response()->json([
            "author" => "Jayadana",
            "status" => 200,
            "jdata" => $setting
        ]);
    }
}
