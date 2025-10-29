<?= $this->extend('backend/theme/template') ?>
<?= $this->section('content') ?>


<div class="page-heading">
  <h3><?= $title ?></h3>

  <div class="page-content">
    <section>
      <div class="row">
        <div class="col-lg-3">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row d-flex justify-content-start">
                <div class="col-md-5 ">
                  <div class="stats-icon purple mb-2">
                    <i class="iconly-boldShow"></i>
                  </div>
                </div>
                <div class="col-md-7">
                  <h6 class="text-muted font-semibold">Pengelola</h6>
                  <h6 class="font-extrabold mb-0"><?= $count_seksi ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row d-flex justify-content-start">
                <div class="col-md-5 ">
                  <div class="stats-icon blue mb-2">
                    <i class="iconly-boldProfile"></i>
                  </div>
                </div>
                <div class="col-md-7">
                  <h6 class="text-muted font-semibold">Layanan</h6>
                  <h6 class="font-extrabold mb-0"><?= $count_layanan ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row d-flex justify-content-start">
                <div class="col-md-5 ">
                  <div class="stats-icon green mb-2 ">
                    <i class="iconly-boldAdd-User"></i>
                  </div>
                </div>
                <div class="col-md-7">
                  <h6 class="text-muted font-semibold">Pelayanan</h6>
                  <h6 class="font-extrabold mb-0"><?= $count_pelayanan ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php if (in_groups('Admin')) { ?>
          <div class="col-lg-3">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row d-flex justify-content-start">
                  <div class="col-md-5 ">
                    <div class="stats-icon red mb-2">
                      <i class="iconly-boldBookmark"></i>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <h6 class="text-muted font-semibold">Pengguna</h6>
                    <h6 class="font-extrabold mb-0"><?= $count_users ?></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } else { ?>
          <div class="col-lg-3">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row d-flex justify-content-start">
                  <div class="col-md-5 ">
                    <div class="stats-icon red mb-2">
                      <i class="iconly-boldBookmark"></i>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <h6 class="text-muted font-semibold">Pengguna</h6>
                    <h6 class="font-extrabold mb-0"><?= $count_ptsp ?></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="container">

              </div>
              <!-- Container untuk Chart -->
              <div id="bar"></div>
              <div id="penilaianChart"></div>


              <script>
                // Data Penilaian (dari PHP)
                const penilaianData = <?php echo json_encode($penilaian); ?>;

                // Menghitung jumlah penilaian
                const penilaianCount = [0, 0, 0, 0, 0]; // Angka untuk penilaian 1 sampai 5
                penilaianData.forEach(item => {
                  const penilaian = item.penilaian; // Nilai penilaian
                  if (penilaian >= 1 && penilaian <= 5) {
                    penilaianCount[penilaian - 1]++; // Menambahkan count berdasarkan nilai penilaian
                  }
                });

                // Menghitung total penilaian
                const totalPenilaian = penilaianCount.reduce((a, b) => a + b, 0);

                // Menghitung persentase untuk setiap kategori
                const persentasePenilaian = penilaianCount.map(count => {
                  return totalPenilaian > 0 ? (count / totalPenilaian) * 100 : 0;
                });

                // Menentukan warna untuk setiap kategori
                const warnaKategori = ['#d90429', '#ef233c', '#FFC300', '#38b000', '#006400'];

                // Konfigurasi ApexCharts
                var options = {
                  chart: {
                    type: 'bar',
                    height: 350
                  },
                  series: [{
                    name: 'Penilaian (%)',
                    data: persentasePenilaian,
                    color: function({
                      dataPointIndex
                    }) {
                      return warnaKategori[dataPointIndex];
                    }
                  }],
                  xaxis: {
                    categories: ['Sangat Tidak Puas', 'Tidak Puas', 'Netral', 'Puas', 'Sangat Puas'],
                  },
                  title: {
                    text: 'Penilaian Pelayanan (Dalam Persen)',
                    align: 'center'
                  },
                  yaxis: {
                    labels: {
                      formatter: function(value) {
                        return value.toFixed(2) + '%';
                      }
                    }
                  },
                  dataLabels: {
                    enabled: true,
                    formatter: function(value, {
                      dataPointIndex
                    }) {
                      return value.toFixed(2) + '%'; // Menampilkan persen & jumlah asli
                    },
                    style: {
                      fontSize: '14px',
                      fontWeight: 'bold',
                      colors: ['#ffffff']
                    }
                  },
                  tooltip: {
                    y: {
                      formatter: function(value, {
                        dataPointIndex
                      }) {
                        return value.toFixed(2) + '%';
                      }
                    }
                  }
                };

                // Membuat grafik menggunakan ApexCharts
                var chart = new ApexCharts(document.querySelector("#penilaianChart"), options);
                chart.render();
              </script>

              <!-- <script>
                // Data Penilaian (dari PHP)
                const penilaianData = ;

                // Menghitung jumlah penilaian
                const penilaianCount = [0, 0, 0, 0, 0]; // Angka untuk penilaian 1 sampai 5
                penilaianData.forEach(item => {
                  const penilaian = item.penilaian; // Nilai penilaian
                  if (penilaian >= 1 && penilaian <= 5) {
                    penilaianCount[penilaian - 1]++; // Menambahkan count berdasarkan nilai penilaian
                  }
                });

                // Menghitung total penilaian
                const totalPenilaian = penilaianCount.reduce((a, b) => a + b, 0); // Menjumlahkan semua kategori penilaian

                // Menghitung persentase untuk setiap kategori
                const persentasePenilaian = penilaianCount.map(count => {
                  return totalPenilaian > 0 ? (count / totalPenilaian) * 100 : 0; // Menghitung persen, jika total > 0
                });

                // Menentukan warna untuk setiap kategori
                const warnaKategori = ['#d90429', '#ef233c', '#FFC300', '#38b000', '#006400']; // Warna untuk setiap kategori

                // Konfigurasi ApexCharts
                var options = {
                  chart: {
                    type: 'bar', // Jenis grafik: bar chart
                    height: 350
                  },
                  series: [{
                    name: 'Penilaian (%)',
                    data: persentasePenilaian, // Data yang ditampilkan dalam persen
                    color: function({
                      value,
                      seriesIndex,
                      dataPointIndex,
                      w
                    }) {
                      // Mengatur warna untuk setiap kategori
                      return warnaKategori[dataPointIndex];
                    }
                  }],
                  xaxis: {
                    categories: ['Sangat Tidak Puas', 'Tidak Puas', 'Netral', 'Puas', 'Sangat Puas'], // Label untuk sumbu X (penilaian 1 sampai 5)
                  },
                  title: {
                    text: 'Penilaian Pelayanan (Dalam Persen)',
                    align: 'center'
                  },
                  yaxis: {
                    labels: {
                      formatter: function(value) {
                        return value.toFixed(2) + '%'; // Format label y-axis dengan persen
                      }
                    },
                    style: {
                      fontSize: '16px', // Ubah ukuran font sesuai kebutuhan
                      fontWeight: 'bold'
                    }

                  },
                  dataLabels: {
                    enabled: true,
                    style: {
                      fontSize: '16px', // Perbesar teks di dalam grafik
                      fontWeight: 'bold',
                      colors: ['#ffffff']
                    }
                  },
                };

                // Membuat grafik menggunakan ApexCharts
                var chart = new ApexCharts(document.querySelector("#penilaianChart"), options);
                chart.render(); // Render grafik ke halaman
              </script> -->
            </div>
          </div>
        </div>
    </section>
  </div>
</div>
<?= $this->endSection() ?>