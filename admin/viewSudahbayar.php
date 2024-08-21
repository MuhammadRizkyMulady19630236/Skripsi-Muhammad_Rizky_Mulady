<?php
$me = new lsp();

$dataBelumbayar = $me->querySelect("SELECT * FROM detailtransaksi WHERE status != 0 AND level = 'Pelanggan'");

if (isset($_GET['update'])) {
    $id = $_GET['id'];

    $value = "status='2'";
    $response = $me->update("table_pretransaksi", $value, "kd_transaksi", $_GET['id'], "?page=viewSudahbayar");
}

?>

<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="#">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Pesanan Sudah Dibayar</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main-content" style="margin-top: -30px;">
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
                                            <th>Keterangan</th>
                                            <th>Jumlah</th>
                                            <th>Total Harga</th>
                                            <th>Nama Pembeli</th>
                                            <th>Alamat</th>
                                            <th>No Handphone</th>
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
                                                    <a href="?page=strukTransaksi&id=<?= $ds['kd_transaksi']; ?>"><?=
                                                          $ds['kd_transaksi'] ?></a>
                                                </td>
                                                <td>
                                                    <?= $ds['tanggal_beli'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['nama_barang'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['keterangan'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['jumlah'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['total_harga'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['nama_user'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['alamat'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['no_handphone'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($ds['status'] == "1") { ?>
                                                        <div class="btn-group">
                                                            <a data-toggle="tooltip" data-placement="top"
                                                                href="?page=viewSudahbayar&update&id=<?= $ds['kd_transaksi'] ?>"
                                                                class="btn btn-info"><i class="fa fa-check"></i></a>
                                                        </div>
                                                    <?php } else if ($ds['status'] == "2") {
                                                        echo "Sudah Dikirim";
                                                    } else {
                                                        echo "Sudah Diterima";
                                                    } ?>
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