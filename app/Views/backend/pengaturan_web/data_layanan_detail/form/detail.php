<?php foreach ($layanan_detail as $key => $row) : ?>
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
                <td width="30%"><strong>Nama Layanan</strong></td>
                <td width="70%">: <?= $row['layanan'] ?></td>
              </tr>
              <tr>
                <td width="30%"><strong>Prosedur</strong></td>
                <td width="70%">
                  <ol>

                    <?php if ($row['prosedur_1'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['prosedur_1'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($row['prosedur_2'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['prosedur_2'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($row['prosedur_3'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['prosedur_3'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($row['prosedur_4'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['prosedur_4'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($row['prosedur_5'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['prosedur_5'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($row['prosedur_6'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['prosedur_6'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($row['prosedur_7'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['prosedur_7'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($row['prosedur_8'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['prosedur_8'] ?>
                      </li>
                    <?php } ?>

                  </ol>
                </td>
              </tr>
              <tr>
                <td width="30%"><strong>Persyaratan</strong></td>
                <td width="70%">
                  <ol>
                    <?php if ($row['persyaratan_1'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_1'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($row['persyaratan_2'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_2'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($row['persyaratan_3'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_3'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($row['persyaratan_4'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_4'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($row['persyaratan_5'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_5'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($row['persyaratan_6'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_6'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($row['persyaratan_7'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_7'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($row['persyaratan_8'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_8'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($row['persyaratan_9'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_9'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($row['persyaratan_10'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_10'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($row['persyaratan_11'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_11'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($row['persyaratan_12'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_12'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($row['persyaratan_13'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_13'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($row['persyaratan_14'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_14'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($row['persyaratan_15'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_15'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($row['persyaratan_16'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_16'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($row['persyaratan_17'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_17'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($row['persyaratan_18'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_18'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($row['persyaratan_19'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_19'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($row['persyaratan_20'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $row['persyaratan_20'] ?>
                      </li>
                    <?php } ?>

                  </ol>
                </td>
              </tr>
              <tr>
                <td width="30%"><strong>Waktu Pelayanan</strong></td>
                <td width="70%">: <?= $row['waktu_pelayanan'] ?></td>
              </tr>
              <tr>
                <td width="30%"><strong>Biaya Pelayanan</strong></td>
                <td width="70%">: <?= $row['biaya_pelayanan'] ?></td>
              </tr>
              <tr>
                <td width="30%"><strong>Produk Pelayanan</strong></td>
                <td width="70%">: <?= $row['produk_layanan'] ?></td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td class="text-center" colspan="2">
                  <button type="button" class="btn btn-warning btn-sm " data-bs-toggle="modal"
                    data-bs-target="#editForm<?= $row['id'] ?>">Edit</button>
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                    data-bs-target="#deleteForm<?= $row['id'] ?>">Hapus</button>
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