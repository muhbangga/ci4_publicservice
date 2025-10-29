<div class="modal fade" id="addForm" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Data
          Content</h5>
        <button type="button" class="close" data-bs-dismiss="modal"
          aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open('/layanandetail/add/', ['method' => 'post', 'enctype' => 'multipart/form-data']) ?>

        <?= csrf_field() ?>
        <div class="form-group">
          <label>Nama Layanan</label>
          <select class="choices form-select" name="layanan" id="layanan">
            <option value="">-- Pilih Layanan --</option>
            <?php foreach ($layanan as $key => $value) : ?>
              <option value="<?= $value['id'] ?>"><?= $value['nama_layanan'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <label for="persyaratan">Persyaratan</label>
        <div class="form-group">
          <textarea name="persyaratan_1" id="persyaratan_1" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 1"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_2" id="persyaratan_2" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 2 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_3" id="persyaratan_3" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 3 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_4" id="persyaratan_4" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 4 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_5" id="persyaratan_5" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 5 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_6" id="persyaratan_6" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 6 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_7" id="persyaratan_7" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 7 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_8" id="persyaratan_8" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 8 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_9" id="persyaratan_9" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 9 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_10" id="persyaratan_10" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 10 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_11" id="persyaratan_11" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 11 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_12" id="persyaratan_12" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 12 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_13" id="persyaratan_13" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 13 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_14" id="persyaratan_14" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 14 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_15" id="persyaratan_15" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 15 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_16" id="persyaratan_16" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 16 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_17" id="persyaratan_17" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 17 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_18" id="persyaratan_18" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 18 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_19" id="persyaratan_19" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 19 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="persyaratan_20" id="persyaratan_20" class="form-control" cols="30" rows="2" placeholder="Masukkan persyaratan 20 (Opsional)"></textarea>
        </div>
        <label for="prosedur">Prosedur</label>
        <div class="form-group">
          <textarea name="prosedur_1" id="prosedur_1" class="form-control" cols="30" rows="2" placeholder="Masukkan prosedur 1"></textarea>
        </div>
        <div class="form-group">
          <textarea name="prosedur_2" id="prosedur_2" class="form-control" cols="30" rows="2" placeholder="Masukkan prosedur 2"></textarea>
        </div>
        <div class="form-group">
          <textarea name="prosedur_3" id="prosedur_3" class="form-control" cols="30" rows="2" placeholder="Masukkan prosedur 3 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="prosedur_4" id="prosedur_4" class="form-control" cols="30" rows="2" placeholder="Masukkan prosedur 4 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="prosedur_5" id="prosedur_5" class="form-control" cols="30" rows="2" placeholder="Masukkan prosedur 5 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="prosedur_6" id="prosedur_6" class="form-control" cols="30" rows="2" placeholder="Masukkan prosedur 6 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="prosedur_7" id="prosedur_7" class="form-control" cols="30" rows="2" placeholder="Masukkan prosedur 7 (Opsional)"></textarea>
        </div>
        <div class="form-group">
          <textarea name="prosedur_8" id="prosedur_8" class="form-control" cols="30" rows="2" placeholder="Masukkan prosedur 8 (Opsional)"></textarea>
        </div>
        <label for="waktu_pelayanan">Waktu Pelayanan</label>
        <div class="form-group">
          <input type="text" name="waktu_pelayanan" id="waktu_pelayanan" class="form-control" required>
        </div>
        <label for="biaya_pelayanan">Biaya Pelayanan</label>
        <div class="form-group">
          <input type="text" name="biaya_pelayanan" id="biaya_pelayanan" class="form-control" required>
        </div>
        <label for="produk_pelayanan">Produk Pelayanan</label>
        <div class="form-group">
          <input type="text" name="produk_layanan" id="produk_layanan" class="form-control" required>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary"
          data-bs-dismiss="modal">
          <i class="bx bx-x d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Close</span>
        </button>
        <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
          <i class="bx bx-check d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Simpan</span>
        </button>
        <?= form_close() ?>
      </div>

    </div>
  </div>
</div>