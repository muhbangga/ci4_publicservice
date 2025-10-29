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

          <?php foreach ($about as $key => $row) : ?>
            <tr>
              <th width=20%=>Gambar 1</th>
              <td>: <img src="<?= base_url('images/about/' . $row['gambar_1']) ?>" alt="" width="100px"></td>
            </tr>
            <tr>
              <th>Gambar_2</th>
              <td>: <img src="<?= base_url('images/about/' . $row['gambar_2']) ?>" alt="" width="100px"></td>
            </tr>
            <tr>
              <th>Deskripsi</th>
              <td>: <?= $row['deskripsi'] ?></td>
            </tr>
            <tr>
              <th>Kelebihan </th>
              <td>
                <ol>
                  <li><?= $row['kelebihan_1'] ?></li>
                  <li><?= $row['kelebihan_2'] ?></li>
                  <li><?= $row['kelebihan_3'] ?></li>
                  <li><?= $row['kelebihan_4'] ?></li>
                  <li><?= $row['kelebihan_5'] ?></li>
                  </ul>
              </td>
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
    <?= $this->include('backend/pengaturan_web/about/form/edit'); ?>
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