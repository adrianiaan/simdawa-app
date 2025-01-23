<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Data Persyaratan Beasiswa</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('home') ?>" class="breadcrumb-link">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('persyaratan') ?>" class="breadcrumb-link">Persyaratan Beasiswa</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Data Persyaratan Beasiswa</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <?php
                $this->load->view('template/notifikasi')//memanggil notifikasi.php
                ?>
                <div class="card">
                    <div class="card-header">
                        Data Persyaratan Beasiswa
                        <a href="<?php echo base_url('persyaratan/tambah') ?>" class="btn btn-sm btn-success float-right">
                            <i class="fas fa-plus"></i> Tambah Data
                        </a>
                        <a href="<?php echo base_url('persyaratan/cetak') ?>" target="_blank" class="btn btn-sm btn-info mr-1 float-right">
                            <i class="fas fa-print"></i> Cetak Data
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="mytabel">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Persyaratan Beasiswa</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                <?php foreach ($persyaratan as $a): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $a->nama_persyaratan; ?></td>
                                        <td><?php echo $a->keterangan; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('persyaratan/ubah/'.$a->id) ?>" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?php echo base_url('persyaratan/hapus/'.$a->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Ingin hapus data ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
