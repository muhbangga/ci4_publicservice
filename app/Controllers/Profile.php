<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CompanyModel;
use Myth\Auth\Models\UserModel;

class Profile extends BaseController
{
  protected $company;

  public function __construct()
  {
    $this->company = new CompanyModel();
  }

  public function index()
  {
    // Fungsi helper dari Myth\Auth untuk mendapatkan data pengguna yang sedang login
    $data = [
      'title'     => 'Profil',
      'logo'      => $this->company->first(),
      'user'      => user(),

    ];

    return view('backend/profile/index', $data);
  }

  public function update()
  {
    $user = user(); // Data pengguna yang sedang login
    $userModel = new UserModel();

    // Ambil data dari form
    $data = $this->request->getPost();

    // Validasi data
    if (!$this->validate([
      'fullname' => 'permit_empty|min_length[3]', // Kolom opsional
      'email'    => 'permit_empty|valid_email',  // Kolom opsional
      'username' => 'permit_empty|min_length[3]|alpha_numeric' // Kolom opsional
    ])) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Menyiapkan data untuk diupdate hanya jika berbeda dari data lama
    $updateData = [];
    if (!empty($data['fullname']) && $data['fullname'] !== $user->fullname) {
      $updateData['fullname'] = $data['fullname'];
    }
    if (!empty($data['email']) && $data['email'] !== $user->email) {
      $updateData['email'] = $data['email'];
    }
    if (!empty($data['username']) && $data['username'] !== $user->username) {
      $updateData['username'] = $data['username'];
    }

    // Lakukan update jika ada perubahan
    if (!empty($updateData)) {
      if ($userModel->update($user->id, $updateData)) {
        return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui');
      } else {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui profil');
      }
    }

    // Jika tidak ada perubahan data
    return redirect()->back()->with('info', 'Tidak ada data yang diubah.');
  }
}
