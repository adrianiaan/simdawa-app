<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
    }

    public function index()
    {
        if (isset($_POST['btn_login'])) {
            $cek_login = $this->LoginModel->cek_login(); 
            //memanggil fungsi cek_login di LoginModel. cek_login() akan mengirimkan array $return dan array tersebut ditampung di $cek_login
            if ($cek_login['status'] == true) { //cek data status dari array $cek_login. jika benar maka login berhasil
                //membuat array $data yang digunakan untuk membuat session
                $data = [
                    'id' => $cek_login['data_login']->id, //membuat session id dari array $cek_login
                    'peran' => $cek_login['data_login']->peran, //membuat session peran dari array $cek_login
                    'nama' => $cek_login['nama_lengkap'] //membuat session nama dari array $cek_login
                ];

                //buat session. membuat session dengan CI mengguna set_userdata
                $this->session->set_userdata($data);
                redirect('home'); //mengarahkah halaman ke controller home
            } else {
                $this->session->set_flashdata('pesan', $cek_login['pesan']);
                $this->session->set_flashdata('status', false);
                redirect('login');
            }
        } else {
            $data['title'] = "Halaman Login | SIDMANA-APP";
            $this->load->view('login/login_view', $data);
        }
    }
}
