<?php foreach ($layanan as $key => $row) : ?>
  <!-- Edit Modal -->
  <div class="modal fade text-left" id="editForm<?= $row['id'] ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
      role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel33">Edit Data</h4>
          <button type="button" class="close" data-bs-dismiss="modal"
            aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>

        <!-- Edit Form-->
        <?= form_open('/layanan/update/' . $row['id'], ['enctype' => 'multipart/form-data']) ?>
        <div class="modal-body">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <label>Nama layanan </label>
          <div class="form-group">
            <input type="text" name="nama_layanan" id="nama_layanan" class="form-control" value="<?= $row['nama_layanan'] ?>">
          </div>
          <div class="form-group">
            <label>Pengelola</label>
            <select class="form-select" name="seksi_pengelola" id="seksi_pengelola">
              <?php foreach ($seksi as $key => $value) : ?>
                <option value="<?= $value['id'] ?>" <?= ($value['id'] == $row['id']) ? 'selected' : '' ?>>
                  <?= esc($value['nama_seksi']) ?>
                </option>

              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Sebagai Opsi</label>
            <select class="form-select" name="status" id="status">
              <option value="#">-- Pilih --</option>
              <option value="0">Tidak</option>
              <option value="1">Ya</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light"
            data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Batal</span>
          </button>
          <button type="submit" class="btn btn-warning ml-1">
            <span class="d-none d-sm-block"><i class="fa fa-save"></i> Simpan</span>
          </button>
        </div>
        <?= form_close() ?>
        <!-- End Edit Form -->

      </div>
    </div>
  </div>
<?php endforeach; ?>
<!-- End Edit Modal -->