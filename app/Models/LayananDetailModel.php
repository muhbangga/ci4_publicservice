<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananDetailModel extends Model
{
  protected $table      = 'tb_layanan_detail';
  protected $primaryKey = 'id';
  protected $allowedFields = ['layanan', 'persyaratan_1', 'persyaratan_2', 'persyaratan_3', 'persyaratan_4', 'persyaratan_5', 'persyaratan_6', 'persyaratan_7', 'persyaratan_8', 'persyaratan_9', 'persyaratan_10', 'persyaratan_11', 'persyaratan_12', 'persyaratan_13', 'persyaratan_14', 'persyaratan_15', 'persyaratan_16', 'persyaratan_17', 'persyaratan_18', 'persyaratan_19', 'persyaratan_20', 'prosedur_1', 'prosedur_2', 'prosedur_3', 'prosedur_4', 'prosedur_5', 'prosedur_6', 'prosedur_7', 'prosedur_8', 'waktu_pelayanan', 'biaya_pelayanan', 'produk_layanan'];

  public function getJoin()
  {
    return $this->select('tb_layanan_detail.id, tb_layanan_detail.*, tb_layanan.nama_layanan as layanan, tb_seksi.nama_seksi')
      ->join('tb_layanan', 'tb_layanan.id = tb_layanan_detail.layanan')
      ->join('tb_seksi', 'tb_seksi.id = tb_layanan.seksi_pengelola')
      ->findAll();
  }
  public function getFront()
  {
    return $this->select('tb_layanan_detail.id, tb_layanan_detail.*, tb_layanan.nama_layanan as layanan')
      ->join('tb_layanan', 'tb_layanan.id = tb_layanan_detail.layanan')
      ->orderBy('id', 'ASC')
      ->findAll(4, 0);
  }
}
