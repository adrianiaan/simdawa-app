<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    private $tabel = "pengguna";
    
    public function cek_login()
    {
        $username = $this->input->post('username'); //mengambil nilai dari inputan username
        $password = md5($this->input->post('password')); //mengambil nilai dari inputan password lalu dienkripsi menggunakan md5
        $cek = $this->db->get_where($this->tabel, ['username' => $username, 'password' => $password]); 
        //mencari data pengguna berdasarkan username dan password yang diinput
        if ($cek->num_rows() > 0) { //jika menghasilkan data baris lebih dari 0
            $data_login = $cek->row(); //menampung data pengguna dari login yang berhasil ke variabel $data_login
            //cek keterangan akun di tabel pendaftaran_pengguna berdasarkan id, apakah sudah diverifikasi atau belum
            $data_pengguna = $this->db->get_where('pendaftaran_pengguna', ['id' => $data_login->pendaftaran_id])->row();
            if ($data_pengguna->keterangan == "Belum Diverifikasi" || $data_pengguna->keterangan == "Akun Dibatalkan") {
                //membuat array bernama return dengan 2 data yaitu status dan pesan,
                $return = ['status' => false, 'pesan' => 'Akun anda belum diverifikasi oleh Operator Kemahasiswaan!'];
            } else {
                //membuat array bernama return dengan 3 data yaitu status, data_login dan nama_lengkap
                $return = ['status' => true, 'data_login' => $data_login, 'nama_lengkap' => $data_pengguna->nama_lengkap];
            }
        } else {
            //membuat array bernama return dengan 2 data yaitu status dan pesan,
            $return = ['status' => false, 'pesan' => 'Username dan password tidak ditemukan di sistem!'];
        }
        //mengembalikan array $return ke pemanggil fungsi cek_login ini.
        return $return;
    }
}
