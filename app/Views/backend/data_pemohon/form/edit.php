<?php foreach ($pemohon as $key => $row) : ?>
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
        <?= form_open('/pemohon/update/' . $row['id']) ?>
        <div class="modal-body">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <label>Pemohon</label>
          <div class="form-group">
            <input type="text" name="asal_pemohon" id="asal_pemohon" class="form-control" value="<?= $row['asal_pemohon'] ?>">
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