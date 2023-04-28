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
                <button type="button" class="btn btn-warning btn-sm" onclick="location.href='<?= base_url('barangmasuk') ?>'">
                    <i class="fa fa-backward"></i> Kembali
                </button>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="faktur">No. Faktur Barang Masuk</label>
                        <input type="text" class="form-control" name="faktur" id="faktur" value="<?= $kodeFaktur ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tgl_brg_masuk">Tanggal Barang Masuk</label>
                        <input type="date" class="form-control" name="tgl_brg_masuk" id="tgl_brg_masuk" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary">
                        Input Barang
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="kode_barang">Kode Barang</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button" id="tombolCariBarang">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang" autocomplete="off" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="harga_jual">Harga Jual</label>
                                <input type="number" class="form-control" name="harga_jual" id="harga_jual" autocomplete="off" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="harga_beli">Harga Beli</label>
                                <input type="number" class="form-control" name="harga_beli" id="harga_beli" autocomplete="off">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah" autocomplete="off">
                            </div>
                            <div class="form-group col-md-1">
                                <label>Aksi</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-info btn-sm" title="Tambah Item" id="tombolTambahItem">
                                        <i class="fa fa-plus-square"></i>
                                    </button> &nbsp;
                                    <button type="button" class="btn btn-secondary btn-sm" title="Reload Data Item" id="tombolReload">
                                        <i class="fa fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="showDataTemp"></div>
                        <div class="row justify-content-end">
                            <button type="button" class="btn btn-success btn-lg" id="tombolSelesaiTransaksi">
                                <i class="fa fa-save"></i> Selesai Transaksi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modalcaribarang" style="display: none;"></div>

<script>
    function dataTemp() {
        let faktur = $('#faktur').val();

        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>barangmasuk/dataTemp",
            data: {
                faktur: faktur
            },
            dataType: "JSON",
            success: function(response) {
                if (response.success) {
                    $('#showDataTemp').html(response.success);
                }

                // if (response.error) {
                //     alert(response.error);
                //     kosong();
                // }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);

                console.log(response.data);
            }
        });
    }

    function kosong() {
        $('#kode_barang').val('');
        $('#nama_barang').val('');
        $('#harga_jual').val('');
        $('#harga_beli').val('');
        $('#jumlah').val('');

        $('#kode_barang').focus();
    }

    function ambilDataBarang() {
        let kode_barang = $('#kode_barang').val();

        $.ajax({
            type: "post",
            url: "<?= base_url() ?>barangmasuk/getDataBarang",
            data: {
                kode_barang: kode_barang
            },
            dataType: "JSON",
            success: function(response) {
                if (response.data) {
                    let data = response.data;
                    $('#nama_barang').val(data.brg_nama);
                    $('#harga_jual').val(data.brg_harga);
                    $('#harga_beli').focus();

                    // alert('sukses');
                }

                if (response.error) {
                    alert(response.error);
                    kosong();
                }

                console.log(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }

    $(document).ready(function() {
        dataTemp();

        $('#kode_barang').keydown(function(e) {
            if (e.keyCode == 13 || e.keyCode == 9) {
                e.preventDefault();
                ambilDataBarang();
            }
        });

        $('#tombolTambahItem').click(function(e) {
            e.preventDefault();
            let faktur = $('#faktur').val();
            let kode_barang = $('#kode_barang').val();
            let harga_beli = $('#harga_beli').val();
            let harga_jual = $('#harga_jual').val();
            let jumlah = $('#jumlah').val();

            if (faktur.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Maaf, Faktur Wajib Diisi',
                })
            } else if (kode_barang.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Maaf, Kode Barang Tidak Boleh Kosong',
                })
            } else if (harga_beli.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Maaf, Harga Beli Tidak Boleh Kosong',
                })
            } else if (jumlah.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Maaf, Jumlah Tidak Boleh Kosong',
                })
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>/barangmasuk/simpanTemp",
                    data: {
                        faktur: faktur,
                        kode_barang: kode_barang,
                        harga_beli: harga_beli,
                        harga_jual: harga_jual,
                        jumlah: jumlah
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            kosong();
                            dataTemp();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + '\n' + thrownError);
                    }
                });
            }
        });

        $('#tombolReload').click(function(e) {
            e.preventDefault();
            dataTemp();
        });

        $('#tombolCariBarang').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url() ?>/barangmasuk/searchDataBarang",
                dataType: "JSON",
                success: function(response) {
                    if (response.data) {
                        $('.modalcaribarang').html(response.data).show();
                        $('#modalcaribarang').modal('show');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        });

        $('#tombolSelesaiTransaksi').click(function(e) {
            e.preventDefault();
            let faktur = $('#faktur').val();
            let tgl_brg_masuk = $('#tgl_brg_masuk').val();

            if (faktur.length == 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pesan',
                    text: 'Maaf, Faktur Masih Kosong',
                })
            } else {
                Swal.fire({
                    title: 'Selesai Transaksi',
                    text: "Yakin Transaksi Ini Disimpan?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Simpan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url() ?>barangmasuk/selesaiTransaksi",
                            data: {
                                faktur: faktur,
                                tgl_brg_masuk: tgl_brg_masuk
                            },
                            dataType: "JSON",
                            success: function(response) {
                                if (response.error) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Pesan',
                                        text: response.error,
                                    });
                                } else if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Pesan',
                                        text: response.success,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        }
                                    });
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + '\n' + thrownError);
                            }
                        });
                    }
                })
            }
        });
    });
</script>
<?= $this->endSection() ?>