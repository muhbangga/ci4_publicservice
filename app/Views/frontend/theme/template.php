<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?= $title ?></title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?= base_url('images/logo/' . $company['logo']) ?>" rel="icon">
  <link href="<?= base_url('images/logo/' . $company['logo']) ?>" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Fontawesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">

  <!-- Select Choices -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/extensions/choices.js/public/assets/styles/choices.css">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url() ?>front/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>front/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ?>front/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= base_url() ?>front/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>front/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?= base_url() ?>front/assets/css/main.css" rel="stylesheet">

  <!-- SweetAlert Script (Opsional) -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- =======================================================
  * Template Name: iLanding
  * Template URL: https://bootstrapmade.com/ilanding-bootstrap-landing-page-template/
  * Updated: Nov 12 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <!-- Header -->
  <?= $this->include('frontend/theme/layout/header'); ?>

  <main class="main">


    <!-- Content Section -->
    <?= $this->renderSection('content'); ?>
    <!-- End Contens Section -->

  </main>

  <!-- Footer -->
  <footer id="footer" class="footer">

    <div class=" container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="<?= base_url('beranda/index') ?>" class="logo d-flex align-items-center">
            <img src="<?= base_url('images/logo/' . $company['logo']) ?>" alt="" width="auto">
            <p style="font-size: 14px; color: black;">
              <br>
              <br>
              Kantor Kementerian Agama
              <br>
              Kabupaten Pekalongan
            </p>
          </a>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Alamat</h4>
          <ul>
            <li><a href="https://maps.app.goo.gl/d5KaXSNvUYf4TPKH8"><?= $company['alamat'] ?></a></li>
          </ul>
        </div>


        <div class="col-lg-3 col-md-3 footer-links">
          <h4>Kontak Kami</h4>
          <ul>
            <li>
              <p><i class="bi bi-telephone"></i> <?= $company['no_telp'] ?></p>
            </li>
            <li><a href="https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to=kabpekalongan@kemenag.go.if"><i class="bi bi-envelope-at-fill"></i> <?= $company['email'] ?></a></li>

          </ul>
        </div>

        <div class="col-lg-3 col-md-3 footer-links">
          <h4>Sosial Media</h4>
          <ul>
            <li><a href="https://www.facebook.com/kankemenagkabpekalongan/"><i class="bi bi-facebook"></i> <?= $company['facebook'] ?></a></li>
            <li><a href="https://www.instagram.com/kemenag.pekalongan/?hl=en"><i class="bi bi-instagram"></i> <?= $company['instagram'] ?></a></li>
            <li> <a href="https://www.tiktok.com/@kemenag.kab.pekal"><ion-icon name="logo-tiktok"></ion-icon> <?= $company['tiktok'] ?></a></li>
          </ul>
        </div>


      </div>
      <div class="container copyright text-center mt-4">
        <p><strong class="px-1 sitename"><?= $company['instansi'] ?> <?= date('Y') ?></strong> <span></span></p>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you've purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->

        </div>
      </div>
    </div>

  </footer>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url() ?>front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>front/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url() ?>front/assets/vendor/aos/aos.js"></script>
  <script src="<?= base_url() ?>front/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url() ?>front/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= base_url() ?>front/assets/vendor/purecounter/purecounter_vanilla.js"></script>

  <!-- Main JS File -->
  <script src="<?= base_url() ?>front/assets/js/main.js"></script>

  <!-- Select -->
  <script src="<?= base_url() ?>/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
  <script src="<?= base_url() ?>/assets/static/js/pages/form-element-select.js"></script>

  <!-- Sweetalert -->
  <script src="<?= base_url() ?>/assets/extensions/sweetalert2/sweetalert2.min.js"></script>>
  <script src="<?= base_url() ?>/assets/static/js/pages/sweetalert2.js"></script>>

</body>

</html>