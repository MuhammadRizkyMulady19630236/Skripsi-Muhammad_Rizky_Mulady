<?php
$me = new lsp();

$kd_user = $auth['kd_user'];
$table = "table_merek";
$dataBelumbayar= $me->querySelect("SELECT * FROM detailtransaksi WHERE status != 0 AND kd_user = '$kd_user'");

if (isset($_GET['update'])) {
    $id = $_GET['id'];

    $value = "status='3'";
    $response = $me->update("table_pretransaksi", $value, "kd_transaksi", $_GET['id'], "?page=viewSudahbayar");
}

?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Pesanan Sudah Dibayar</strong>
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
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($dataBelumbayar as $ds) {
                                            ?>
                                            <tr>
                                            <td>
                                                <a href="?page=invoice&id=<?= $ds['kd_transaksi']; ?>"><?=
														  	$ds['kd_transaksi'] ?></a>
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
                                                    <?php if($ds['status'] == '2'){?>
                                                        <b>Paket Sudah Dikirim</b><br>
                                                        <a href="?page=viewSudahbayar&update&id=<?= $ds['kd_transaksi'] ?>">(Klik Jika Sudah Menerima Paket)</a>
                                                    <?php } else if ($ds['status'] == '3') {echo "Diterima";} else {echo "Dikemas";}?>
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