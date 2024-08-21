<?php
$me = new lsp();


$dataBelumbayar= $me->querySelect("SELECT * FROM detailtransaksi WHERE status = 0 AND level = 'Pelanggan'");

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
                                <li class="list-inline-item">Pesanan Belum Dibayar</li>
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
                                            <th>Nama Pembeli</th>
                                            <th>Alamat</th>
                                            <th>No Handphone</th>
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
                                                <td>
                                                    <?= $ds['nama_user'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['alamat'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['no_handphone'] ?>
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