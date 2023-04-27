<?= $this->extend('_layouts/default') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $title ?> - <?= $pages ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-end">
                <button type="button" class="btn btn-dark btn-sm" onclick="location.href='<?= base_url('barang') ?>'">
                    <i class="fa fa-backward"></i> Kembali
                </button>
            </div>
            <div class="card-body">
                <form action="<?= base_url('barang/update') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="kat_id" value="<?= $row['kat_id'] ?>">
                    <div class="form-group row">
                        <label for="brg_nama" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= validation_errors('brg_nama') ? 'is-invalid' : '' ?>" name="brg_nama" id="brg_nama" autocomplete="off" placeholder="Isikan Nama Barang" value="<?= $row['brg_nama'] ?>">
                            <div class="form-text text-danger">
                                <?= validation_show_error('brg_nama') ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>