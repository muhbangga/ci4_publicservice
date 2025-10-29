<header>
  <nav class="navbar navbar-expand navbar-light navbar-top">
    <div class="container-fluid">
      <a href="#" class="burger-btn d-block">
        <i class="bi bi-justify fs-3"></i>
      </a>


      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-lg-0">

        </ul>
        <div class="dropdown">
          <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="user-menu d-flex">
              <div class="user-name text-end me-3">
                <h6 class="mb-0 text-gray-600"><?= user()->username ?></h6>
                <p class="mb-0 text-sm text-gray-600">
                  <?php if (in_groups('Admin')) { ?>
                    Admin
                  <?php } else { ?>
                    Staff PTSP
                  <?php } ?>
                </p>
              </div>
              <div class="user-img d-flex align-items-center">
                <div class="avatar avatar-md">
                  <img src="<?= base_url() ?>/images/profile/<?= user()->user_image ?>">
                </div>
              </div>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">

            <li>
              <a class="dropdown-item" href="<?= base_url('profile/index') ?>"><i class="icon-mid bi bi-person me-2"></i> Profil
              </a>
            </li>

            <li>
              <a class="dropdown-item" href="<?= base_url('users/repassword') ?>"><i class="fa fa-key me-2"></i> Ubah Password
              </a>
            </li>

            <li>
              <a class="dropdown-item" href=" <?= base_url('logout') ?>"><i
                  class="icon-mid bi bi-box-arrow-left me-2"></i> Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>