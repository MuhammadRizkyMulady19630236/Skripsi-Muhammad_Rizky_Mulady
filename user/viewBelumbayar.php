<?php
$me = new lsp();

$kd_user = $auth['kd_user'];
$table = "table_merek";
$dataBelumbayar= $me->querySelect("SELECT * FROM detailtransaksi WHERE status = 0 AND kd_user = '$kd_user'");

?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Pesanan Belum Dibayar</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Kode Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Total Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($dataBelumbayar as $ds) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $ds['kd_transaksi'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['tanggal_beli'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['nama_barang'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['jumlah'] ?>
                                                </td>
                                                <td>
                                                    Rp. <?= number_format($ds['total_harga']) ?>,-
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a data-toggle="tooltip" data-placement="top" title="Selesaikan Pembayaran"
                                                            href="?page=struk&id=<?= $ds['kd_transaksi'] ?>"
                                                            class="btn btn-info">Selesaikan Pembayaran</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $no++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>