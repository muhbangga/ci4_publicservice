<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>


  <!-- Add AlpineJS -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= base_url('/images/logo/' . $logo['logo']) ?>" type="image/x-icon">

  <!-- Fontawesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">

  <!-- Select Choices -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/extensions/choices.js/public/assets/styles/choices.css">

  <!-- Datatables CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/extensions/simple-datatables/style.css">
  <link rel="stylesheet" crossorigin href="<?= base_url() ?>/assets/compiled/css/table-datatable.css">

  <!-- SweetAlert CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/extensions/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" crossorigin href="<?= base_url() ?>/assets/compiled/css/extra-component-sweetalert.css">

  <!-- Main CSS -->
  <link rel="stylesheet" crossorigin href="<?= base_url() ?>/assets/compiled/css/app.css">
  <link rel="stylesheet" crossorigin href="<?= base_url() ?>/assets/compiled/css/app-dark.css">

  <!-- Iconly -->
  <link rel="stylesheet" crossorigin href="<?= base_url() ?>/assets/compiled/css/iconly.css">

  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <!-- SweetAlert Script (Opsional) -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</head>

<body>
  <script src="<?= base_url() ?>/assets/static/js/initTheme.js"></script>
  <div id="app">

    <!-- Sidebar -->
    <?= $this->include('backend/theme/layout/sidebar'); ?>

    <div id="main" class='layout-navbar navbar-fixed'>

      <!-- Navbar -->
      <?= $this->include('backend/theme/layout/topbar'); ?>

      <!-- Main Section -->
      <div id="main-content">

        <?= $this->renderSection('content'); ?>
      </div>

      <!-- Footer -->
      <?= $this->include('backend/theme/layout/footer'); ?>

    </div>
  </div>


  <!-- Javascript -->
  <script src="<?= base_url() ?>/assets/static/js/components/dark.js"></script>
  <script src="<?= base_url() ?>/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>



  <!-- Sweetalert -->
  <script src="<?= base_url() ?>/assets/extensions/sweetalert2/sweetalert2.min.js"></script>>
  <script src="<?= base_url() ?>/assets/static/js/pages/sweetalert2.js"></script>>


  <!-- Datatables Javascript-->
  <script src="<?= base_url() ?>/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
  <script src="<?= base_url() ?>/assets/static/js/pages/simple-datatables.js"></script>

  <!-- Select -->
  <script src="<?= base_url() ?>/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
  <script src="<?= base_url() ?>/assets/static/js/pages/form-element-select.js"></script>

  <!-- Chartjs -->
  <script src="<?= base_url() ?>/assets/extensions/chart.js/chart.umd.js"></script>
  <script src="<?= base_url() ?>/assets/static/js/pages/ui-chartjs.js"></script>

  <script src="<?= base_url() ?>/assets/compiled/js/app.js"></script>


</body>

</html>