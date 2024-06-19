<table>
    <tr>
      <th colspan="8" align="center">Laporan Absensi</th>
    </tr>
    <tr>
      <th colspan="8" align="center">Tanggal: {{ $date->format('d F Y') }}</th>
    </tr>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Jurusan</th>
      <th>Tingkat</th>
      <th>Tanggal</th>
      <th>Jam Masuk</th>
      <th>Jam Keluar</th>
      <th>Total Waktu Disekolah</th>
    </tr>
    @foreach ($absensis as $index => $absensi)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td width="20">{{ $absensi->siswa->nama }}</td>
        <td width="20">{{ $absensi->siswa->jurusan->nama }}</td>
        <td width="20">{{ $absensi->siswa->tingkat->nama }}</td>
        <td width="20">{{ $absensi->tanggal }}</td>
        <td width="20">{{ empty($absensi->masuk) ? '-' : $absensi->masuk }}</td>
        <td width="20">{{ empty($absensi->keluar) ? '-' : $absensi->keluar }}</td>
        <td width="20">{{ $absensi->work_duration }}</td>
      </tr>
    @endforeach
  </table>
