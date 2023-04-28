<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($tampildata as $row) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['brg_kode'] ?></td>
                <td><?= $row['brg_nama'] ?></td>
                <td><?= number_format($row['brg_harga'], 0, ",", ".") ?></td>
                <td><?= number_format($row['brg_stok'], 0, ",", ".") ?></td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" onclick="pilih('<?= $row['brg_kode'] ?>')">
                        Pilih
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function pilih(kode) {
        $('#kode_barang').val(kode)
        $('#modalcaribarang').on('hidden.bs.modal', function(event) {
            ambilDataBarang();
        })
        $('#modalcaribarang').modal('hide');
    }
</script>