<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <!-- =================================== -->
        <!-- pageheader -->
        <!-- =================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Data Pendaftaran Akun</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('home') ?>" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('pendaftaran') ?>" class="breadcrumb-link">Pendaftaran Akun</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tampil Data</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- =================================== -->
        <!-- end pageheader -->
        <!-- =================================== -->

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <?php
                    $this->load->view('template/notifikasi') //memanggil notifikasi.php
                    ?>
                <div class="card">                   
                <div class="card-header">
                        Data Pendaftaran Akun
                        <a href="<?php echo base_url('pendaftaran/daftar') ?>" class="btn btn-sm btn-success float-right">
                            <i class="fas fa-plus"></i> Tambah Data
                        </a>
                        <a href="<?php echo base_url('pendaftaran/cetak') ?>" target="_blank" class="btn btn-sm btn-info mr-1 float-right">
                            <i class="fas fa-print"></i> Cetak Data
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-secondary">
                            <div>Klik pada foto bukti daftar untuk melihat foto lebih jelas</div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Pendaftaran</th>
                                    <th>Nama Lengkap</th>
                                    <th>No Handphone</th>
                                    <th>Bukti Daftar</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($pendaftaran as $a) {
                                    $lokasi = base_url('upload/bukti_daftar/' . $a->bukti_daftar);
                                    echo "<tr>
                                            <td>" . $no++ . "</td>
                                            <td>" . $a->no_pendaftaran . "</td>
                                            <td>" . $a->nama_lengkap . "</td>
                                            <td>" . $a->no_handphone . "</td>
                                            <td> <a href=" . $lokasi . " target='_blank'>
                                            <img src=" . $lokasi . " width='50%' height='50%'> </a></td>";
                                        if ($a->keterangan == "Belum Diverifikasi") :
                                            echo "<td>
                                                <a href=" . base_url('pendaftaran/verifikasi/acc/' . $a->id) . " class='btn btn-info btn-sm'>
                                                   <i class='fa fa-check'></i> Konfirmasi
                                                </a>
                                                <a href=" . base_url('pendaftaran/verifikasi/batal/' . $a->id) . " class='btn btn-danger btn-sm' onclick='return confirm(\"Ingin hapus data ini?\")'>
                                                    <i class='fa fa-ban'></i> batalkan
                                                </a>
                                            </td>";
                                        else :
                                            echo "<td>" . $a->keterangan . "</td>";
                                        endif;
                                        echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>