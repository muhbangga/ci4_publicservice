<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutModel extends Model
{
  protected $table      = 'tb_about';
  protected $primaryKey = 'id';
  protected $allowedFields = ['gambar_1', 'gambar_2', 'deskripsi', 'kelebihan_1', 'kelebihan_2', 'kelebihan_3', 'kelebihan_4', 'kelebihan_5'];
}
