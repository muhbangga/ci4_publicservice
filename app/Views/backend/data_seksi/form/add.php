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
      <?= form_open('/seksi/add/') ?>
      <div class="modal-body">
        <label>Seksi/Pengelola</label>
        <div class="form-group">
          <input type="text" name="nama_seksi" id="nama_seksi" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <div class="modal-footer">
          <button type="button" class="btn btn-light"
            data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Batal</span>
          </button>
          <button type="submit" class="btn btn-primary ml-1">
            <span class="d-none d-sm-block"><i class="fa fa-save"></i> Simpan</span>
          </button>
        </div>
      </div>
      <?= form_close() ?>
      <!-- End Add Form -->
    </div>
  </div>
</div>
<!-- End Add Modal -->