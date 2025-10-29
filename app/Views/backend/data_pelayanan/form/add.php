<!-- Add Modal -->
<div class="modal fade text-left" id="addForm" tabindex="-1"
  role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg"
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
      <?= form_open('/pelayanan/add/', ['enctype' => 'multipart/form-data']) ?>
      <div class="modal-body">
        <label>Nama Lengkap</label>
        <div class="form-group">
          <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required>
        </div>

        <div class="row">
          <div class="col-md-6"><label>No. Handphone </label>
            <div class="form-group">
              <input type="text" name="no_handphone" id="no_handphone" class="form-control" required>
            </div>
          </div>
          <div class="col-md-6"><label>Email </label>
            <div class="form-group">
              <input type="email" name="email" id="email" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="null">-- Pilih Jenis Kelamin --</option>
                <?php foreach ($jk as $key => $value) : ?>
                  <option value="<?= $value['id'] ?>"><?= $value['jenis_kelamin'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Agama</label>
              <select class="form-select" name="agama" id="agama">
                <option value="">-- Pilih Agama --</option>
                <?php foreach ($agama as $key => $value) : ?>
                  <option value="<?= $value['id'] ?>"><?= $value['agama'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Pemohon</label>
              <select class="form-select" name="pemohon" id="pemohon">
                <option value="">-- Asal Pemohon --</option>
                <?php foreach ($pemohon as $key => $value) : ?>
                  <option value="<?= $value['id'] ?>"><?= $value['asal_pemohon'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Layanan</label>
              <select class="choices form-select" name="layanan" id="layanan">
                <option value="#">-- Pilih Layanan --</option>
                <?php foreach ($layanan as $key => $value) : ?>
                  <option value="<?= $value['id'] ?>"><?= $value['nama_layanan'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Alamat </label>
          <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label>Unggah Berkas</label>
          <input class="form-control form-control-sm" id="lampiran" type="file" name="lampiran" accept=".pdf" required>
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
              <i class="bx bx-check d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Simpan</span>
            </button>

          </div>
        </div>
      </div>
      <?= form_close() ?>
      <!-- End Add Form -->
    </div>
  </div>
</div>
<!-- End Add Modal -->