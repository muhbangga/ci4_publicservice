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
      <?= form_open('/layanan/add/') ?>
      <div class="modal-body">
        <label>Nama Layanan </label>
        <div class="form-group">
          <input type="text" name="nama_layanan" id="nama_layanan" class="form-control" value="<?= old('nama_layanan') ?>">
        </div>
        <div class="form-group">
          <label>Pengelola</label>
          <select class="form-select" name="seksi_pengelola" id="seksi_pengelola">
            <option value="">-- Pilih Pengelola --</option>
            <?php foreach ($seksi as $key => $value) : ?>
              <option value="<?= $value['id'] ?>"><?= $value['nama_seksi'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
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
      <?= form_close() ?>
      <!-- End Add Form -->
    </div>
  </div>
</div>
<!-- End Add Modal -->