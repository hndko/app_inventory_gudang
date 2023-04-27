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
                <form action="<?= base_url('barang/update') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="brg_id" value="<?= $row['brg_id'] ?>">
                    <input type="hidden" name="brg_gambar_old" value="<?= $row['brg_gambar'] ?>">
                    <div class="form-group row">
                        <label for="brg_kode" class="col-sm-3 col-form-label">Kode Barang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= validation_errors('brg_kode') ? 'is-invalid' : '' ?>" name="brg_kode" id="brg_kode" autocomplete="off" placeholder="Isikan Kode Barang" value="<?= $row['brg_kode'] ?>" readonly>
                            <div class="form-text text-danger">
                                <?= validation_show_error('brg_kode') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brg_nama" class="col-sm-3 col-form-label">Nama Barang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= validation_errors('brg_nama') ? 'is-invalid' : '' ?>" name="brg_nama" id="brg_nama" autocomplete="off" placeholder="Isikan Nama Barang" value="<?= $row['brg_nama'] ?>">
                            <div class="form-text text-danger">
                                <?= validation_show_error('brg_nama') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brg_kat_id" class="col-sm-3 col-form-label">Pilih Kategori</label>
                        <div class="col-sm-4">
                            <select name="brg_kat_id" id="brg_kat_id" class="custom-select <?= validation_errors('brg_kat_id') ? 'is-invalid' : '' ?>">
                                <option value="">--- Pilih Kategori ---</option>
                                <?php foreach ($dataKategori as $data) : ?>
                                    <option value="<?= $data['kat_id'] ?>" <?= $row['brg_kat_id'] == $data['kat_id'] ? 'selected' : '' ?>><?= $data['kat_nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text text-danger">
                                <?= validation_show_error('brg_kat_id') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brg_sat_id" class="col-sm-3 col-form-label">Pilih Satuan</label>
                        <div class="col-sm-4">
                            <select name="brg_sat_id" id="brg_sat_id" class="custom-select <?= validation_errors('brg_sat_id') ? 'is-invalid' : '' ?>">
                                <option value="">--- Pilih Satuan ---</option>
                                <?php foreach ($dataSatuan as $data) : ?>
                                    <option value="<?= $data['sat_id'] ?>" <?= $row['brg_sat_id'] == $data['sat_id'] ? 'selected' : '' ?>><?= $data['sat_nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text text-danger">
                                <?= validation_show_error('brg_sat_id') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brg_harga" class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control <?= validation_errors('brg_harga') ? 'is-invalid' : '' ?>" name="brg_harga" id="brg_harga" autocomplete="off" placeholder="Isikan Harga" value="<?= $row['brg_harga'] ?>">
                            <div class="form-text text-danger">
                                <?= validation_show_error('brg_harga') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brg_stok" class="col-sm-3 col-form-label">Stok</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control <?= validation_errors('brg_stok') ? 'is-invalid' : '' ?>" name="brg_stok" id="brg_stok" autocomplete="off" placeholder="Isikan Stok" value="<?= $row['brg_stok'] ?>">
                            <div class="form-text text-danger">
                                <?= validation_show_error('brg_stok') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brg_gambar" class="col-sm-3 col-form-label">Ubah Gambar (<i>Jika Ada...</i>)</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control <?= validation_errors('brg_gambar') ? 'is-invalid' : '' ?>" name="brg_gambar" id="brg_gambar" autocomplete="off">
                            <div class="form-text text-danger">
                                <?= validation_show_error('brg_gambar') ?>
                            </div>
                            <?php if ($row['brg_gambar'] == null) : ?>
                                <picture>
                                    <source type="image/jpg, image/jpeg, image/png">
                                    <img src="<?= base_url() ?>assets/img/default.png" class="img-fluid img-thumbnail">
                                </picture>
                            <?php else : ?>
                                <picture>
                                    <source type="image/jpg, image/jpeg, image/png">
                                    <img src="<?= base_url() ?>assets/upload/<?= $row['brg_gambar'] ?>" class="img-fluid img-thumbnail">
                                </picture>
                            <?php endif; ?>
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