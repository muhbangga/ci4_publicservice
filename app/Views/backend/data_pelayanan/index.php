<?= $this->extend('backend/theme/template') ?>
<?= $this->section('content') ?>

<div class="page-heading">
  <h3><?= $title ?></h3>

  <section class="section">
    <div class="card">
      <div class="card-header">
        <!-- Add Button -->
        <button type="button" class="btn btn-primary btn-sm" style="padding: 2px 4px;" data-bs-toggle="modal"
          data-bs-target="#addForm">
          <i class="fa fa-plus-circle"></i> Tambah Data
        </button>
      </div>
      <div class="card-body">

        <!-- Table Start -->
        <table class="table table-striped" id="table1" style="font-size: 12px; width: 100%; table-layout: fixed;">

          <thead>
            <tr>
              <th class="text-center" width="4%">No</th>
              <th class="text-center">Nama Pemohon</th>
              <th class="text-center" width="20%">E-Tiket</th>
              <th class="text-center">No.HP</th>
              <th class="text-center">Layanan</th>
              <th class="text-center">Data Masuk</th>

              <th class="text-center">Status</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php
            function bulan($bulan)
            {
              $namaBulan = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
              ];
              return $namaBulan[$bulan];
            }
            ?>
            <?php $no = 1;
            foreach ($pelayanan as $key => $row) : ?>

              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $row['nama_lengkap'] ?></td>
                <td><?= $row['e_tiket'] ?></td>
                <td><?= $row['no_handphone'] ?></td>
                <td><?= $row['nama_layanan'] ?></td>
                <td class="text-center">

                  <?php
                  $tanggal = new DateTime($row['created_at']);
                  echo $tanggal->format('j') . ' ' . bulan($tanggal->format('n')) . ' ' . $tanggal->format('Y');
                  ?>
                </td>

                <td class="text-center">
                  <?php if ($row['status'] == 1) { ?>
                    <span class="badge bg-warning badge-sm"><small>Diterima PTSP</small></span>
                  <?php } elseif ($row['status'] == 2) { ?>
                    <span class="badge bg-info badge-sm text-white">Diproses Unit</span>
                  <?php } elseif ($row['status'] == 3) { ?>
                    <span class="badge bg-success badge-sm">Selesai</span>
                  <?php } else { ?>
                    <span class="badge bg-danger badge-sm">Menunggu Konfirmasi</span>
                  <?php } ?>
                </td>
                <td class="text-center">
                  <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 12px; padding: 2px 4px;" data-bs-toggle="modal"
                    data-bs-target="#border-less_detailModal<?= $row['id'] ?>">
                    <i class="fa fa-info-circle"></i> Detail
                  </button>

                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>

        </table>
        <!-- Table End -->
      </div>
    </div>

    <!-- Delete Modal -->
    <?= $this->include('backend/data_pelayanan/form/delete'); ?>

    <!-- Detail Modal -->
    <?= $this->include('backend/data_pelayanan/form/detail'); ?>

    <!-- Add Modal -->
    <?= $this->include('backend/data_pelayanan/form/add'); ?>

    <!-- Edit Modal -->
    <?= $this->include('backend/data_pelayanan/form/edit'); ?>


  </section>
</div>

<?php if (session()->getFlashdata('success')) : ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Sukses',
      text: '<?= session()->getFlashdata('success') ?>',
      showConfirmButton: false,
      timer: 2000
    });
  </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
  <script>
    <?php
    $errorMessages = session()->getFlashdata('error');
    $errorText = is_array($errorMessages) ? implode('<br>', $errorMessages) : $errorMessages;
    ?>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      html: '<?= $errorText ?>', // gunakan html untuk menampilkan <br> jika ada beberapa pesan
      showConfirmButton: false,
      timer: 3000
    });
  </script>
<?php endif; ?>
<?= $this->endSection() ?>