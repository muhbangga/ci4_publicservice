<!-- Add Modal -->
<div class="modal fade text-left" id="addForm" tabindex="-1"
  role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
    role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel33">Tambah Data</h4>
        <button type="button" class="close" data-bs-dismiss="modal"
          aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>

      <!-- Add Form-->
      <?= form_open('/users/add/') ?>
      <div class="modal-body">
        <div class="form-group">
          <label for="username">Nama Pengguna</label>
          <input type="text" name="username" id="username" class="form-control" value="<?= old('username'); ?>">

        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
          <label for="username">Role</label>
          <select class="form-control" name="role" id="">
            <option value="#">---- Pilih Role ----</option>
            <option value="Admin">Admin</option>
            <option value="PTSP">PTSP</option>
          </select>
        </div>

      </div>

      <div class="modal-footer">
        <div class="row">
          <div class="col-sm-6">
            <button type="button" class="btn btn-light"
              data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Batal</span>
            </button>
          </div>
          <div class="col-sm-6">
            <button type="submit" class="btn btn-primary ml-1">

              <span class="d-none d-sm-block">Simpan</span>
            </button>

          </div>
        </div>
      </div>
      <!-- End Add Form -->
    </div>
    <?= form_close() ?>
  </div>
</div>
<!-- End Add Modal -->