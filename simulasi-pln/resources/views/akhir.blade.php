<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hasil Simulasi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 40px;
      background-color: #f4f4f4;
      color: #333;
    }

    h1 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 30px;
    }

    .section {
      background-color: #fff;
      padding: 25px;
      margin-bottom: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      border-radius: 8px;
    }

    h2 {
      color: #34495e;
      border-bottom: 2px solid #ddd;
      padding-bottom: 8px;
      margin-bottom: 15px;
    }

    ul {
      margin-left: 20px;
    }

    li {
      margin-bottom: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: left;
    }

    th {
      background-color: #ecf0f1;
    }

    .nav-buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 40px;
    }

    .nav-buttons button {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #2c3e50;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .nav-buttons button:hover {
      background-color: #1a242f;
    }

    footer {
      text-align: center;
      margin-top: 50px;
      font-size: 0.9em;
      color: #777;
    }

    /* Gaya khusus saat cetak */
    @media print {
      body {
        background-color: white;
        padding: 0;
        color: black;
      }

      .nav-buttons, footer {
        display: none;
      }

      .section {
        box-shadow: none;
        border: 1px solid #ccc;
        margin-bottom: 20px;
      }

      h1 {
        font-size: 24px;
        margin-bottom: 20px;
      }

      h2 {
        font-size: 18px;
      }
    }
  </style>
</head>
<body>

  <h1>Hasil Simulasi Penyambungan</h1>

  <!-- Data Simulasi -->
  <div class="section">
    <h2>Informasi Pelanggan & Data PLN</h2>
    <ul>
      <li>Nama: Ahmad Setiawan</li>
      <li>Nomor Meter: 1234567890</li>
      <li>Daya: 1300 VA, 1 Phase</li>
      <li>Alamat: Jl. Melati No. 45, Jakarta</li>
    </ul>
    <table>
      <thead>
        <tr>
          <th>Parameter</th>
          <th>Nilai</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>Tegangan</td><td>220 V</td><td>Normal</td></tr>
        <tr><td>Arus</td><td>5.4 A</td><td>Stabil</td></tr>
        <tr><td>Frekuensi</td><td>50 Hz</td><td>Normal</td></tr>
      </tbody>
    </table>
  </div>

  <!-- Hasil Simulasi -->
  <div class="section">
    <h2>Hasil Simulasi</h2>
    <ul>
      <li>Status: <strong>Berhasil</strong></li>
      <li>Kabel Fasa, Netral, dan Ground tersambung dengan benar.</li>
      <li>Indikator menyala: Listrik aktif.</li>
    </ul>
    <table>
      <thead>
        <tr><th>Langkah</th><th>Keterangan</th><th>Status</th></tr>
      </thead>
      <tbody>
        <tr><td>1</td><td>Sambung kabel fasa ke input</td><td>OK</td></tr>
        <tr><td>2</td><td>Sambung kabel netral ke terminal</td><td>OK</td></tr>
        <tr><td>3</td><td>Ground tersambung ke proteksi</td><td>OK</td></tr>
        <tr><td>4</td><td>Simulasi dijalankan</td><td>Sukses</td></tr>
      </tbody>
    </table>
  </div>

  <!-- Tombol -->
  <div class="nav-buttons">
    <button onclick="window.location.href='index.html'">🏠 Halaman Utama</button>
    <button onclick="window.print()">🖨️ Print Hasil</button>
    <button onclick="window.location.href='simulasi.html'">🔁 Ulangi Simulasi</button>
  </div>

  <footer>
    &copy; 2025 Simulasi Meteran PLN | Proyek Informatika
  </footer>

</body>
</html>
