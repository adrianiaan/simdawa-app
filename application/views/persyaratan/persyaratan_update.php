<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Perbarui Data Persyaratan Beasiswa</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('persyaratan'); ?>" class="breadcrumb-link">Persyaratan Beasiswa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Perbarui Data</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        Perbarui Data Persyaratan Beasiswa
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $persyaratan->id ?>" />
                            <div class="form-group row">
                                <label for="nama_persyaratan" class="col-md-3">Nama Persyaratan Beasiswa</label>
                                <div class="col-md-9">
                                    <input type="text" name="nama_persyaratan" value="<?= $persyaratan->nama_persyaratan ?>" required placeholder="Nama Persyaratan Beasiswa" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="keterangan" class="col-md-3">Keterangan</label>
                                <div class="col-md-9">
                                    <input type="text" name="keterangan" value="<?= $persyaratan->keterangan ?>" required placeholder="Keterangan" class="form-control">
                                </div>
                            </div>
                            <button type="submit" name="update" class="btn btn-sm btn-info float-right">Simpan</button>
                            <a href="<?= base_url('persyaratan'); ?>" class="btn btn-sm btn-danger float-right mr-2">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
