<?php
$dis = new lsp();

$table = "tb_customjersey";
$data1 = $dis->querySelect("SELECT * FROM detailjersey WHERE status = '1'");
$data2 = $dis->querySelect("SELECT * FROM detailjersey WHERE status = '2'");
$data3 = $dis->querySelect("SELECT * FROM detailjersey WHERE status = '3'");
$data4 = $dis->querySelect("SELECT * FROM detailjersey WHERE status = '0'");
$autokode = $dis->autokode($table, "kd_pesanan", "DS");

if (isset($_GET['konfir'])) {
    $value = "status='2'";
    $response = $dis->update($table, $value, "kd_pesanan", $_GET['id'], "?page=viewJersey");
}

if (isset($_GET['cancel'])) {
    $value = "status='3'";
    $response = $dis->update($table, $value, "kd_pesanan", $_GET['id'], "?page=viewJersey");
}

if (isset($_GET['done'])) {
    $value = "status='1'";
    $response = $dis->update($table, $value, "kd_pesanan", $_GET['id'], "?page=viewJersey");
}

?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Pesanan Jersey Menunggu Konfirmasi</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Kode Pemesanan</th>
                                            <th>Tanggal</th>
                                            <th>Nama Tim</th>
                                            <th>Keterangan</th>
                                            <th>Desain Jersey</th>
                                            <th>Nama Pemesan</th>
                                            <th>Nomor HP</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data4 as $d4) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $d4['kd_pesanan'] ?>
                                                </td>
                                                <td>
                                                    <?= $d4['tanggal'] ?>
                                                </td>
                                                <td>
                                                    <?= $d4['nama_tim'] ?>
                                                </td>
                                                <td>
                                                    <?= $d4['keterangan'] ?>
                                                </td>
                                                <td>
                                                    <a href="img/<?= $d4['foto_referensi'] ?>" target="_blank">Lihat
                                                        Foto</a>
                                                </td>
                                                <td>
                                                    <?= $d4['nama_user'] ?>
                                                </td>
                                                <td>
                                                    <?= $d4['no_handphone'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                            href="?page=viewJersey&konfir&id=<?= $d4['kd_pesanan'] ?>"
                                                            class="btn btn-success"><i class="fa fa-check"></i></a>
                                                        <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                            href="?page=viewJersey&cancel&id=<?= $d4['kd_pesanan'] ?>"
                                                            class="btn btn-danger"><i class="fa fa-close"></i></a>
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

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Pesanan Jersey Sudah Selesai</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Kode Pemesanan</th>
                                            <th>Tanggal</th>
                                            <th>Nama Tim</th>
                                            <th>Keterangan</th>
                                            <th>Desain Jersey</th>
                                            <th>Nama Pemesan</th>
                                            <th>Nomor HP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data1 as $d1) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $d1['kd_pesanan'] ?>
                                                </td>
                                                <td>
                                                    <?= $d1['tanggal'] ?>
                                                </td>
                                                <td>
                                                    <?= $d1['nama_tim'] ?>
                                                </td>
                                                <td>
                                                    <?= $d1['keterangan'] ?>
                                                </td>
                                                <td>
                                                    <a href="img/<?= $d1['foto_referensi'] ?>" target="_blank">Lihat
                                                        Foto</a>
                                                </td>
                                                <td>
                                                    <?= $d1['nama_user'] ?>
                                                </td>
                                                <td>
                                                    <?= $d1['no_handphone'] ?>
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

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Pesanan Jersey Sedang Diproses</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Kode Pemesanan</th>
                                            <th>Tanggal</th>
                                            <th>Nama Tim</th>
                                            <th>Keterangan</th>
                                            <th>Desain Jersey</th>
                                            <th>Nama Pemesan</th>
                                            <th>Nomor HP</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data2 as $d2) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $d2['kd_pesanan'] ?>
                                                </td>
                                                <td>
                                                    <?= $d2['tanggal'] ?>
                                                </td>
                                                <td>
                                                    <?= $d2['nama_tim'] ?>
                                                </td>
                                                <td>
                                                    <?= $d2['keterangan'] ?>
                                                </td>
                                                <td>
                                                    <a href="img/<?= $d2['foto_referensi'] ?>" target="_blank">Lihat
                                                        Foto</a>
                                                </td>
                                                <td>
                                                    <?= $d2['nama_user'] ?>
                                                </td>
                                                <td>
                                                    <?= $d2['no_handphone'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                            href="?page=viewJersey&done&id=<?= $d2['kd_pesanan'] ?>"
                                                            class="btn btn-success"><i class="fa fa-check"></i></a>
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

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Pesanan Jersey Dibatalkan</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Kode Pemesanan</th>
                                            <th>Tanggal</th>
                                            <th>Nama Tim</th>
                                            <th>Keterangan</th>
                                            <th>Desain Jersey</th>
                                            <th>Nama Pemesan</th>
                                            <th>Nomor HP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data3 as $d3) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $d3['kd_pesanan'] ?>
                                                </td>
                                                <td>
                                                    <?= $d3['tanggal'] ?>
                                                </td>
                                                <td>
                                                    <?= $d3['nama_tim'] ?>
                                                </td>
                                                <td>
                                                    <?= $d3['keterangan'] ?>
                                                </td>
                                                <td>
                                                    <a href="img/<?= $d3['foto_referensi'] ?>" target="_blank">Lihat
                                                        Foto</a>
                                                </td>
                                                <td>
                                                    <?= $d3['nama_user'] ?>
                                                </td>
                                                <td>
                                                    <?= $d3['no_handphone'] ?>
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