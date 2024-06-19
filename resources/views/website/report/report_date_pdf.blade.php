<html>
  <head>
    <title>Laporan Absensi {{ $tanggal->translatedFormat('d F Y') }}</title>
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
    <div class="title">
      <h3>Laporan Absensi</h3>
      <p>Tanggal : {{ $tanggal->translatedFormat('d F Y') }}</p>
    </div>
    <table width="100%" border="1">
      <thead>
        <tr style="background-color:rgb(255, 192,0);">
          <th>NO</th>
          <th width="20%">Nama</th>
          <th>Jurusan</th>
          <th>Tingkat</th>
          <th>Date</th>
          <th>Clock In</th>
          <th>Clock Out</th>
          <th>Work Duration</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($absensis as $index => $absensi)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{  $absensi->siswa->nama }}</td>
            <td>{{ $absensi->siswa->jurusan->nama }}</td>
            <td>{{ $absensi->siswa->tingkat->nama }}</td>
            <td>{{ $absensi->tanggal }}</td>
            <td>{{ empty($absensi->masuk) ? '-' : $absensi->masuk }}</td>
            <td>{{ empty($absensi->keluar) ? '-' : $absensi->keluar }}</td>
            <td>{{ $absensi->work_duration }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
