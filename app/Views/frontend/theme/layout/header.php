<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="" class="logo d-flex align-items-left me-5 me-xl-0">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <img src="<?= base_url('images/logo/' . $company['logo']) ?>" alt="">
      <!--<h1 class="sitename">iLanding</h1> -->
    </a>
    <img src="" alt="" class="me-2" width="10px">
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="<?= base_url('/beranda/index') ?>#hero" class="active">Beranda</a></li>
        <li><a href="<?= base_url('/beranda/index') ?>#about">Tentang</a></li>
        <li><a href="<?= base_url('/beranda/ketentuan') ?>">Ketentuan Layanan</a></li>
        <li class="dropdown"><a href="#"><span>Lainnya</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="<?= base_url('/beranda/permohonan') ?>">Ajukan Permohonan</a></li>
            <li><a href="<?= base_url('/beranda/track') ?>">Cek Status Layanan</a></li>
            <li><a href="<?= base_url('login') ?>">Login </a></li>
          </ul>
        </li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>



  </div>
</header>