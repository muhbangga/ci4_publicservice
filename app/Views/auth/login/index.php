<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
  <section class="h-100">
    <div class="container h-100">
      <div class="row justify-content-sm-center h-100">
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
          <div class="text-center my-5">
            <!-- <img src="" alt="logo" width="100"> -->
          </div>
          <div class="card shadow-lg">
            <div class="card-body p-5">
              <h1 class="fs-4 card-title fw-bold mb-4"><?= lang('Auth.loginTitle') ?></h1>
              <?= view('Myth\Auth\Views\_message_block') ?>

              <form action="<?= url_to('login') ?>" method="post" class="needs-validation">
                <?= csrf_field() ?>
                <?php if ($config->validFields === ['email']): ?>
                  <div class="mb-3">
                    <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                      name="login" placeholder="<?= lang('Auth.email') ?>">
                    <div class="invalid-feedback">
                      <?= session('errors.login') ?>
                    </div>
                  </div>
                <?php else: ?>
                  <div class="mb-3">
                    <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                      name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                    <div class="invalid-feedback">
                      <?= session('errors.login') ?>
                    </div>
                  </div>
                <?php endif; ?>

                <div class="mb-3">
                  <div class="mb-2 w-100">
                    <!-- <a href="forgot.html" class="float-end">
                      Forgot Password?
                    </a> -->
                  </div>
                  <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                  <div class="invalid-feedback">
                    <?= session('errors.password') ?>
                  </div>
                </div>


                <div class="d-flex align-items-center">

                  <?php if ($config->activeResetter): ?>
                    <p><a href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
                  <?php endif; ?>

                  <button type="submit" class="btn btn-primary ms-auto">
                    <?= lang('Auth.loginAction') ?>
                  </button>
                </div>

              </form>
            </div>

          </div>
          <!-- <div class="text-center mt-5 text-muted">
            Copyright &copy; 2017-2021 &mdash; Your Company
          </div> -->
        </div>
      </div>
    </div>
  </section>

  <script src="<?= base_url() ?>/assets/complied/js/login.js"></script>
</body>

</html>