<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\CompanyModel;

class About extends BaseController
{
  protected $about;
  protected $company;

  public function __construct()
  {
    $this->about   = new AboutModel();
    $this->company = new CompanyModel();
    helper('form');
  }

  public function index()
  {
    $data = [
      'title'     => 'Pengaturan Bagian Tentang',
      'about'     => $this->about->findAll(),
      'logo'      => $this->company->first(),
    ];

    return view('backend/pengaturan_web/about/index', $data);
  }

  public function update($id)
  {
    $model = new AboutModel();

    // Ambil data input
    $data = [
      'deskripsi'   => $this->request->getPost('deskripsi'),
      'kelebihan_1' => $this->request->getPost('kelebihan_1'),
      'kelebihan_2' => $this->request->getPost('kelebihan_2'),
      'kelebihan_3' => $this->request->getPost('kelebihan_3'),
      'kelebihan_4' => $this->request->getPost('kelebihan_4'),
      'kelebihan_5' => $this->request->getPost('kelebihan_5'),
    ];

    // Ambil file gambar_1
    $fileGambar1 = $this->request->getFile('gambar_1');
    if ($fileGambar1 && $fileGambar1->isValid() && !$fileGambar1->hasMoved()) {
      // Hapus file lama jika ada
      $company = $model->find($id);
      if ($company['gambar_1'] && file_exists('images/about/' . $company['gambar_1'])) {
        unlink('images/about/' . $company['gambar_1']);
      }

      // Pindahkan file gambar_1 ke folder
      $newGambar1Name = $fileGambar1->getRandomName();
      if ($fileGambar1->move('images/about', $newGambar1Name)) {
        $data['gambar_1'] = $newGambar1Name; // Simpan nama file baru
      } else {
        return redirect()->back()->with('error', 'Gambar 1 gagal diunggah.');
      }
    }

    // Ambil file gambar_2
    $fileGambar2 = $this->request->getFile('gambar_2');
    if ($fileGambar2 && $fileGambar2->isValid() && !$fileGambar2->hasMoved()) {
      // Hapus file lama jika ada
      if ($company['gambar_2'] && file_exists('images/about/' . $company['gambar_2'])) {
        unlink('images/about/' . $company['gambar_2']);
      }

      // Pindahkan file gambar_2 ke folder
      $newGambar2Name = $fileGambar2->getRandomName();
      if ($fileGambar2->move('images/about', $newGambar2Name)) {
        $data['gambar_2'] = $newGambar2Name; // Simpan nama file baru
      } else {
        return redirect()->back()->with('error', 'Gambar 2 gagal diunggah.');
      }
    }

    // Update data ke database
    if ($model->update($id, $data)) {
      return redirect()->to('/about')->with('success', 'Data berhasil diperbarui!');
    }

    return redirect()->back()->with('error', 'Gagal memperbarui data.');
  }
}
