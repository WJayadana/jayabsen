<table>
    <tr>
        <th colspan="8" align="center">Laporan Absensi</th>
    </tr>
    <tr>
        <th colspan="8" align="center">Tanggal: {{ $startDate->translatedFormat('d F Y') }} - {{ $endDate->translatedFormat('d F Y') }}</th>
    </tr>
    <tr>
        <td>Nama</td>
        <td colspan="7">{{ $siswa->nama }}</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td colspan="7">{{ $siswa->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan' }}</td>
    </tr>
    <tr>
        <td>Jurusan</td>
        <td colspan="7">{{ $siswa->jurusan->nama }}</td>
    </tr>
    <tr>
        <td>Tingkat</td>
        <td colspan="7">{{ $siswa->tingkat->nama }}</td>
    </tr>
    <tr>
        <td>Nomor Hp</td>
        <td colspan="7">{{ $siswa->nomor }}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td colspan="7">{{ $siswa->alamat }}</td>
    </tr>
    <tr>
        <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
        <th width="20">No</th>
        <th width="20">Tanggal</th>
        <th width="20">Masuk</th>
        <th width="20">Keluar</th>
        <th width="20">Total Waktu Disekolah</th>
    </tr>
    @foreach ($absensis as $index => $absensi)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->translatedFormat('d F Y') }}</td>
            <td>{{ empty($absensi->masuk) ? '-' : \Carbon\Carbon::parse($absensi->masuk)->format('H:i') }}</td>
            <td>{{ empty($absensi->keluar) ? '-' : \Carbon\Carbon::parse($absensi->keluar)->format('H:i') }}</td>
            <td>{{ $absensi->work_duration }}</td>
        </tr>
    @endforeach
</table>
