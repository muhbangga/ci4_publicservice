<?= $this->extend('backend/theme/template') ?>
<?= $this->section('content') ?>
<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3><?= $title ?></h3>
        <p class="text-subtitle text-muted">Ganti password akun</p>
      </div>
      <!-- <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
          </ol>
        </nav>
      </div> -->
    </div>
  </div>
  <section class="section">

    <div class="col-12 col-lg-8">
      <div class="card">
        <div class="card-body">
          <form action="<?= base_url('users/savepassword') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
              <label for="fullname" class="form-label">Password Saat Ini</label>
              <input type="password" name="current_password" id="current_password" class="form-control<?= isset($validation) && $validation->hasError('current_password') ? 'is-invalid' : '' ?>">
              <div class="invalid-feedback">
                <?= isset($validation) ? $validation->getError('current_password') : '' ?>
              </div>
            </div>

            <div class="form-group">
              <label for="fullname" class="form-label">Password Baru</label>
              <input type="password" name="new_password" id="new_password" class="form-control<?= isset($validation) && $validation->hasError('new_password') ? 'is-invalid' : '' ?>">
              <div class="invalid-feedback">
                <?= isset($validation) ? $validation->getError('new_password') : '' ?>
              </div>
            </div>
            <div class="form-group">
              <label for="fullname" class="form-label">Konfirmasi Password Baru</label>
              <input type="password" name="confirm_password" id="confirm_password" class="form-control<?= isset($validation) && $validation->hasError('confirm_password') ? 'is-invalid' : '' ?>">
              <div class="invalid-feedback">
                <?= isset($validation) ? $validation->getError('confirm_password') : '' ?>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
</section>
</div>
<script>
  // Menampilkan SweetAlert jika terdapat flashdata sukses
  <?php if (session()->getFlashdata('success')) : ?>
    Swal.fire({
      icon: 'success',
      title: 'Sukses',
      text: '<?= session()->getFlashdata('success') ?>',
      showConfirmButton: false,
      timer: 2000
    });
  <?php endif; ?>

  // Menampilkan SweetAlert jika terdapat flashdata error
  <?php if (session()->getFlashdata('error')) : ?>
    Swal.fire({
      icon: 'error',
      title: 'Gagal',
      text: '<?= session()->getFlashdata('error') ?>',
      showConfirmButton: false,
      timer: 2000
    });
  <?php endif; ?>
</script>
<?= $this->endSection() ?>