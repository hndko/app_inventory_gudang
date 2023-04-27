<table class="table table-sm table-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Jual</th>
            <th>Harga Beli</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($dataTemp as $row) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['brg_kode'] ?></td>
                <td><?= $row['brg_nama'] ?></td>
                <td><?= number_format($row['det_harga_jual'], 0, ",", ".") ?></td>
                <td><?= number_format($row['det_harga_beli'], 0, ",", ".") ?></td>
                <td><?= number_format($row['det_jumlah'], 0, ",", ".") ?></td>
                <td><?= number_format($row['det_subtotal'], 0, ",", ".") ?></td>
                <td>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="hapusItem('<?= $row['det_id'] ?>')">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>