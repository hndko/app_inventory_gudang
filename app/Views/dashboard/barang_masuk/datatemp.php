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
                <td>Rp <?= number_format($row['det_harga_jual'], 0, ",", ".") ?></td>
                <td>Rp <?= number_format($row['det_harga_masuk'], 0, ",", ".") ?></td>
                <td><?= number_format($row['det_jumlah'], 0, ",", ".") ?></td>
                <td>Rp <?= number_format($row['det_subtotal'], 0, ",", ".") ?></td>
                <td>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="hapusItem('<?= $row['det_id'] ?>')">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function hapusItem(id) {
        Swal.fire({
            title: 'Hapus Item',
            text: "Apakah Anda Yakin?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>barangmasuk/delete",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            dataTemp();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success,
                            })
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + '\n' + thrownError);

                        console.log(response.data);
                    }
                });
            }
        })
    }
</script>