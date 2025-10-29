<?php

namespace App\Models;

use CodeIgniter\Model;

class JkModel extends Model
{
  protected $table      = 'tb_jk';
  protected $primaryKey = 'id';
  protected $allowedFields = ['jenis_kelamin'];
}
