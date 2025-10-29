<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
  protected $table      = 'tb_profile_com';
  protected $primaryKey = 'id';
  protected $allowedFields = ['logo', 'judul_web', 'instansi', 'alamat', 'no_telp', 'email', 'instagram', 'tiktok', 'facebook'];
}
