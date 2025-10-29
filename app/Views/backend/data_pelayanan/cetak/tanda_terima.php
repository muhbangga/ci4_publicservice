<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Print Layout Instansi</title>
  <style>
    /* Gaya untuk halaman cetak */
    @media print {
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
      }

      .container {
        width: 100%;
        padding: 20px;
      }

      .header,
      .footer {
        text-align: center;
        margin-bottom: 20px;
      }

      .header img {
        max-width: 80px;
        margin-bottom: 10px;
      }

      .header h1 {
        font-size: 18px;
        margin: 0;
      }

      .header p {
        margin: 0;
        font-size: 14px;
      }

      .content {
        margin: 20px 0;
      }

      .content h2 {
        font-size: 16px;
        text-align: center;
        margin-bottom: 15px;
      }

      .content p {
        font-size: 14px;
        line-height: 1.6;
      }

      .footer {
        border-top: 1px solid #333;
        padding-top: 10px;
        font-size: 12px;
      }
    }
  </style>
</head>


<body onload="window.print()"> <!-- Memanggil window.print() saat halaman dimuat -->
  <div class="container">


    <!-- Konten yang ingin dicetak -->
    <div class="header">
      <h1>Instansi ABC</h1>
      <p>Alamat Instansi, Kota, Kode Pos</p>
    </div>

    <div class="content">
      <h2>Data Detail</h2>
      <p><strong>Nama:</strong> <?= $pelayanan['nama_lengkap'] ?></p>

      <!-- Tambahkan data lainnya sesuai kebutuhan -->
    </div>

    <div class="footer">
      <p>© 2024 Instansi ABC. Semua Hak Dilindungi.</p>
      <p>Dicetak pada: <?= date('d-m-Y') ?></p>
    </div>
  </div>
</body>


</html>