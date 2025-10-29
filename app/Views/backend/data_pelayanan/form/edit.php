<?php foreach ($pelayanan as $key => $row) : ?>
  <!-- Edit Modal -->
  <!--scrolling content Modal -->
  <div class="modal fade" id="editForm<?= $row['id'] ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Data</h5>
          <button type="button" class="close" data-bs-dismiss="modal"
            aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
          <!-- Edit Form-->
          <?= form_open('/pelayanan/update/' . $row['id'], ['method' => 'post', 'enctype' => 'multipart/form-data']) ?>
          <div class="modal-body">
            <label>Nama Lengkap</label>
            <div class="form-group">
              <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?= $row['nama_lengkap'] ?>" required>
            </div>

            <div class="row">
              <div class="col-md-6"><label>No. Handphone </label>
                <div class="form-group">
                  <input type="text" name="no_handphone" id="no_handphone" class="form-control" value="<?= $row['no_handphone'] ?>" required>
                </div>
              </div>
              <div class="col-md-6"><label>Email </label>
                <div class="form-group">
                  <input type="email" name="email" id="email" class="form-control" value="<?= $row['email'] ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select class="choices form-select" name="jenis_kelamin" id="jenis_kelamin" required>
                    <?php foreach ($jk as $key => $value) : ?>
                      <option value="<?= $value['id'] ?>" <?= ($value['id'] == $row['id']) ? 'selected' : '' ?>>
                        <?= esc($value['jenis_kelamin']) ?>
                      </option>

                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Pengelola</label>
                  <select class="choices form-select" name="agama" id="agama" required>
                    <?php foreach ($agama as $key => $value) : ?>
                      <option value="<?= $value['id'] ?>" <?= ($value['id'] == $row['id']) ? 'selected' : '' ?>>
                        <?= esc($value['agama']) ?>
                      </option>

                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Pemohon</label>
                  <select class="choices form-select" name="pemohon" id="pemohon" required>
                    <?php foreach ($pemohon as $key => $value) : ?>
                      <option value="<?= $value['id'] ?>" <?= ($value['id'] == $row['id']) ? 'selected' : '' ?>>
                        <?= esc($value['asal_pemohon']) ?>
                      </option>

                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Layanan</label>
                  <select class="choices form-select" name="layanan" id="layanan">
                    <?php foreach ($layanan as $key => $value) : ?>
                      <option value="<?= $value['id'] ?>" <?= ($value['id'] == $row['id']) ? 'selected' : '' ?>>
                        <?= esc($value['nama_layanan']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <?php if ($row['status'] == 2 && 3) { ?>
              <label for="penerima">Penerima</label>
              <div class="form-group">
                <input type="text" name="penerima" id="penerima" class="form-control" value="<?= isset($row['penerima']) ? $row['penerima'] : ''; ?>">
              </div>
              <div class="form-group">
                <label>Unggah Berkas</label>
                <input class="form-control form-control-sm" id="lampiran" type="file" accept=".pdf" name="lampiran_jadi">
              </div>
            <?php } ?>

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
            <?= form_close() ?>
            <!-- End Edit Form -->
          </div>
        </div>
      </div>
    </div>
    <!-- End Edit Modal -->
  </div>
<?php endforeach; ?>