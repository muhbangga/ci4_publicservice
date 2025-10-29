<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\LayananDetailModel;
use App\Models\LayananModel;

class LayananDetail extends BaseController
{
    protected $layanan_detail;
    protected $layanan;
    protected $company;

    public function __construct()
    {
        // Load Form Helper
        helper('form');

        $this->layanan_detail = new LayananDetailModel();
        $this->layanan        = new LayananModel();
        $this->company        = new CompanyModel();
    }

    public function index()
    {
        $data = [
            'title'            => 'Pengaturan Persyaratan',
            'menu'             => 'Master',
            'submenu'          => 'Data Layanan',
            'logo'             => $this->company->first(),
            'layanan_detail'   => $this->layanan_detail->getJoin(),
            'layanan'          => $this->layanan->findAll(),
        ];
        return view('backend/pengaturan_web/data_layanan_detail/index', $data);
    }

    public function add()
    {
        // Deskripsi aturan validasi
        $rules = [
            'layanan' => [
                'rules'  => 'required|is_unique[tb_agama.agama]',
                'errors' => [
                    'required'   => 'Form layanan tidak boleh kosong.',
                    'is_unique'  => 'Data sudah tersedia',

                ]
            ],
        ];

        // Menjalankan proses validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        // Ambil data dari request (POST)
        $data = [
            'layanan'         => $this->request->getPost('layanan'),
            'persyaratan_1'   => $this->request->getPost('persyaratan_1'),
            'persyaratan_2'   => $this->request->getPost('persyaratan_2'),
            'persyaratan_3'   => $this->request->getPost('persyaratan_3'),
            'persyaratan_4'   => $this->request->getPost('persyaratan_4'),
            'persyaratan_5'   => $this->request->getPost('persyaratan_5'),
            'persyaratan_6'   => $this->request->getPost('persyaratan_6'),
            'persyaratan_7'   => $this->request->getPost('persyaratan_7'),
            'persyaratan_8'   => $this->request->getPost('persyaratan_8'),
            'persyaratan_9'   => $this->request->getPost('persyaratan_9'),
            'persyaratan_10'  => $this->request->getPost('persyaratan_10'),
            'persyaratan_11'  => $this->request->getPost('persyaratan_11'),
            'persyaratan_12'  => $this->request->getPost('persyaratan_12'),
            'persyaratan_13'  => $this->request->getPost('persyaratan_13'),
            'persyaratan_14'  => $this->request->getPost('persyaratan_14'),
            'persyaratan_15'  => $this->request->getPost('persyaratan_15'),
            'persyaratan_16'  => $this->request->getPost('persyaratan_16'),
            'persyaratan_17'  => $this->request->getPost('persyaratan_17'),
            'persyaratan_18'  => $this->request->getPost('persyaratan_18'),
            'persyaratan_19'  => $this->request->getPost('persyaratan_19'),
            'persyaratan_20'  => $this->request->getPost('persyaratan_20'),
            'prosedur_1'      => $this->request->getPost('prosedur_1'),
            'prosedur_2'      => $this->request->getPost('prosedur_2'),
            'prosedur_3'      => $this->request->getPost('prosedur_3'),
            'prosedur_4'      => $this->request->getPost('prosedur_4'),
            'prosedur_5'      => $this->request->getPost('prosedur_5'),
            'prosedur_6'      => $this->request->getPost('prosedur_6'),
            'prosedur_7'      => $this->request->getPost('prosedur_7'),
            'prosedur_8'      => $this->request->getPost('prosedur_8'),
            'waktu_pelayanan' => $this->request->getPost('waktu_pelayanan'),
            'biaya_pelayanan' => $this->request->getPost('biaya_pelayanan'),
            'produk_layanan'  => $this->request->getPost('produk_layanan'),
        ];
        // 
        // Lakukan insert data layanan
        $layanan_detail = $this->layanan_detail->insert($data);

        if ($layanan_detail) {
            // Redirect dengan pesan sukses jika insert berhasil
            return redirect()->to('/layanandetail/index')->with('success', 'Data berhasil ditambahkan');
        } else {
            // Redirect dengan pesan error jika insert gagal
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function detail($id)
    {

        // Mengambil data berdasarkan ID
        $layanan_detail = $this->layanan_detail->find($id);

        // Menampilkan data pada view jika data ditemukan
        if ($layanan_detail) {
            return view('backend/pengaturan_web/data_layanan_detail/index', ['pelayanan' => $layanan_detail]);
        } else {
            return redirect()->to('/layanandetail/index'); // Redirect jika data tidak ditemukan
        }
    }


    public function update($id)
    {

        // Cek apakah layanan_detail dengan ID tersebut ada
        $layanan_detail = $this->layanan_detail->find($id);  // Cukup gunakan $id

        if (isset($layanan_detail)) {
            // Ambil data dari request (POST)
            $data = [
                'layanan'         => $this->request->getPost('layanan'),
                'persyaratan_1'   => $this->request->getPost('persyaratan_1'),
                'persyaratan_2'   => $this->request->getPost('persyaratan_2'),
                'persyaratan_3'   => $this->request->getPost('persyaratan_3'),
                'persyaratan_4'   => $this->request->getPost('persyaratan_4'),
                'persyaratan_5'   => $this->request->getPost('persyaratan_5'),
                'persyaratan_6'   => $this->request->getPost('persyaratan_6'),
                'persyaratan_7'   => $this->request->getPost('persyaratan_7'),
                'persyaratan_8'   => $this->request->getPost('persyaratan_8'),
                'persyaratan_9'   => $this->request->getPost('persyaratan_9'),
                'persyaratan_10'  => $this->request->getPost('persyaratan_10'),
                'persyaratan_11'  => $this->request->getPost('persyaratan_11'),
                'persyaratan_12'  => $this->request->getPost('persyaratan_12'),
                'persyaratan_13'  => $this->request->getPost('persyaratan_13'),
                'persyaratan_14'  => $this->request->getPost('persyaratan_14'),
                'persyaratan_15'  => $this->request->getPost('persyaratan_15'),
                'persyaratan_16'  => $this->request->getPost('persyaratan_16'),
                'persyaratan_17'  => $this->request->getPost('persyaratan_17'),
                'persyaratan_18'  => $this->request->getPost('persyaratan_18'),
                'persyaratan_19'  => $this->request->getPost('persyaratan_19'),
                'persyaratan_20'  => $this->request->getPost('persyaratan_20'),
                'prosedur_1'      => $this->request->getPost('prosedur_1'),
                'prosedur_2'      => $this->request->getPost('prosedur_2'),
                'prosedur_3'      => $this->request->getPost('prosedur_3'),
                'prosedur_4'      => $this->request->getPost('prosedur_4'),
                'prosedur_5'      => $this->request->getPost('prosedur_5'),
                'prosedur_6'      => $this->request->getPost('prosedur_6'),
                'prosedur_7'      => $this->request->getPost('prosedur_7'),
                'prosedur_8'      => $this->request->getPost('prosedur_8'),
                'waktu_pelayanan' => $this->request->getPost('waktu_pelayanan'),
                'biaya_pelayanan' => $this->request->getPost('biaya_pelayanan'),
                'produk_layanan'  => $this->request->getPost('produk_layanan'),
            ];

            // Lakukan update data layanan
            $this->layanan_detail->update($id, $data);  // Pastikan ID diberikan sebagai parameter

            // Redirect ke halaman daftar layanan
            return redirect()->to('/layanandetail/index')->with('success', 'Data berhasil diupdate');
        } else {
            // Jika ID layanan tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function delete($id)
    {
        $layanan_detail = $this->layanan_detail->find($id);
        if (isset($layanan_detail)) {

            // Lakukan update data layanan
            $this->layanan_detail->delete($id);  // Pastikan ID diberikan sebagai parameter

            // Redirect ke halaman daftar layanan_detail
            return redirect()->to('/layanandetail/index')->with('success', 'Data berhasil dihapus');
        } else {
            // Jika ID layanan_detail tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }
}
