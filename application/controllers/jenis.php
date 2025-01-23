<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {
    
    function __construct()//konstruktor adalah metode pertama yang otomatis jalan saat controller di panggil
    {
        parent::__construct();
        $this->load->model('JenisModel');
        $this->load->library('pdf');//meload file pdf yang ada di folder libraries
        //Meload 2 buah model, jenisModel akan digunkan untuk mengambil data jenis beasiswa
    }
    //function cetak, digunakan untuk menjalankan report data beasiswa
    public function cetak()
    {
        $data['jenis'] = $this->JenisModel->get_jenis();
        $this->load->view('jenis/jenis_print', $data);
    }

    public function index()
    {
        $data['title'] = "Data Jenis Beasiswa | SIMDAWA-APP";
        $data['jenis'] = $this->JenisModel->get_jenis();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('jenis/jenis_read', $data);
        $this->load->view('template/footer');
    }
    public function tambah() 
    {
        if(isset($_POST['create'])){
            $this->JenisModel->insert_jenis();
            redirect('jenis');
        }else{
            $data['title'] = "Tambah Data Jenis Beasiswa | SIMDAWA-APP";
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('jenis/jenis_create');
            $this->load->view('template/footer');
        }
    }
    public function ubah($id) 
    {
        if(isset($_POST['update'])){
            $this->JenisModel->update_jenis();
            redirect('jenis');
        }else{
            $data['title'] = "Perbarui Data Jenis Beasiswa | SIMDAWA-APP";
            $data['jenis'] = $this->JenisModel->get_jenis_byid($id);
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('jenis/jenis_update', $data);
            $this->load->view('template/footer');
        }
    }
    public function hapus($id){
        if(isset($id)){
            $this->JenisModel->delete_jenis($id);
            redirect('jenis');
        }
    }
}