<html>
  <head>
    <title>Presence Report {{ $startDate->translatedFormat('d F Y') }} - {{ $endDate->translatedFormat('d F Y') }}</title>
    <style>
      table {
        border-collapse: collapse;
        font-size:12px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      table td {
        padding:5px;
      }
      table th {
        padding:5px;
      }

      .title {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-align:center;
      }

      p {
        font-size:14px;
      }
    </style>
  </head>
  <body>
    <img src="assets/dist/img/antawa-dark.png" alt="" width="100px" style="position: absolute; margin-top:-20px;">
    <div class="title">
      <h2>Jayadana.id</h2>
      <p>Desa S.Kertosari, Kec. Purwodadi, Kab.Musirawas, Sumatera Selatan 31668</p>
      <p>No Telp: +62 851-6282-2778 Email: wjayadana@gmail.com</p>
    </div>
    <hr>
    <table>
      <tr>
          <td>Nama</td>
          <td>:</td>
          <td>{{ $siswa->nama }}</td>
      </tr>
      <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>{{ $siswa->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan' }}</td>
      </tr>
      <tr>
        <td>Jurusan</td>
        <td>:</td>
        <td>{{ $siswa->jurusan->nama }}</td>
      </tr>
      <tr>
        <td>Tingkat</td>
        <td>:</td>
        <td>{{ $siswa->tingkat->nama }}</td>
      </tr>
      <tr>
        <td>Nomor</td>
        <td>:</td>
        <td>{{ $siswa->nomor }}</td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{ $siswa->alamat }}</td>
      </tr>
    </table>
    <div class="title">
      <h3>Laporan Absensi</h3>
      <p>Tangal : {{ $startDate->translatedFormat('d F Y') }} - {{ $endDate->translatedFormat('d F Y') }}</p>
    </div>
    <table width="100%" border="1">
      <thead>
        <tr style="background-color:rgb(255, 192,0);">
          <th>No</th>
          <th>Tanggal</th>
          <th>Mausk</th>
          <th>Keluar</th>
          <th>Total Waktu Disekolah</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($absensis as $index => $absensi)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->translatedFormat('d F Y') }}</td>
            <td>{{ empty($absensi->masuk) ? '-' : \Carbon\Carbon::parse($absensi->masuk)->format('H:i') }}</td>
            <td>{{ empty($absensi->keluar) ? '-' : \Carbon\Carbon::parse($absensi->keluar)->format('H:i') }}</td>
            <td>{{ $absensi->work_duration }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
