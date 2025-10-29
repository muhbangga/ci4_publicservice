<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CompanyModel;

class Company extends BaseController
{
  protected $company;

  public function __construct()
  {
    $this->company = new CompanyModel();
    helper('form');
  }

  public function index()
  {
    // Fungsi helper dari Myth\Auth untuk mendapatkan data pengguna yang sedang login
    $data = [
      'title'     => 'Profil Instansi',
      'company'   => $this->company->findAll(),
      'logo'      => $this->company->first(),
    ];

    return view('backend/pengaturan_web/data_instansi/index', $data);
  }

  public function update($id)
  {
    $model = new CompanyModel();

    // Ambil data input
    $data = [
      'judul_web' => $this->request->getPost('judul_web'),
      'instansi'  => $this->request->getPost('instansi'),
      'alamat'    => $this->request->getPost('alamat'),
      'no_telp'   => $this->request->getPost('no_telp'),
      'email'    => $this->request->getPost('email'),
      'instagram' => $this->request->getPost('instagram'),
      'tiktok'    => $this->request->getPost('tiktok'),
      'facebook'  => $this->request->getPost('facebook'),
    ];

    // Ambil file logo
    $fileLogo = $this->request->getFile('logo');
    if ($fileLogo && $fileLogo->isValid() && !$fileLogo->hasMoved()) {
      // Hapus file lama
      $company = $model->find($id);
      if ($company['logo'] && file_exists('images/logo/' . $company['logo'])) {
        unlink('images/logo/' . $company['logo']);
      }

      // Pindahkan file baru
      $newLogoName = $fileLogo->getRandomName();
      if ($fileLogo->move('images/logo', $newLogoName)) {
        $data['logo'] = $newLogoName; // Simpan nama file baru
      } else {
        return redirect()->back()->with('error', 'Logo gagal diunggah.');
      }
    }

    // Update data
    if ($model->update($id, $data)) {
      return redirect()->to('/company')->with('success', 'Data berhasil diperbarui!');
    }

    return redirect()->back()->with('error', 'Gagal memperbarui data.');
  }
}
