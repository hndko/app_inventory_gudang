<!-- Modal -->
<div class="modal fade" id="modalcaribarang" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalcaribarangLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalcaribarangLabel">Silakan Cari Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Silakan Cari Barang Berdasarkan Kode/Nama" id="search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="btnSearch">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="viewdetaildata"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function cariDataBarang() {
        let cari = $('#search').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>barangmasuk/detailCariBarang",
            data: {
                cari: cari
            },
            dataType: "JSON",
            beforeSend: function() {
                $('.viewdetaildata').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            success: function(response) {
                if (response.data) {
                    $('.viewdetaildata').html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);

                console.log(response.data);
            }
        });
    }

    $(document).ready(function() {
        $('#btnSearch').click(function(e) {
            e.preventDefault();
            cariDataBarang();
        });

        $('#search').keydown(function(e) {
            if (e.keyCode == '13') {
                e.preventDefault();
                cariDataBarang();
            }
        });
    });
</script>