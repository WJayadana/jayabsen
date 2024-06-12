<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Device;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\Tingkat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $today = Carbon::now()->format('Y-m-d');
        $jurusanAktif = Jurusan::where('is_active', true)->count();
        $tingkatAktif = Tingkat::where('is_active', true)->count();
        $siswaAktif = Siswa::count();
        $deviceAktif = Device::where('is_active', true)->count();
        $jamMasuk = Absensi::where('tanggal', $today)->whereNotNull('masuk')->count();
        $jamKeluar = Absensi::where('tanggal', $today)->whereNotNull('keluar')->count();

        return view('website.dashboard.index')->with([
            'jurusanAktif' => $jurusanAktif,
            'tingkatAktif' => $tingkatAktif,
            'siswaAktif' => $siswaAktif,
            'deviceAktif' => $deviceAktif,
            'jamKeluar' => $jamMasuk,
            'jamMasuk' => $jamKeluar,
        ]);
    }
}
