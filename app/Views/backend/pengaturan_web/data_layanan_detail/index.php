<?= $this->extend('backend/theme/template') ?>
<?= $this->section('content') ?>

<div class="page-heading">
  <h3><?= $title ?></h3>

  <section class="section">
    <div class="card">
      <div class="card-header">
        <!-- Add Button -->
        <button type="button" class="btn btn-primary btn-sm " data-bs-toggle="modal"
          data-bs-target="#addForm">
          Tambah Data
        </button>
      </div>
      <div class="card-body">

        <!-- Table Start -->
        <table class="table" id="table1">

          <thead>
            <tr>
              <th class="text-center" width="10%">No</th>
              <th class="text-center">Nama layanan</th>
              <th class="text-center">Pengelola</th>
              <th class="text-center" width="20%">Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php $no = 1;
            foreach ($layanan_detail as $key => $row) : ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $row['layanan'] ?></td>
                <td><?= $row['nama_seksi'] ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal"
                    data-bs-target="#border-less_detailModal<?= $row['id'] ?>">
                    <i class="fa fa-info-circle"></i> Detail
                  </button>
              </tr>
            <?php endforeach ?>
          </tbody>

        </table>
        <!-- Table End -->
      </div>
    </div>

    <!-- Add Modal -->
    <?= $this->include('backend/pengaturan_web/data_layanan_detail/form/add'); ?>
    <!-- detail Modal -->
    <?= $this->include('backend/pengaturan_web/data_layanan_detail/form/detail'); ?>
    <!-- Edit Modal -->
    <?= $this->include('backend/pengaturan_web/data_layanan_detail/form/edit'); ?>
    <!-- Delete Modal -->
    <?= $this->include('backend/pengaturan_web/data_layanan_detail/form/delete'); ?>

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