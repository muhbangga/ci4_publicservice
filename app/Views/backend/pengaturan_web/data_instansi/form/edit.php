<?php foreach ($company as $key => $row) : ?>
  <!-- Edit Modal -->
  <div class="modal fade" id="editForm<?= $row['id'] ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Scrolling long
            Content</h5>
          <button type="button" class="close" data-bs-dismiss="modal"
            aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
          <?= form_open('/company/update/' . $row['id'], ['method' => 'post', 'enctype' => 'multipart/form-data']) ?>
          <div class="modal-body">
            <?= csrf_field() ?>
            <label for="logo">Logo:</label>
            <div class="form-group">
              <input type="file" name="logo" id="logoInput<?= $row['id'] ?>" class="form-control">
            </div>
            <div>
              <img id="previewLogo<?= $row['id'] ?>" src="<?= base_url('images/logo/' . $row['logo']) ?>" alt="Pratinjau Logo" style="max-width: 100px; height: auto;">
            </div>
            <br>
            <label for="judul_web">Nama Website:</label>
            <div class="form-group">
              <input type="text" name="judul_web" id="judul_web" class="form-control" value="<?= $row['judul_web'] ?>" required>
            </div>
            <label for="instansi">Instansi:</label>
            <div class="form-group">
              <input type="text" name="instansi" id="instansi" class="form-control" value="<?= $row['instansi'] ?>" required>
            </div>
            <label for="alamat">Alamat:</label>
            <div class="form-group">
              <textarea name="alamat" id="alamat" class="form-control" required><?= $row['alamat'] ?></textarea>
            </div>
            <div class="row">
              <div class="col">
                <label for="no_telp">No. Telp:</label>
                <div class="form-group">
                  <input type="text" name="no_telp" id="no_telp" class="form-control" value="<?= $row['no_telp'] ?>" required>
                </div>

              </div>
              <div class="col">
                <label for="no_telp">Email:</label>
                <div class="form-group">
                  <input type="text" name="email" id="email" class="form-control" value="<?= $row['email'] ?>" required>
                </div>
              </div>
            </div>
            <label for="instagram">Instagram:</label>
            <div class="form-group">
              <input type="text" name="instagram" id="instagram" class="form-control" value="<?= $row['instagram'] ?>">
            </div>
            <label for="tiktok">Tiktok:</label>
            <div class="form-group">
              <input type="text" name="tiktok" id="tiktok" class="form-control" value="<?= $row['tiktok'] ?>">
            </div>
            <label for="facebook">Facebook:</label>
            <div class="form-group">
              <input type="text" name="facebook" id="facebook" class="form-control" value="<?= $row['facebook'] ?>">
            </div>
          </div>

        </div>
        <div class=" modal-footer">
          <div class="row">
            <div class="col-sm-6">
              <button type="button" class="btn btn-light"
                data-bs-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Batal</span>
              </button>
            </div>
            <div class="col-sm-6">
              <button type="submit" class="btn btn-warning ml-1">
                <i class="bx bx-check d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Simpan</span>
              </button>
            </div>
          </div>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>

<?php endforeach; ?>
<script>
  // Fungsi untuk memperbarui pratinjau gambar
  function previewImage(inputId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);

    input.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result; // Set gambar pratinjau
        };
        reader.readAsDataURL(file); // Membaca file gambar
      }
    });
  }

  // Tambahkan event listener untuk setiap form
  <?php foreach ($company as $key => $row) : ?>
    previewImage('logoInput<?= $row['id'] ?>', 'previewLogo<?= $row['id'] ?>');
  <?php endforeach; ?>
</script>

<!-- End Edit Modal -->