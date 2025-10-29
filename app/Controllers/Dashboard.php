<?php

namespace App\Controllers;

use App\Models\SeksiModel;
use App\Models\LayananModel;
use App\Models\PelayananModel;
use App\Models\CompanyModel;

class Dashboard extends BaseController
{
    protected $seksi;
    protected $layanan;
    protected $pelayanan;
    protected $users;
    protected $company;

    public function __construct()
    {
        $this->seksi      = new SeksiModel();
        $this->layanan    = new LayananModel();
        $this->pelayanan  = new PelayananModel();
        $this->company    = new CompanyModel();
        $this->users      = new \Myth\Auth\Models\UserModel();
    }

    public function index()
    {
        $data = [
            'title'             => 'Dashboard',
            'menu'              => 'Dashboard',
            'submenu'           => 'Dashboard',
            'count_seksi'       => $this->seksi->countAllResults(),
            'count_layanan'     => $this->layanan->countAllResults(),
            'count_pelayanan'   => $this->pelayanan->countAllResults(),
            'count_users'       => $this->users->countAllResults(),
            'count_ptsp'       => $this->users->countUsersByRole('PTSP'),
            'logo'              => $this->company->first(),
            'penilaian'         => $this->pelayanan->getPenilaianData()
        ];
        return view('backend/dashboard/index', $data);
    }

    public function profile($id)
    {
        // Mengambil data berdasarkan ID
        $pelayanan = $this->pelayanan->find($id);

        if (isset($pelayanan)) {
            // Ambil data dari request (POST)
            $data = [
                'username'    => $this->request->getVar('username'),
            ];

            // Lakukan update status pelayanan
            $this->users->update($id, $data);  // Pastikan ID diberikan sebagai parameter

            // Redirect ke halaman daftar pelayanan
            return redirect()->to('/pelayanan/index')->with('success', 'Status berhasil diupdate');
        } else {
            // Jika ID layanan tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function showPenilaian()
    {
        // Ambil data penilaian
        $data = ['penilaian' => $this->pelayanan->getPenilaianData(),];

        // Kirim data ke view
        return view('backend/dashboard/index', $data);
    }
}
