<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
  protected $table      = 'tb_layanan';
  protected $primaryKey = 'id';
  protected $allowedFields = ['nama_layanan', 'seksi_pengelola', 'status'];

  public function getJoin()
  {
    return $this->select('tb_layanan.*, tb_seksi.nama_seksi')
      ->join('tb_seksi', 'tb_seksi.id = tb_layanan.seksi_pengelola')
      ->findAll();
  }
}
