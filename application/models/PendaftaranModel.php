<?php
class PendaftaranModel extends CI_Model
{
    private $tabel = "pendaftaran_pengguna";

    public function get_pendaftaran()
    {
        return $this->db->get($this->tabel)->result();
    }
    
    public function cek_nopendaftaran()
    {
        // mengecek no pendaftaran di tabel pendaftaran pengguna, apakah no pendaftarannya sudah ada
        $cek = $this->db->get_where($this->tabel, ['no_pendaftaran' => $this->input->post('no_pendaftaran')]);
        if ($cek->num_rows() > 0) { // kalau no_pendaftaran sudah ada
            return true;
        } else {
            return false;
        }
    }

    public function upload_bukti($file)
    {
        $config['upload_path'] = './upload/bukti_daftar/'; // mengatur agar file yang diupload ditampung di folder bukti_daftar
        $config['allowed_types'] = 'jpg|png|jpeg'; // mengatur tipe file yang diterima
        $config['max_size'] = '1024'; // mengatur ukuran maksimal file, kalian bisa atur max size dengan nilai berbeda
        $config['remove_space'] = TRUE;

        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        if ($this->upload->do_upload($file)) { // lakukan upload dan cek jika proses upload berhasil
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else { // jika gagal
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }

    public function insert_pendaftaran($file)
    {
        $data = [
            'no_pendaftaran' => $this->input->post('no_pendaftaran'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'no_handphone' => $this->input->post('no_handphone'),
            'bukti_daftar' => $file['file']['file_name'], // mengambil nama file yang diupload
            'keterangan' => 'Belum Diverifikasi'
        ];

        $this->db->insert($this->tabel, $data);
        if ($this->db->affected_rows() > 0) { // cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $id = $this->db->insert_id();
            $this->insert_pengguna($id);
            $this->session->set_flashdata('pesan', 'Data pendaftaran berhasil ditambahkan!');
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', 'Data pendaftaran gagal ditambahkan!');
            $this->session->set_flashdata('status', false);
        }
    }

    public function insert_pengguna($id)
    {
        $data = [
            'username' => $this->input->post('no_pendaftaran'), // no pendaftaran dijadikan username untuk mahasiswa login
            'password' => md5($this->input->post('password')), // mengatur password agar dienkripsi md5
            'peran' => 'user',
            'pendaftaran_id' => $id
        ];

        $this->db->insert('pengguna', $data);
        if ($this->db->affected_rows() > 0) { // cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $this->session->set_flashdata('pesan', 'Data pengguna berhasil ditambahkan! Untuk sementara akun kamu masih belum diverifikasi admin. Tunggu 1 x 24 Jam');
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', 'Data pengguna gagal ditambahkan!');
            $this->session->set_flashdata('status', false);
        }
    }

    public function verifikasi_akun($status, $id)
    {
        $this->db->update($this->tabel, ['keterangan' => $status], ['id' => $id]);
        if ($this->db->affected_rows() > 0) { // cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $this->session->set_flashdata('pesan', 'Verifikasi akun berhasil');
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', 'Verifikasi akun gagal!');
            $this->session->set_flashdata('status', false);
        }
    }
    }