<?php

namespace App\Models;

use CodeIgniter\Model;

class SeksiModel extends Model
{
  protected $table      = 'tb_seksi';
  protected $primaryKey = 'id';
  protected $allowedFields = ['nama_seksi'];
}
