<?= $this->extend('backend/theme/template') ?>
<?= $this->section('content') ?>

<div class="page-heading">
  <h3><?= $title ?></h3>
  <section class="section">
    <div class="card">
      <div class="card-header">
        <!-- Add Button -->

      </div>
      <div class="card-body">

        <!-- Table Start -->
        <table class="table">

          <?php foreach ($company as $key => $row) : ?>
            <tr>
              <th width=20%=>Logo</th>
              <td>: <img src="<?= base_url('images/logo/' . $row['logo']) ?>" alt="" width="100px"></td>
            </tr>
            <tr>
              <th>Nama Website</th>
              <td>: <?= $row['judul_web'] ?></td>
            </tr>
            <tr>
              <th>Instansi</th>
              <td>: <?= $row['instansi'] ?></td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td>: <?= $row['alamat'] ?></td>
            </tr>
            <tr>
              <th>No.Telp</th>
              <td>: <?= $row['no_telp'] ?></td>
            </tr>
            <tr>
              <th>Email</th>
              <td>: <?= $row['email'] ?></td>
            </tr>
            <tr>
              <th>Instagram</th>
              <td>: <?= $row['instagram'] ?></td>
            </tr>
            <tr>
              <th>Tiktok</th>
              <td>: <?= $row['tiktok'] ?></td>
            </tr>
            <tr>
              <th>Facebook</th>
              <td>: <?= $row['facebook'] ?></td>
            </tr>
          <?php endforeach ?>
        </table>
        <td class="text-center">
          <button type="button" class="btn btn-warning btn-sm " data-bs-toggle="modal"
            data-bs-target="#editForm<?= $row['id'] ?>">Edit</button>
        </td>
        <!-- Table End -->
      </div>
    </div>
    <?= $this->include('backend/pengaturan_web/data_instansi/form/edit'); ?>
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