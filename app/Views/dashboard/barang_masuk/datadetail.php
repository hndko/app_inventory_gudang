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
        <?php foreach ($dataDetail as $row) : ?>
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
                    <button type="button" class="btn btn-outline-info btn-sm" onclick="editItem('<?= $row['det_id'] ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function editItem(id) {
        $('#det_id').val(id);

        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>barangmasuk/editItem",
            data: {
                det_id: $('#det_id').val()
            },
            dataType: "JSON",
            success: function(response) {
                if (response.success) {
                    let data = response.success;

                    $('#kode_barang').val(data.brg_kode);
                    $('#nama_barang').val(data.brg_nama);
                    $('#harga_jual').val(data.brg_harga_jual);
                    $('#harga_beli').val(data.brg_harga_masuk);
                    $('#jumlah').val(data.brg_jumlah);

                    $('#tombolEditItem').fadeIn();
                    $('#tombolReload').fadeIn();
                    $('#tombolTambahItem').fadeOut();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);

                console.log(response.data);
            }
        });
    }

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
                    url: "<?= base_url() ?>barangmasuk/deleteDetail",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            dataDetail();
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