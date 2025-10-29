<?php

namespace App\Controllers;

use App\Models\PelayananModel;
use App\Models\LayananModel;
use App\Models\PemohonModel;
use App\Models\AgamaModel;
use App\Models\CompanyModel;
use App\Models\JkModel;
use CodeIgniter\I18n\Time;

class Pelayanan extends BaseController
{
    protected $pelayanan;
    protected $layanan;
    protected $pemohon;
    protected $agama;
    protected $jk;
    protected $company;

    public function __construct()
    {
        // Load Form Helper
        helper('form');
        $this->pelayanan = new PelayananModel();
        $this->layanan   = new LayananModel();
        $this->pemohon   = new PemohonModel();
        $this->agama     = new AgamaModel();
        $this->jk        = new JkModel();
        $this->company   = new CompanyModel();
    }

    public function index()
    {
        // Pastikan data dikirim dengan benar
        $data = [
            'title'     => 'Data Pelayanan',
            'menu'      => 'Master',
            'submenu'   => 'Data Pelayanan',
            'logo'      => $this->company->first(),
            'pelayanan' => $this->pelayanan->getJoin(),
            'layanan'   => $this->layanan->findAll(),
            'pemohon'   => $this->pemohon->findAll(),
            'agama'     => $this->agama->findAll(),
            'jk'        => $this->jk->findAll(),
        ];

        // Mengembalikan tampilan dengan data yang sudah diproses
        return view('backend/data_pelayanan/index', $data);
    }



    private function generateUniqueETicket(): string
    {
        $model = new PelayananModel();
        do {
            $eTiket = 'PTSP' . date('YmdHis') . rand(1000, 9999);
        } while ($model->where('e_tiket', $eTiket)->first());

        return $eTiket;
    }

    public function add()
    {

        // Validasi data
        $rules = [
            'nama_lengkap' => [
                'rules'  => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required'   => 'Form nama lengkap tidak boleh kosong',
                    'min_length' => 'Input nama lengkap minimal harus terdiri dari 3 karakter.',
                    'max_length' => 'Input nama lengkap tidak boleh lebih dari 50 karakter.'
                ]
            ],
            'no_handphone' => [
                'rules'  => 'required|',
                'errors' => [
                    'required'   => 'Form nomor handphone tidak boleh kosong',
                    'min_length' => 'Input nama nomor hp minimal harus terdiri dari 8 karakter.',
                    'max_length' => 'Input nama nomor hp boleh lebih dari 12 karakter.'
                ]
            ],
            'email' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Form email tidak boleh kosong',
                ]
            ],
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Form alamat tidak boleh kosong',
                ]
            ],

            'jenis_kelamin' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Form jenis kelamin tidak boleh kosong',
                ]
            ],
            'agama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Form agama tidak boleh kosong',
                ]
            ],
            'pemohon' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Form pemohon tidak boleh kosong',
                ]
            ],
            'layanan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Form nama layanan tidak boleh kosong',
                ]
            ],
            'lampiran' => [
                'rules'  => 'ext_in[lampiran,pdf]|max_size[lampiran,2048]',
                'errors' => [
                    'ext_in' => 'File lampiran harus berformat PDF.',
                    'max_size' => 'Ukuran file lampiran tidak boleh lebih dari 2MB.'
                ]
            ],
        ];

        // Menjalankan proses validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }
        // Buat kode e-tiket
        $eTiket = $this->generateUniqueETicket();

        // Memuat model LayananModel
        $layananModel = new LayananModel();

        // Ambil file lampiran
        $fileLampiran = $this->request->getFile('lampiran');

        // Ambil nama lengkap dari input
        $namaLengkap = $this->request->getPost('nama_lengkap');

        // Ambil ID layanan dari input
        $layananId = $this->request->getPost('layanan');

        // Dapatkan nama_layanan dari tabel tb_layanan
        $layananData = $layananModel->find($layananId);

        // Periksa apakah layanan ditemukan
        if ($layananData && isset($layananData['nama_layanan'])) {
            $permohonan = $layananData['nama_layanan'];
        } else {
            // Jika data layanan tidak ditemukan, kembalikan error
            return redirect()->back()->with('error', 'Layanan tidak ditemukan');
        }

        // Membuat nama file unik dengan timestamp
        $timestamp = date('Ymd_His'); // Format: TahunBulanTanggal_JamMenitDetik
        $namaLampiran = $namaLengkap . '_' . $permohonan . '_' . $timestamp . '.' . $fileLampiran->getExtension();

        // Pindahkan file ke folder 'doc/masuk' dengan nama baru
        $fileLampiran->move('doc/masuk/', $namaLampiran);

        // Data untuk disimpan di database
        $data = [
            'nama_lengkap'  => $namaLengkap,
            'e_tiket'       => $eTiket,
            'no_handphone'  => $this->request->getPost('no_handphone'),
            'email'         => $this->request->getPost('email'),
            'alamat'        => $this->request->getPost('alamat'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama'         => $this->request->getPost('agama'),
            'pemohon'       => $this->request->getPost('pemohon'),
            'layanan'       => $this->request->getPost('layanan'),
            'lampiran'      => $namaLampiran,
            'created_at'    => Time::now(),

        ];

        // Insert data ke database
        $idPelayanan = $this->pelayanan->insert($data);

        if (!$idPelayanan) {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }

        // Ambil data yang baru diinsert
        $pelayanan = $this->pelayanan->getJoinForEmail($idPelayanan);

        // Validasi data hasil query
        if (
            !$pelayanan || !isset($pelayanan['email'])
        ) {
            log_message('error', 'Data pelayanan tidak valid atau email tidak ditemukan.');
            return redirect()->back()->with('error', 'Data pelayanan tidak valid');
        }

        // Kirim email
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        $tanggal = date('d', strtotime($pelayanan['created_at']));
        $bulan = $bulan[date('n', strtotime($pelayanan['created_at']))];
        $tahun = date('Y', strtotime($pelayanan['created_at']));
        $toEmail = $pelayanan['email'];
        $subject = "Permohonan Layanan " . $pelayanan['e_tiket'] . " Berhasil Dikirim";
        $tanggalPermohonan = $tanggal . ' ' . $bulan . ' ' . $tahun;
        $message = "
        <div style='border: 1px solid #ddd; padding: 15px; border-radius: 5px; background-color: #f9f9f9; font-family: Arial, sans-serif;'>
            <p>Yth. Bapak/Ibu <strong>" . htmlspecialchars($pelayanan['nama_lengkap'], ENT_QUOTES, 'UTF-8') . "</strong>,</p> 
            
            <p>Berikut adalah detail permohonan layanan Anda:</p>
            
            <table style='width: 100%; border-collapse: collapse; margin-bottom: 20px;'>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Layanan</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['nama_layanan'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>E-Tiket</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['e_tiket'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Nomor Handphone</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['no_handphone'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Tanggal Permohonan</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($tanggalPermohonan, ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Status</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'> Berhasil Dikirim</td>
                </tr>
            </table>
            <p>Permohonan layanan Anda berhasil dikirim</p>
            <p><i>Gunakan kode <strong>E-tiket</strong> dan <strong>Nomor Handphone</strong> untuk melakukan cek status pada website</i></p>
            <p>Terima kasih telah menggunakan layanan kami, Jika Anda membutuhkan bantuan lebih lanjut, silakan hubungi kami melalui</p>
            <table style='width: 100%; border-collapse: collapse; margin-bottom: 5px;'>
                <tr>
                    <td style='width: 10%; font-weight: bold; padding: 8px;'>Petugas</td>
                    <td style='padding: 8px;'>: PTSP Kemenag Kab. Pekalongan</td>
                </tr>
                <tr>
                    <td style='width: 10%; font-weight: bold; padding: 8px;'>Telp</td>
                    <td style='padding: 8px;'>: (0285)38540</td>
                </tr>
            </table>
            <br>
            <p>Salam,</p>
            <p><strong>Unit PTSP Kantor Kementrian Agama Kab. Pekalongan</strong></p>
        </div>
    ";

        // Menyiapkan email
        $email = \Config\Services::email();

        $email->setFrom('bangpram22@gmail.com', 'PTSP-KanKemenag Kab. Pekalogan');
        $email->setTo($toEmail);
        $email->setSubject($subject);
        $email->setMessage($message);

        // Mengirim email
        if (!$email->send()) {
            // Jika email gagal dikirim, tampilkan error
            log_message('error', 'Email gagal dikirim: ' . $email->printDebugger());
            return redirect()->back()->with('error', 'Email gagal dikirim. Silakan coba lagi!');
        }

        if ($pelayanan) {
            // Redirect dengan pesan sukses jika insert berhasil
            return redirect()->to('/pelayanan/index')->with('success', 'Data berhasil Terkirim, Silahkan tunggu email notifikasi');
        } else {
            // Redirect dengan pesan error jika insert gagal
            return redirect()->back()->with('error', 'Gagal mengirim data, Pastikan semua terisi sesuai layanan');
        }
    }

    public function detail($id)
    {

        // Mengambil data berdasarkan ID
        $pelayanan = $this->pelayanan->find($id);

        // Menampilkan data pada view jika data ditemukan
        if ($pelayanan) {
            return view('backend/data_pelayanan/index', ['pelayanan' => $pelayanan]);
        } else {
            return redirect()->to('/pelayanan/index'); // Redirect jika data tidak ditemukan
        }
    }

    public function update($id)
    {
        // Cek apakah layanan dengan ID tersebut ada
        $pelayanan = $this->pelayanan->find($id);

        // Jika data pelayanan tidak ditemukan
        if (!$pelayanan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // Ambil file PDF dari form
        $fileLampiran = $this->request->getFile('lampiran_jadi');
        $namaLampiran = $pelayanan['lampiran_jadi']; // Default ke file lama

        // Jika ada file yang diupload
        if ($fileLampiran && $fileLampiran->isValid() && !$fileLampiran->hasMoved()) {
            // Tentukan direktori penyimpanan file
            $filePath = FCPATH . '/doc/keluar/';  // Gunakan FCPATH untuk menuju folder public

            // Pastikan folder tujuan ada
            if (!is_dir($filePath)) {
                mkdir($filePath, 0777, true); // Membuat folder jika belum ada
            }

            // Jika file sebelumnya bukan default.pdf, hapus file sebelumnya
            if ($pelayanan['lampiran_jadi'] !== 'default.pdf' && file_exists($filePath . $pelayanan['lampiran_jadi'])) {
                unlink($filePath . $pelayanan['lampiran_jadi']);  // Hapus file sebelumnya
            }

            // Nama file baru (bisa sesuai kebutuhan, atau file random)
            $namaLampiran = $fileLampiran->getRandomName();  // Nama file baru yang dihasilkan secara acak

            // Pindahkan file ke folder tujuan
            $fileLampiran->move($filePath, $namaLampiran);
        }

        // Ambil data dari request (POST)
        $penerima = $this->request->getPost('penerima');

        // Jika input kosong, set penerima ke NULL
        if (empty($penerima)) {
            $penerima = null;
        }

        // Update data pelayanan
        $data = [
            'nama_lengkap'  => $this->request->getPost('nama_lengkap'),
            'no_handphone'  => $this->request->getPost('no_handphone'),
            'email'         => $this->request->getPost('email'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama'         => $this->request->getPost('agama'),
            'pemohon'       => $this->request->getPost('pemohon'),
            'layanan'       => $this->request->getPost('layanan'),
            'penerima'      => $penerima,
            'lampiran_jadi' => $namaLampiran, // Update dengan nama file baru
            'updated_at'    => Time::now(),
        ];

        $penerima = $this->request->getPost('penerima');
        // Lakukan update data pelayanan
        $this->pelayanan->update($id, $data);

        // Redirect ke halaman daftar pelayanan dengan pesan sukses
        return redirect()->to('/pelayanan/index')->with('success', 'Data berhasil diupdate');
    }



    public function delete($id)
    {
        // Mencari data berdasarkan id
        $pelayanan = $this->pelayanan->find($id);

        if (isset($pelayanan)) {

            // Menggunakan FCPATH untuk path file
            $filePath = FCPATH . 'doc/masuk/' . $pelayanan['lampiran'];

            // Cek jika file ada, baru hapus
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Hapus data dari database
            $this->pelayanan->delete($id);

            // Redirect ke halaman data pelayanan dengan pesan sukses
            return redirect()->to('/pelayanan/index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function cetak_tanda($id)
    {

        // Mengambil data berdasarkan ID
        $pelayanan = $this->pelayanan->find($id);

        // Menampilkan data pada view jika data ditemukan
        if ($pelayanan) {
            return view('backend/data_pelayanan/cetak/tanda_terima', ['pelayanan' => $pelayanan]);
        } else {
            return redirect()->to('/pelayanan/index'); // Redirect jika data tidak ditemukan
        }
    }

    public function diproses_ptsp($id)
    {
        // Mengambil data berdasarkan ID
        $pelayanan = $this->pelayanan->getJoinForEmail($id);

        // Validasi apakah data ditemukan
        if (!$pelayanan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Ambil data dari request (POST)
        $data = [
            'status'     => '1', // Ubah status menjadi "Diterima PTSP"
            'updated_at' => Time::now(),
        ];

        // Lakukan update data pelayanan
        if (!$this->pelayanan->update($id, $data)) {
            return redirect()->back()->with('error', 'Gagal memperbarui data.');
        }
        // Ambil data yang baru diinsert
        // Siapkan data untuk email
        $toEmail = $pelayanan['email'];  // Pastikan kolom email ada dalam data pelayanan
        $subject = "Status Pelayanan " . $pelayanan['e_tiket'] . " Diterima PTSP";
        $message = "
        <div style='border: 1px solid #ddd; padding: 15px; border-radius: 5px; background-color: #f9f9f9; font-family: Arial, sans-serif;'>
            <p>Yth. Bapak/Ibu <strong>" . htmlspecialchars($pelayanan['nama_lengkap'], ENT_QUOTES, 'UTF-8') . "</strong>,</p> 
            
            <p>Berikut adalah detail permohonan layanan Anda:</p>
            
            <table style='width: 100%; border-collapse: collapse; margin-bottom: 20px;'>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Layanan</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['nama_layanan'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>E-Tiket</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['e_tiket'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Nomor Handphone</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['no_handphone'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Status</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>Diterima Petugas PTSP</td>
                </tr>
            </table>
            <p>Permohonan layanan anda Diterima Petugas PTSP</p>
            <p><i>Gunakan kode <strong>E-tiket</strong> dan <strong>Nomor Handphone</strong> untuk melakukan cek status pada website</i></p>
            <p>Terima kasih telah menggunakan layanan kami, Jika Anda membutuhkan bantuan lebih lanjut, silakan hubungi kami melalui</p>
            <table style='width: 100%; border-collapse: collapse; margin-bottom: 5px;'>
                <tr>
                    <td style='width: 10%; font-weight: bold; padding: 8px;'>Petugas</td>
                    <td style='padding: 8px;'>: PTSP Kemenag Kab. Pekalongan</td>
                </tr>
                <tr>
                    <td style='width: 10%; font-weight: bold; padding: 8px;'>Telp</td>
                    <td style='padding: 8px;'>: (0285)38540</td>
                </tr>
            </table>
            <p>Salam,</p>
            <p><strong>Unit PTSP Kantor Kementrian Agama Kab. Pekalongan</strong></p>
        </div>
    ";

        // Menyiapkan email
        $email = \Config\Services::email();
        $email->setFrom('bangpram22@gmail.com', 'PTSP-KanKemenag Kab. Pekalongan');
        $email->setTo($toEmail);
        $email->setSubject($subject);
        $email->setMessage($message);

        // Mengirim email
        if (!$email->send()) {
            // Jika email gagal dikirim, log error
            log_message('error', 'Email gagal dikirim: ' . $email->printDebugger());
        }

        // Redirect ke halaman daftar pelayanan
        return redirect()->to('/pelayanan/index')->with('success', 'Status berhasil diupdate.');
    }

    public function diproses_unit($id)
    {
        // Mengambil data berdasarkan ID
        $pelayanan = $this->pelayanan->getJoinForEmail($id);

        // Validasi apakah data ditemukan
        if (!$pelayanan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Ambil data dari request (POST)
        $data = [
            'status'     => '2', // Ubah status menjadi "Diterima diproses unit"
            'updated_at' => Time::now(),
        ];

        // Lakukan update data pelayanan
        if (!$this->pelayanan->update($id, $data)) {
            return redirect()->back()->with('error', 'Gagal memperbarui data.');
        }

        if (isset($pelayanan)) {
            // Ambil data dari request (POST)

            $toEmail = $pelayanan['email'];  // Pastikan kolom email ada dalam data pelayanan
            $subject = "Status Pelayanan " . $pelayanan['e_tiket'] . " Sedang Diproses Unit";
            $message = "
        <div style='border: 1px solid #ddd; padding: 15px; border-radius: 5px; background-color: #f9f9f9; font-family: Arial, sans-serif;'>
            <p>Yth. Bapak/Ibu <strong>" . htmlspecialchars($pelayanan['nama_lengkap'], ENT_QUOTES, 'UTF-8') . "</strong>,</p> 
            
            <p>Berikut adalah detail permohonan layanan Anda:</p>
            
            <table style='width: 100%; border-collapse: collapse; margin-bottom: 20px;'>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Layanan</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['nama_layanan'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>E-Tiket</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['e_tiket'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Nomor Handphone</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['no_handphone'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Status</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'> Diproses Unit Pengelola</td>
                </tr>
            </table>
            <p>Permohonan layanan anda Diproses Unit Pengelola</p>
            <p><i>Gunakan kode <strong>E-tiket</strong> dan <strong>Nomor Handphone</strong> untuk melakukan cek status pada website</i></p>
            <p>Terima kasih telah menggunakan layanan kami, Jika Anda membutuhkan bantuan lebih lanjut, silakan hubungi kami melalui</p>
            <table style='width: 100%; border-collapse: collapse; margin-bottom: 5px;'>
                <tr>
                    <td style='width: 10%; font-weight: bold; padding: 8px;'>Petugas</td>
                    <td style='padding: 8px;'>: PTSP Kemenag Kab. Pekalongan</td>
                </tr>
                <tr>
                    <td style='width: 10%; font-weight: bold; padding: 8px;'>Telp</td>
                    <td style='padding: 8px;'>: (0285)38540</td>
                </tr>
            </table>
            <p>Salam,</p>
            <p><strong>Unit PTSP Kantor Kementrian Agama Kab. Pekalongan</strong></p>
        </div>
    ";

            // Menyiapkan email
            $email = \Config\Services::email();
            $email->setFrom('bangpram22@gmail.com', 'PTSP-KanKemenag Kab. Pekalongan');
            $email->setTo($toEmail);
            $email->setSubject($subject);
            $email->setMessage($message);

            // Mengirim email
            if (!$email->send()) {
                // Jika email gagal dikirim, log error
                log_message('error', 'Email gagal dikirim: ' . $email->printDebugger());
            }

            // Redirect ke halaman daftar pelayanan
            return redirect()->to('/pelayanan/index')->with('success', 'Status berhasil diupdate.');
        }
    }

    public function selesai($id)
    {
        // Mengambil data berdasarkan ID
        $pelayanan = $this->pelayanan->getJoinForEmail($id);

        $data = [
            'status'  => 3,
            'updated_at' => Time::now()
        ];

        // Lakukan update status pelayanan
        $this->pelayanan->update($id, $data);  // Pastikan ID diberikan sebagai parameter
        if (isset($pelayanan)) {
            // Ambil data dari request (POST)

            $toEmail = $pelayanan['email'];  // Pastikan kolom email ada dalam data pelayanan
            $subject = "Status Pelayanan " . $pelayanan['e_tiket'] . " Selesai";
            $message = "
        <div style='border: 1px solid #ddd; padding: 15px; border-radius: 5px; background-color: #f9f9f9; font-family: Arial, sans-serif;'>
            <p>Yth. Bapak/Ibu <strong>" . htmlspecialchars($pelayanan['nama_lengkap'], ENT_QUOTES, 'UTF-8') . "</strong>,</p> 
            
            <p>Berikut adalah detail permohonan layanan Anda:</p>
            
            <table style='width: 100%; border-collapse: collapse; margin-bottom: 20px;'>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Layanan</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['nama_layanan'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>E-Tiket</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['e_tiket'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Nomor Handphone</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['no_handphone'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Status</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'> Selesai</td>
                </tr>
            </table>
            <p>Permohonan layanan anda telah Selesai, siahkan mengisi pwnilaian sebelum mendownload file</p>
            <p><i>Gunakan kode <strong>E-tiket</strong> dan <strong>Nomor Handphone</strong> untuk melakukan cek status pada website</i></p>
            <p>Terima kasih telah menggunakan layanan kami, Jika Anda membutuhkan bantuan lebih lanjut, silakan hubungi kami melalui</p>
            <table style='width: 100%; border-collapse: collapse; margin-bottom: 5px;'>
                <tr>
                    <td style='width: 10%; font-weight: bold; padding: 8px;'>Petugas</td>
                    <td style='padding: 8px;'>: PTSP Kemenag Kab. Pekalongan</td>
                </tr>
                <tr>
                    <td style='width: 10%; font-weight: bold; padding: 8px;'>Telp</td>
                    <td style='padding: 8px;'>: (0285)38540</td>
                </tr>
            </table>
            <p>Salam,</p>
            <p><strong>Unit PTSP Kantor Kementrian Agama Kab. Pekalongan</strong></p>
        </div>
    ";

            // Menyiapkan email
            $email = \Config\Services::email();
            $email->setFrom('bangpram22@gmail.com', 'PTSP-KanKemenag Kab. Pekalongan');
            $email->setTo($toEmail);
            $email->setSubject($subject);
            $email->setMessage($message);

            // Mengirim email
            if (!$email->send()) {
                // Jika email gagal dikirim, log error
                log_message('error', 'Email gagal dikirim: ' . $email->printDebugger());
            }

            // Redirect ke halaman daftar pelayanan
            return redirect()->to('/pelayanan/index')->with('success', 'Status berhasil diupdate.');
        }
    }
}
