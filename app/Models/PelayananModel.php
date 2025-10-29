<?php

namespace App\Models;

use CodeIgniter\Model;

class PelayananModel extends Model
{
  protected $table      = 'tb_pelayanan';
  protected $primaryKey = 'id';
  protected $allowedFields = ['nama_lengkap',  'e_tiket',  'no_handphone',  'email', 'alamat',  'jenis_kelamin',  'agama',  'pemohon',  'layanan',  'lampiran', 'lampiran_jadi', 'penerima', 'status', 'saran', 'penilaian'];


  public function getJoin()
  {
    return $this->select('tb_pelayanan.*, tb_pemohon.asal_pemohon, tb_layanan.nama_layanan, tb_agama.agama, tb_jk.jenis_kelamin')
      ->join('tb_pemohon', 'tb_pemohon.id = tb_pelayanan.pemohon')
      ->join('tb_layanan', 'tb_layanan.id = tb_pelayanan.layanan')
      ->join('tb_agama', 'tb_agama.id = tb_pelayanan.agama')
      ->join('tb_jk', 'tb_jk.id = tb_pelayanan.jenis_kelamin')
      ->orderBy('tb_pelayanan.created_at', 'DESC') // Urutkan berdasarkan kolom created_at
      ->findAll();
  }

  public function getJoinForEmail($idPelayanan)
  {
    return $this->select('tb_pelayanan.*, tb_pemohon.asal_pemohon, tb_layanan.nama_layanan, tb_agama.agama, tb_jk.jenis_kelamin')
      ->join('tb_pemohon', 'tb_pemohon.id = tb_pelayanan.pemohon')
      ->join('tb_layanan', 'tb_layanan.id = tb_pelayanan.layanan')
      ->join('tb_agama', 'tb_agama.id = tb_pelayanan.agama')
      ->join('tb_jk', 'tb_jk.id = tb_pelayanan.jenis_kelamin')
      ->where('tb_pelayanan.id', $idPelayanan)
      ->first();
  }

  public function trackLayanan($eTiket, $noHandphone)
  {
    return $this->select('tb_pelayanan.*, tb_pemohon.asal_pemohon, tb_layanan.nama_layanan, tb_agama.agama, tb_jk.jenis_kelamin')
      ->join('tb_pemohon', 'tb_pemohon.id = tb_pelayanan.pemohon')
      ->join('tb_layanan', 'tb_layanan.id = tb_pelayanan.layanan')
      ->join('tb_agama', 'tb_agama.id = tb_pelayanan.agama')
      ->join('tb_jk', 'tb_jk.id = tb_pelayanan.jenis_kelamin')
      ->where('tb_pelayanan.e_tiket', $eTiket)
      ->where('tb_pelayanan.no_handphone', $noHandphone)
      ->get()
      ->getResultArray();
  }

  public function isSurveyFilled($pelayananId)
  {
    return $this->db->table('tb_survey_kepuasan')
      ->where('id', $pelayananId)
      ->countAllResults() > 0;
  }

  public function getPenilaianData()
  {
    return $this->db->table('tb_pelayanan')
      ->select('penilaian, layanan')  // Ambil penilaian dan layanan untuk dihitung
      ->get()
      ->getResultArray(); // Mengambil hasil sebagai array
  }
}
