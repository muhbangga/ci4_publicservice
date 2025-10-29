<?php

namespace App\Models;

use CodeIgniter\Model;

class AgamaModel extends Model
{
  protected $table      = 'tb_agama';
  protected $primaryKey = 'id';
  protected $allowedFields = ['agama'];
}
