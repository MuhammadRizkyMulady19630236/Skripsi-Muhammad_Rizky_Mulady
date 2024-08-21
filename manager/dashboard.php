<?php
$pg = new lsp();
$pegawai = $pg->selectCount("table_user", "kd_user");
$barang = $pg->selectCount("table_barang", "kd_barang");
$berhasil = $pg->selectCount("table_transaksi", "kd_transaksi");
$assoc1 = $pg->selectCount("table_transaksi", "jumlah_beli");
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
                                <li class="list-inline-item">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-circle"></i>
                                </div>
                                <div class="text">
                                    <h2>
                                        <?= $pegawai['count'] ?>
                                    </h2>
                                    <span>Pegawai</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-shopping-cart"></i>
                                </div>
                                <div class="text">
                                    <h2>
                                        <?= $barang['count'] ?>
                                    </h2>
                                    <span>Barang</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-money-box"></i>
                                </div>
                                <div class="text">
                                    <h2>
                                        <?= $berhasil['count'] ?>
                                    </h2>
                                    <span>Transaksi</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-assignment-check"></i>
                                </div>
                                <div class="text">
                                    <h2>
                                        <?= $assoc1['count']; ?>
                                    </h2>
                                    <span>Barang Terjual</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart4"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Statistik Penjualan</h3>
                        </div>
                        <form action="?page" method="GET" id="form_id">
                        <div class="card-body">
                            <select name="pilih" class="form-control" onChange="document.getElementById('form_id').submit();">
                                <option value='-7 day' <?php if (@$_GET['pilih'] == "-7 day") {
                                    echo "selected";}?>>7 Hari Terakhir</option>
                                <option value='-15 day' <?php if (@$_GET['pilih'] == "-15 day") {
                                    echo "selected";}?>>15 Hari Terakhir</option>
                            </select>
                            <br>
                            <div style="padding: 20px;">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>