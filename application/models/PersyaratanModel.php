<?php


class PersyaratanModel extends CI_Model
{
    private $tabel = "persyaratan";
    public function get_persyaratan()
    {
        return $this->db->get($this->tabel)->result();
        //baris ke 10 ini tujuannya untuk mengambil data dari tabel persyaratan. Selain dengan fungsi get,
        //kita juga bisa menggunakan $this->db->get($this->tabel)->result();
    }
    public function insert_persyaratan()
    {
        $data = [
            'nama_persyaratan' => $this->input->post('nama_persyaratan', true),
            'keterangan' => $this->input->post('keterangan', true)
        ];

        $this->db->insert($this->tabel, $data); // Pastikan nama tabel sesuai
        if ($this->db->affected_rows() > 0) { //cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $this->session->set_flashdata('pesan', "Data persyaratan beasiswa berhasil ditambahkan!");
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', "Data persyaratan beasiswa gagal ditambahkan!");
            $this->session->set_flashdata('status', false);
        } 
    }

    // function dengan 1 parameter. $id nilainya dikirimkan oleh controller
    public function get_persyaratan_byid($id)
    {
        return $this->db->get_where($this->tabel, ['id' => $id])->row();

        /* 
        get_where hampir sama seperti get, bedanya ada tambahan klausa where 
        untuk menampilkan data berdasarkan kriteria tertentu. 'id' => $id artinya 
        data yang diambil adalah data persyaratan dengan nilai id = $id.
        row() digunakan untuk mengambil satu baris data, beda dengan result() yang mengambil semua data.
        */
    }

    public function update_persyaratan()
    {
        $data = [
            'nama_persyaratan' => $this->input->post('nama_persyaratan'),
            'keterangan' => $this->input->post('keterangan')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update($this->tabel, $data);

        /* 
        proses update hampir sama seperti insert, bedanya ada tambahan where (baris 39)
        untuk menentukan data mana yang akan diperbarui.
        */
        if ($this->db->affected_rows() > 0) { //cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $this->session->set_flashdata('pesan', "Data persyaratan beasiswa berhasil diperbarui!");
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', "Data persyaratan beasiswa gagal diperbarui!");
            $this->session->set_flashdata('status', false);
        }
    }

    public function delete_persyaratan($id){
        $this->db->where('id',$id);
        $this->db->delete($this->tabel);
        //sebelum dilakukan hapus, tambahkan where dulu untuk menentukan data mana yang dihapus
        //untuk proses hapus gunakan fungsi delete(namatabel)
        if ($this->db->affected_rows() > 0) { //cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $this->session->set_flashdata('pesan', "Data persyaratan beasiswa berhasil dihapus!");
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', "Data persyaratan beasiswa gagal dihapus!");
            $this->session->set_flashdata('status', false);
        }
    }
}
