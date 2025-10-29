<?php foreach ($about as $key => $row) : ?>
  <!-- Edit Modal -->
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
          <?= form_open('/about/update/' . $row['id'], ['method' => 'post'], ['enctype' => 'multipart/form-data']) ?>
          <div class="modal-body">
            <?= csrf_field() ?>
            <label for="gambar_1">Gambar 1:</label>
            <div class="form-group">
              <input type="file" name="gambar_1" id="logoInput<?= $row['id'] ?>" class="form-control">
            </div>
            <div>
              <img id="previewLogo<?= $row['id'] ?>" src="<?= base_url('images/about/' . $row['gambar_1']) ?>" alt="Pratinjau Logo" style="max-width: 100px; height: auto;">
            </div>
            <label for="gambar_2">Gambar 2:</label>
            <div class="form-group">
              <input type="file" name="gambar_2" id="logoInput<?= $row['id'] ?>" class="form-control">
            </div>
            <div>
              <img id="previewLogo<?= $row['id'] ?>" src="<?= base_url('images/about/' . $row['gambar_2']) ?>" alt="Pratinjau Logo" style="max-width: 100px; height: auto;">
            </div>
            <br>
            <label for="deskripsi">Deskripsi:</label>
            <div class="form-group">
              <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="10"><?= $row['deskripsi'] ?></textarea>
            </div>
            <label for="kelebihan">Kelebihan:</label>
            <div class="form-group">
              <input type="text" name="kelebihan_1" id="kelebihan_1" class="form-control" value="<?= $row['kelebihan_1'] ?>" required>
              <br>
              <input type="text" name="kelebihan_2" id="kelebihan_2" class="form-control" value="<?= $row['kelebihan_2'] ?>" required>
              <br>
              <input type="text" name="kelebihan_3" id="kelebihan_3" class="form-control" value="<?= $row['kelebihan_3'] ?>" required>
              <br>
              <input type="text" name="kelebihan_4" id="kelebihan_4" class="form-control" value="<?= $row['kelebihan_4'] ?>" required>
              <br>
              <input type="text" name="kelebihan_5" id="kelebihan_5" class="form-control" value="<?= $row['kelebihan_5'] ?>" required>
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
  <?php foreach ($about as $key => $row) : ?>
    previewImage('logoInput<?= $row['id'] ?>', 'previewLogo<?= $row['id'] ?>');
  <?php endforeach; ?>
</script>

<!-- End Edit Modal -->