<?= $this->extend('backend/theme/template') ?>
<?= $this->section('content') ?>
<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3><?= $title ?></h3>
        <p class="text-subtitle text-muted">Informasi Akun</p>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<? base_url('dashboard/') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="row">
      <div class="col-12 col-lg-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-center align-items-center flex-column">
              <div class="avatar avatar-2xl">
                <img src="<?= base_url() ?>/images/profile/<?= user()->user_image ?>" alt="Avatar">
              </div>

              <h3 class="mt-3"><?= $user->fullname ?></h3>
              <p class="text-small"><?php if (in_groups('admin')) { ?>
                  Admin
                <?php } else { ?>
                  PTSP
                <?php } ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-8">
        <div class="card">
          <div class="card-body">
            <form action="<?= base_url('/profile/update') ?>" method="post">
              <?= csrf_field() ?>
              <div class="form-group">
                <label for="name" class="form-label">Username</label>
                <input type="text" name="username" id="name" class="form-control" placeholder="Masukkan Username" value="<?= old('fullname', $user->username) ?>">
              </div>

              <div class="form-group">
                <label for="fullname" class="form-label">Nama Lengkap</label>
                <input type="text" name="fullname" id="fullname" class="form-control" value="<?= old('fullname', $user->fullname) ?>">
              </div>
              <div class="form-group">
                <label for="fullname" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Nama Lengkap" value="<?= old('fullname', $user->email) ?>">
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