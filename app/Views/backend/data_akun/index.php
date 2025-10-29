<?= $this->extend('backend/theme/template') ?>
<?= $this->section('content') ?>

<div class="page-heading">
  <h3><?= $title ?></h3>
  <section class="section">
    <div class="card">
      <div class="card-header">
        <!-- Add Button -->
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
          data-bs-target="#addForm">
          <i class="fa fa-plus"></i>
          Tambah Data
        </button>
      </div>
      <div class="card-body">

        <!-- Table Start -->

        <table class="table" id="table1" style="font-size: 14px;">

          <thead>
            <tr>
              <th class="text-center" width="10%">No</th>
              <th class="text-center" width="10%">Username</th>
              <th class="text-center">Email</th>
              <th class="text-center">Role</th>
              <th class="text-center">Status</th>
              <th class="text-center" width="20%">Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php $no = 1;
            foreach ($users as $key => $row) : ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['name'] ?></td>
                <td class="text-center"><?php if ($row['active'] == 0) { ?>
                    <a href="<?= base_url('users/aktif/' . $row['userid']) ?>" class="btn btn-sm btn-success">Aktifkan</a>
                  <?php } else { ?>
                    <a href="<?= base_url('users/aktif/' . $row['userid']) ?>" class="btn btn-sm btn-danger">Nonaktifkan</a>
                  <?php } ?>
                </td>
                <td class="text-center">
                  <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                    data-bs-target="#deleteForm<?= $row['userid'] ?>"><i class="fa fa-trash"></i>Hapus</button>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>

        </table>
        <!-- Table End -->
      </div>
    </div>
    <!-- Add Modal -->
    <?= $this->include('backend/data_akun/form/add'); ?>

    <!-- Delete Modal -->
    <?= $this->include('backend/data_akun/form/delete'); ?>
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