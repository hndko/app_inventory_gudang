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
                <button type="button" class="btn btn-info btn-sm" onclick="location.href='<?= base_url('barangmasuk/create') ?>'">
                    <i class="fa fa-plus-square"></i> Input Transaksi
                </button>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari Berdasarkan Faktur..." name="keyword" autocomplete="off" autofocus="true" required>
                        <div class=" input-group-append">
                            <button class="btn btn-outline-success" type="submit" name="tombolKeyword">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <table class="table table-striped table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>No. Faktur</th>
                            <th>Tanggal</th>
                            <th>Jumlah Item</th>
                            <th>Total Harga (Rp)</th>
                            <th style="width: 15%;">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($result as $res) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $res['brgm_faktur'] ?></td>
                                <td><?= date('d-m-Y', strtotime($res['brgm_tgl_faktur'])) ?></td>
                                <td class="text-center">
                                    <?php
                                    $db = \Config\Database::connect();
                                    $jumlahItem = $db->table('detail_barang_masuk')->where('det_faktur', $res['brgm_faktur'])->countAllResults();
                                    ?>

                                    <span style="cursor: pointer;" onclick="detailItem('<?= $res['brgm_faktur'] ?>')"><?= $jumlahItem ?></span>
                                </td>
                                <td><?= number_format($res['brgm_total_harga'], 0, ",", ".") ?></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="viewmodal" style="display: none;"></div>

<script>
    function detailItem(faktur) {
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>barangmasuk/detailItem",
            data: {
                faktur: faktur
            },
            dataType: "JSON",
            success: function(response) {

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);

                console.log(response.data);
            }
        });
    }
</script>
<?= $this->endSection() ?>