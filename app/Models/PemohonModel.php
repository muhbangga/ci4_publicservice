<?php

namespace App\Models;

use CodeIgniter\Model;

class PemohonModel extends Model
{
  protected $table          = 'tb_pemohon';
  protected $primaryKey     = 'id';
  protected $allowedFields  = ['asal_pemohon'];
}
