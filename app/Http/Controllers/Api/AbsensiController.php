<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Siswa;
use App\Models\Device;
use App\Models\Absensi;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kartu;

class AbsensiController extends Controller
{
    public function changeMode(Request $request)
    {
        $pengaturan = Pengaturan::first();
        $device = Device::find($request->device_id);

        if ($pengaturan->secret_key != $request->secret_key) {
            return "SECRET_KEY_TIDAK_DITEMUKAN";
        }

        if (!$device) {
            return "DEVICE_TIDAK_DITEMUKAN";
        }

        $device->update([
            'mode' => $device->mode == "1" ? "2" : "1"
        ]);

        return $device->mode == "1" ? "ABSENSI" : "PEMBACA_KARTU";
    }

    public function absensi(Request $request)
    {
        $pengaturan = Pengaturan::first();
        $device = Device::find($request->device_id);
        $siswa = Siswa::where('kode', $request->kartu)->first();

        if ($pengaturan->secret_key != $request->secret_key) {
            return "SECRET_KEY_TIDAK_DITEMUKAN";
        }

        if (!$device) {
            return "DEVICE_TIDAK_DITEMUKAN";
        }

        if ($device->mode == "2") {
            Kartu::updateOrCreate(['kode' => $request->kartu], ['kode' => $request->kartu]);
            return "KARTU_REGISTERED";
        } else {
            if (!$siswa) {
                // Tambahkan kartu ke tabel Kartu jika tidak ditemukan di tabel Siswa
                Kartu::updateOrCreate(['kode' => $request->kartu], ['kode' => $request->kartu]);
                return "KARTU_NOT_FOUND";
            }

            $presenceData = Absensi::where(['id_siswa' => $siswa->id, 'tanggal' => Carbon::now()->format('Y-m-d')])->first();

            $data = [
                'id_device' => $request->device_id,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'status' => 'masuk',
            ];

            $data[$pengaturan->mode] = empty($presenceData->{$pengaturan->mode}) ? Carbon::now()->format('H:i:s') : $presenceData->{$pengaturan->mode};

            $presence = Absensi::updateOrCreate([
                'id_siswa' => $siswa->id,
                'tanggal' => Carbon::now()->format('Y-m-d')
            ], $data);

            return $pengaturan->mode == "masuk" ? "ABSEN_MASUK_DISIMPAN" : "ABSEN_KELUAR_DISIMPAN";
        }
    }
}
