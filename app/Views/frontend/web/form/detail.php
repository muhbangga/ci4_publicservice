<?php foreach ($layanan as $key => $value) : ?>
  <div class="modal fade text-left modal-borderless" id="border-less_detailModal<?= $value['id'] ?>" tabindex="-1"
    role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Layanan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table" style="width: 100%;">
            <tbody width="100%">
              <tr>
                <td><strong>Layanan</strong>
                  <br>
                  <?= $value['layanan'] ?>
                </td>
              </tr>
              <tr>
                <td><strong>Persyaratan</strong>
                  <br>
                  <ol>
                    <?php if ($value['persyaratan_1'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_1'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($value['persyaratan_2'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_2'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($value['persyaratan_3'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_3'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($value['persyaratan_4'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_4'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($value['persyaratan_5'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_5'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($value['persyaratan_6'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_6'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($value['persyaratan_7'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_7'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($value['persyaratan_8'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_8'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($value['persyaratan_9'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_9'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($value['persyaratan_10'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_10'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($value['persyaratan_11'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_11'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($value['persyaratan_12'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_12'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($value['persyaratan_13'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_13'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($value['persyaratan_14'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_14'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($value['persyaratan_15'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_15'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($value['persyaratan_16'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_16'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($value['persyaratan_17'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_17'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($value['persyaratan_18'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_18'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($value['persyaratan_19'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_19'] ?>
                      </li>
                    <?php } ?>

                    <?php if ($value['persyaratan_20'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['persyaratan_20'] ?>
                      </li>
                    <?php } ?>
                  </ol>
                </td>
              </tr>
              <tr>
                <td><strong>Prosedur</strong>
                  <br>
                  <ol>

                    <?php if ($value['prosedur_1'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['prosedur_1'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($value['prosedur_2'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['prosedur_2'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($value['prosedur_3'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['prosedur_3'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($value['prosedur_4'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['prosedur_4'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($value['prosedur_5'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['prosedur_5'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($value['prosedur_6'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['prosedur_6'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($value['prosedur_7'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['prosedur_7'] ?>
                      </li>
                    <?php } ?>


                    <?php if ($value['prosedur_8'] == null) { ?>
                    <?php } else { ?>
                      <li>
                        <?= $value['prosedur_8'] ?>
                      </li>
                    <?php } ?>

                  </ol>
                </td>

                </td>
              </tr>

              <tr>
                <td><strong>Waktu Pelayanan</strong>
                  <br>
                  <?= $value['waktu_pelayanan'] ?>
                </td>
              </tr>
              <tr>
                <td><strong>Biaya Pelayanan</strong>
                  <br>
                  <?= $value['biaya_pelayanan'] ?>
                </td>
              </tr>
              <tr>
                <td><strong>Produk Layanan</strong>
                  <br>
                  <?= $value['produk_layanan'] ?>
                </td>
              </tr>
            </tbody>

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