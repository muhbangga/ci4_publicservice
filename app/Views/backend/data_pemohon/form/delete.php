<!-- Delete Modal -->
<?php foreach ($pemohon as $key => $row) : ?>
  <div class="modal fade text-left" id="deleteForm<?= $row['id'] ?>" tabindex="-1"
    role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel33">Hapus Data</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <?= form_open('/pemohon/delete/' . $row['id']) ?>
        <div class="modal-body">
          <p class="text-center">Apakah anda yakin ingin menghapus <br>
            <b><?= $row['asal_pemohon'] ?></b> ?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light"
            data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Batal</span>
          </button>
          <button type="submit" class="btn btn-danger ml-1">
            <span class="d-none d-sm-block"><i class="fa fa-trash-alt"></i> Hapus</span>
          </button>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<!-- Delete Modal -->