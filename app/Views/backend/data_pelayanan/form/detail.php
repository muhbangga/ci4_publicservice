<?php foreach ($pelayanan as $key => $row) : ?>
  <div class="modal fade text-left modal-borderless" id="border-less_detailModal<?= $row['id'] ?>" tabindex="-1"
    role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Data</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
            aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-striped" style="width: 100; font-size: 14px;">

            <tbody>
              <tr>
                <td width="30%"><b>Nama Pemohon</b></td>
                <td width="70%">: <?= $row['nama_lengkap'] ?></td>
              </tr>
              <tr>
                <td width="30%"><b>No. Handphone</b></td>
                <td width="70%">: <?= $row['no_handphone'] ?></td>
              </tr>
              <tr>
                <td width="30%"><b>E-mail</b></td>
                <td width="70%">: <?= $row['email'] ?></td>
              </tr>
              <tr>
                <td width="30%"><b>Jenis Kelamin</b></td>
                <td width="70%">: <?= $row['jenis_kelamin'] ?></td>
              </tr>
              <tr>
                <td width="30%"><b>Agama</b></td>
                <td width="70%">: <?= $row['agama'] ?></td>
              </tr>
              <tr>
                <td width="30%"><b>Asal Pemohon</b></td>
                <td width="70%">: <?= $row['asal_pemohon'] ?></td>
              </tr>
              <tr>
                <td width="30%"><b>Nama Layanan</b></td>
                <td width="70%">: <?= $row['nama_layanan'] ?></td>
              </tr>
              <tr>
                <td width="30%"><b>Lampiran</b></td>
                <td width="70%">: <?= $row['lampiran'] ?>
                  <?php if (!empty($row['lampiran'])): ?>
                    <iframe src="<?= base_url('doc/masuk/' . $row['lampiran']) ?>" width="100%" height="500px"></iframe>
                    <br>
                    <a href="<?= base_url('doc/masuk/' . $row['lampiran']) ?>" class="btn btn-primary btn-sm" style="font-size: 14px; padding: 2px 4px;" download>
                      <i class="fa fa-file-pdf"></i> Download
                    </a>
                  <?php else: ?>
                    Tidak ada lampiran
                  <?php endif; ?>
                </td>
              </tr>
              <tr>
                <td width="30%"><b>Status</b></td>
                <td width="70%">:
                  <?php if ($row['status'] == 1) { ?>
                    Diterima PTSP
                    <?php
                    $tanggal = new DateTime($row['updated_at']);
                    // Format tanggal: hari bulan tahun jam:menit:detik
                    echo $tanggal->format('j') . ' ' . bulan($tanggal->format('n')) . ' ' . $tanggal->format('Y');
                    ?>
                    <a href="<?= base_url('/pelayanan/diproses_unit/' . $row['id']) ?>" class="btn btn-info btn-sm" style="font-size: 14px; padding: 2px 4px;"><i class="fa fa-history"></i> Perbarui</a>
                  <?php } elseif ($row['status'] == 2) { ?>
                    Diproses Unit
                    <?php
                    $tanggal = new DateTime($row['updated_at']);
                    // Format tanggal: hari bulan tahun
                    echo $tanggal->format('j') . ' ' . bulan($tanggal->format('n')) . ' ' . $tanggal->format('Y');
                    ?>

                    <a href="<?= base_url('/pelayanan/selesai/' . $row['id']) ?>" class="btn btn-success btn-sm" style="font-size: 14px; padding: 2px 4px;"><i class="fa fa-history"></i> Perbarui</a>
                  <?php } elseif ($row['status'] == 3) { ?>
                    Selesai
                    <?php
                    $tanggal = new DateTime($row['updated_at']);
                    // Format tanggal: hari bulan tahun
                    echo $tanggal->format('j') . ' ' . bulan($tanggal->format('n')) . ' ' . $tanggal->format('Y');
                    ?>
                  <?php } else { ?>
                    Menunggu Konfirmasi
                    <a href="<?= base_url('/pelayanan/diproses_ptsp/' . $row['id']) ?>" class="btn btn-warning btn-sm" style="font-size: 14px; padding: 2px 4px;"><i class="fa fa-history"></i> Perbarui</a>
                  <?php } ?>
                </td>
              </tr>

              <tr>
                <td width="30%"><b>Data Masuk</b></td>
                <td width="70%">:
                  <?php
                  $tanggal = new DateTime($row['created_at']);
                  echo $tanggal->format('j') . ' ' . bulan($tanggal->format('n')) . ' ' . $tanggal->format('Y');
                  ?>
                </td>
              </tr>

              <tr>
                <td width="30%"><b>Berkas</b></td>
                <td width="70%">:
                  <?php if ($row['status'] == 0) { ?>
                    <i><span>Berkas Belum Selesai</span></i>
                  <?php } elseif ($row['status'] == 1) { ?>
                    <i><span>Berkas Belum Selesai</span></i>
                  <?php } elseif ($row['status'] == 2) { ?>
                    <i><span>Berkas Belum Selesai</span></i>
                  <?php } elseif ($row['lampiran_jadi'] == 'default.pdf') { ?>
                    <i>Lakukan edit untuk unggah berkas</i>
                  <?php } else { ?>
                    <?= $row['lampiran_jadi'] ?>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <?php if ($row['status'] == 3) { ?>
                  <td width="30%"><b>Penerima / Yang Mengambil</b></td>
                  <td width="70%">: <?= $row['penerima'] ?>
                  <?php } ?>

                  </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td class="text-center" colspan="2">
                  <button type="button" class="btn btn-warning btn-sm " style="font-size: 14px; padding: 2px 4px;" data-bs-toggle="modal"
                    data-bs-target="#editForm<?= $row['id'] ?>"><i class="fa fa-pen-square"></i> Edit</button>
                  <button type="button" class="btn btn-danger btn-sm" style="font-size: 14px; padding: 2px 4px;" data-bs-toggle="modal"
                    data-bs-target="#deleteForm<?= $row['id'] ?>"><i class="fa fa-trash-alt"></i> Hapus</button>

                </td>
              </tr>
            </tfoot>
          </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Tutup</span>
          </button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>