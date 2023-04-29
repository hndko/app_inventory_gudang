<div class="modal fade" id="modalItem" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalItemLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalItemLabel">Detail Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Masuk</th>
                            <th>Harga Jual</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($result as $res) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $res['brg_kode'] ?></td>
                                <td><?= $res['brg_nama'] ?></td>
                                <td>Rp <?= number_format($res['det_harga_masuk'], 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($res['det_harga_jual'], 0, ',', '.') ?></td>
                                <td><?= number_format($res['det_jumlah'], 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($res['det_subtotal'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>