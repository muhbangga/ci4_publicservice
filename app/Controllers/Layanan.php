<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\LayananModel;
use App\Models\SeksiModel;

class Layanan extends BaseController
{
    protected $layanan;
    protected $seksi;
    protected $company;

    public function __construct()
    {
        // Load Form Helper
        helper('form');

        $this->layanan = new LayananModel();
        $this->seksi   = new SeksiModel();
        $this->company = new CompanyModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Data Layanan',
            'menu'      => 'Master',
            'submenu'   => 'Data Layanan',
            'logo'      => $this->company->first(),
            'layanan'   => $this->layanan->getJoin(),
            'seksi'     => $this->seksi->findAll(),

        ];
        return view('backend/data_layanan/index', $data);
    }

    public function add()
    {
        $rules = [
            'nama_layanan' => [
                'rules'  => 'required|is_unique[tb_layanan.nama_layanan]|min_length[5]|max_length[255]',
                'errors' => [
                    'required'   => 'Form nama layanan tidak boleh kosong.',
                    'is_unique'  => 'Data sudah tersedia',
                    'min_length' => 'Input nama layanan minimal harus terdiri dari 5 karakter.',
                    'max_length' => 'Input nama layanan tidak boleh lebih dari 255 karakter.'
                ]
            ],
            'seksi_pengelola' => [
                'rules'  => 'required|max_length[11]',
                'errors' => [
                    'required'   => 'Form pengelola tidak boleh kosong.',
                    'max_length' => 'Input nama layanan tidak boleh lebih dari 11 karakter.'
                ]
            ],
        ];

        // Menjalankan proses validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        // Ambil data dari request (POST)
        $data = [
            'nama_layanan'    => $this->request->getPost('nama_layanan'),
            'seksi_pengelola' => $this->request->getPost('seksi_pengelola'),
        ];

        // Lakukan insert data layanan
        $layanan = $this->layanan->insert($data);

        if ($layanan) {
            // Redirect dengan pesan sukses jika insert berhasil
            return redirect()->to('/layanan/index')->with('success', 'Data berhasil ditambahkan');
        } else {
            // Redirect dengan pesan error jika insert gagal
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }


    public function update($id)
    {

        // Cek apakah layanan dengan ID tersebut ada
        $layanan = $this->layanan->find($id);  // Cukup gunakan $id

        if (isset($layanan)) {
            // Ambil data dari request (POST)
            $data = [
                'nama_layanan' => $this->request->getPost('nama_layanan'),
                'seksi_pengelola'     => $this->request->getPost('seksi_pengelola'),
                'status'     => $this->request->getPost('status'),
            ];

            // Lakukan update data layanan
            $this->layanan->update($id, $data);  // Pastikan ID diberikan sebagai parameter

            // Redirect ke halaman daftar layanan
            return redirect()->to('/layanan/index')->with('success', 'Data berhasil diupdate');
        } else {
            // Jika ID layanan tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function delete($id)
    {
        $layanan = $this->layanan->find($id);
        if (isset($layanan)) {

            // Lakukan update data layanan
            $this->layanan->delete($id);  // Pastikan ID diberikan sebagai parameter

            // Redirect ke halaman daftar layanan
            return redirect()->to('/layanan/index')->with('success', 'Data berhasil dihapus');
        } else {
            // Jika ID layanan tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }
}
