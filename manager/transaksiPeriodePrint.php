<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laporan Transaksi</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/mains.css">
</head>

<style>
    body {
        overflow-x: hidden;
    }
</style>
<?php
include "../config/controller.php";
$qb = new lsp();
if (!isset($_GET['dateAwal']) || !isset($_GET['dateAkhir'])) {
    header("location:../PageManager.php?page=periode");
}
$whereparam = "tanggal_beli";
$param = $_GET['dateAwal'];
$param1 = $_GET['dateAkhir'];
$grand = $qb->selectSumWhereBetween("detailtransaksi", "sub_total", "$whereparam", $param, $param1);
$grandM = $qb->selectSumWhereBetween("detailtransaksi", "sub_totalmodal", "$whereparam", $param, $param1);
$dataB = $qb->selectBetween("detailtransaksi", $whereparam, $param, $param1);
?>

<body>
    <div class="row">
        <div class="col-sm-12" style="padding: 50px;">
            <img src="../images/logo.jpg" align="left" width="100x">
            <p align="center"><b>
                    <center>
                        <font size="4">Murakata Sport</font><br>
                        <font size="4"><b>Jalan IR. Pangeran Haji Muhammad Nur, Barabai, Kalimantan Selatan</b></font>
                        <br>
                        <font size="2"><i>Email : murakatasport@gmail.com, Telp/WA 081240002600</i></font><br>
                        <hr size="2px" color="black">
                    </center>
                </b></p>
            <div class="row">
                <div class="col-sm-12" style="padding: 50px;">
                    <p align="center"><b>
                            <center>
                                <font size="5">Data Laporan Transaksi</font>
                            </center>
                        </b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12" style="padding: 50px;">
                    <p class="text-right">Dari tanggal:
                        <?php echo $_GET['dateAwal']; ?> Ke:
                        <?php echo $_GET['dateAkhir'] ?>
                    </p>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>Kode Transaksi</td>
                                <td>Tanggal</td>
                                <td>Nama Penjual</td>
                                <td>Nama Barang</td>
                                <td>Jumlah</td>
                                <td>Penjualan (Harga Modal)</td>
                                <td>Penjualan (Harga Jual)</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count(@$dataB) > 0) {
                                $no = 1;
                                foreach (@$dataB['data'] as $ds) { ?>
                                    <tr>
                                        <td>
                                            <?=
                                                $ds['kd_transaksi'] ?>
                                        </td>
                                        <td>
                                            <?= $ds['tanggal_beli'] ?>
                                        </td>
                                        <td>
                                            <?= $ds['nama_user'] ?>
                                        </td>
                                        <td>
                                            <?= $ds['nama_barang'] ?>
                                        </td>
                                        <td>
                                            <?= $ds['jumlah'] ?>
                                        </td>
                                        <td>
                                            <?= "Rp." . number_format($ds['sub_totalmodal']) . ",-" ?>
                                        </td>
                                        <td>
                                            <?= "Rp." . number_format($ds['sub_total']) . ",-" ?>
                                        </td>
                                    </tr>
                                    <?php $no++;
                                } ?>
                                <tr>
                                    <td colspan="5" style="text-align: center;">Total</td>
                                    <td>
                                        <?php echo "Rp." . number_format($grandM['sum']) . ",-" ?>
                                    </td>
                                    <td>
                                        <?php echo "Rp." . number_format($grand['sum']) . ",-" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: center;">Keuntungan (Harga Jual -
                                        Harga Modal)</td>
                                    <td colspan="2" style="text-align: center;">
                                        <?php echo "Rp." . number_format($grand['sum'] - $grandM['sum']) . ",-" ?>
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada barang di periode ini</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

</body>

</html>

<script>window.print();</script>