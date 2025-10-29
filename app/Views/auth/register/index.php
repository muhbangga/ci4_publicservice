<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Muhamad Nauval Azhar">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="This is a login page template based on Bootstrap 5">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
  <section class="h-100">
    <div class="container h-100">
      <div class="row justify-content-sm-center h-100">
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
          <div class="text-center my-5">
            <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
          </div>
          <div class="card shadow-lg">
            <div class="card-body p-5">
              <h1 class="fs-4 card-title fw-bold mb-4"><?= lang('Auth.register') ?></h1>
              <?= view('Myth\Auth\Views\_message_block') ?>
              <form action="<?= url_to('register') ?>" class="needs-validation" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                  <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                </div>

                <div class="mb-3">
                  <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                    name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                  <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                </div>

                <div class="mb-3">
                  <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                </div>

                <div class="mb-3">
                  <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                </div>

                <div class="align-items-center d-flex">
                  <button type="submit" class="btn btn-primary ms-auto">
                    <?= lang('Auth.register') ?>
                  </button>
                </div>
              </form>
            </div>
            <div class="card-footer py-3 border-0">
              <div class="text-center">
                <?= lang('Auth.alreadyRegistered') ?> <a href="<?= url_to('login') ?>" class="text-dark"><?= lang('Auth.signIn') ?></a>
              </div>
            </div>
          </div>
          <div class="text-center mt-5 text-muted">
            Copyright &copy; 2017-2021 &mdash; Your Company
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="<?= base_url() ?>/assets/complied/js/login.js"></script>
</body>

</html>