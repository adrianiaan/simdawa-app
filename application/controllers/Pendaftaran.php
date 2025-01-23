<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pendaftaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('PendaftaranModel'));
        $this->load->library('pdf');//meload file pdf yang ada di folder libraries

    }
    public function cetak()
    {
        $data['pendaftaran'] = $this->PendaftaranModel->get_pendaftaran();
        $this->load->view('pendaftaran/pendaftaran_print', $data);
    }

    public function index()
    {
        $data['title'] = "Data Beasiswa | SIMDAWA-APP";
        $data['pendaftaran'] = $this->PendaftaranModel->get_pendaftaran(); // mengambil data pendaftaran dari function get_beasiswa
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('pendaftaran/pendaftaran_read', $data);
        $this->load->view('template/footer');
    }
    

    public function daftar()
    {
        if (isset($_POST['btn_daftar'])) { // jika button btn_daftar diklik
            $cek_nopendaftaran = $this->PendaftaranModel->cek_nopendaftaran(); // cek no pendaftaran, apakah sudah ada di sistem
            if ($cek_nopendaftaran == true) { // jika no pendaftaran sudah ada di sistem
                $this->session->set_flashdata('pesan', 'No pendaftaran sudah terdaftar di sistem!');
                redirect('pendaftaran/daftar'); // halaman dikembalikan agar flashdatanya aktif
            } else { // jika no pendaftaran belum ada di sistem
                $upload = $this->PendaftaranModel->upload_bukti('bukti_daftar'); // lakukan proses upload bukti daftar
                if ($upload['result'] == 'success') { // jika upload sukses
                    $this->PendaftaranModel->insert_pendaftaran($upload); // lakukan proses penyimpanan data pendaftaran
                    redirect('pendaftaran/daftar'); // halaman dikembalikan agar flashdatanya aktif
                } else {
                    // jika proses upload gagal, maka akan muncul pesan error dari gagal upload file
                    $this->session->set_flashdata('pesan', $upload['error']);
                    redirect('pendaftaran/daftar'); // halaman dikembalikan agar flashdatanya aktif
                }
            }
        } else {
            // jika tombol daftar belum diklik
            $data['title'] = "Pendaftaran Pengguna | SIMDAWA-APP";
            $this->load->view('pendaftaran/daftar_create', $data); // tampilkan form pendaftaran yang ada di file daftar_create
        }
    }

    public function verifikasi($keterangan, $id)
    {
        if (isset($id)) {
            $status = ($keterangan == "acc") ? "Sudah Diverifikasi" : "Akun Dibatalkan";
            $this->PendaftaranModel->verifikasi_akun($status, $id);
            redirect('pendaftaran');
        }
    }
}