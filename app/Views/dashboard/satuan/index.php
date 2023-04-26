<?= $this->extend('_layouts/default') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $title ?></h1>
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
                <button type="button" class="btn btn-primary btn-sm" onclick="location.href='<?= base_url('satuan/create') ?>'">
                    <i class="fa fa-plus-circle"></i> Tambah Data
                </button>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Masukan Keyword Pencarian..." name="keyword" autocomplete="off" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <table class="table table-striped table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>Nama Satuan</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tampilData as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['sat_nama'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" title="Edit Data" onclick="edit('<?= $row['sat_id'] ?>')">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form action="satuan/delete/<?= $row['sat_id'] ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div>
                    <?= $pager->links('satuan', 'paging') ?>
                </div>

                <script>
                    function edit(id) {
                        window.location = ('/satuan/edit/' + id);
                    }
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>