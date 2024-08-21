<?php
$trs = new lsp();
$dataTransaksi = $trs->select("stokmasuk");
if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $dataDetail = $trs->edit("stokmasuk", "kd_distributor", $id);
      $dataDistri = $trs->selectWhere("table_distributor", "kd_distributor", $id);
      $total = '0';
      $jumlah_barang = $trs->selectSumWhere("stokmasuk", "jumlah", "kd_distributor='$id'");
}
?>
<style>
      .col-sm-12 {
            background: white;
            padding: 20px;
      }

      @media print {
            table {
                  align-content: center;
            }

            .btn {
                  display: none !important;
            }

            .ds {
                  display: none;
            }

            .cari {
                  display: none !important;
                  box-shadow: none !important;
            }

            .hd {
                  display: none;
            }
      }
</style>
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
                                <li class="list-inline-item">Data Transaksi Distributor</li>
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
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3"></div>
                  </div>
                  <div class="row">
                        <div class="col-sm-12">
                              <!-- <div class="tile"> -->
                              <?php if (isset($_GET['id'])): ?>
                                    <h4>DATA RINCIAN PEMBELIAN KE DISTRIBUTOR</h4>
                                    <hr>
                                    <div class="row">
                                          <div class="col-sm-6">Nama Distributor :
                                                <?php echo @$dataDistri['nama_distributor']; ?>
                                          </div>
                                          <div class="col-sm-6">
                                                <p class="text-right"><span>
                                                            <?php echo "Tanggal Cetak : " . date("Y-m-d"); ?>
                                                </p>
                                          </div>
                                    </div>
                                    <br>
                                    <table class="table table-striped table-bordered" width="80%">
                                          <tr>
                                                <td>Kode Stok Masuk</td>
                                                <td>Tanggal</td>
                                                <td>Nama Barang</td>
                                                <td>Harga Modal</td>
                                                <td>Jumlah Stok</td>
                                                <td>Jumlah Harga</td>
                                          </tr>
                                          <?php foreach ($dataDetail as $dd): ?>
                                                <?php $total = $total + $dd['jumlah'] * $dd['harga_modal']; ?>

                                                <tr>
                                                      <td>
                                                            <?= $dd['kd_stokmasuk'] ?>
                                                      </td>
                                                      <td>
                                                            <?= $dd['tanggal'] ?>
                                                      </td>
                                                      <td>
                                                            <?= $dd['nama_barang'] ?>
                                                      </td>
                                                      <td>
                                                            <?= $dd['harga_modal'] ?>
                                                      </td>
                                                      <td>
                                                            <?= $dd['jumlah'] ?>
                                                      </td>
                                                      <td>
                                                            <?php echo "Rp." . number_format($dd['jumlah'] * $dd['harga_modal']) ?>
                                                      </td>
                                                </tr>
                                          <?php endforeach ?>
                                          <tr>
                                                <td colspan="4"></td>
                                                <td colspan="1">Total</td>
                                                <td>
                                                      <?php echo "Rp." . number_format($total) . ",-" ?>
                                                </td>
                                          </tr>
                                    </table>
                                    <br>
                                    <a href="?page=viewDistributor" class="btn btn-danger"><i class="fa fa-arrow-left"></i>
                                          Kembali</a>
                                    <a href="#" class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i>
                                          Print</a>
                              <?php endif ?>
                              <?php if (!isset($_GET['id'])): ?>
                                    <img src="http://localhost/pkl_murakatasport/images/logo.jpg" align="left" width="100x">
                                    <p align="center"><b>
                                                <center>
                                                      <font size="4">Murakata Sport</font><br>
                                                      <font size="4"><b>Jalan IR. Pangeran Haji Muhammad Nur, Barabai,
                                                                  Kalimantan Selatan</b></font><br>
                                                      <font size="2"><i>Email : murakatasport@gmail.com, Telp/WA
                                                                  081240002600</i></font><br>
                                                      <hr size="2px" color="black">
                                                </center>
                                          </b></p>
                                    <div class="row">
                                          <div class="col-sm-12" style="padding: 50px;">
                                                <p align="center"><b>
                                                            <center>
                                                                  <font size="5">Data Semua Transaksi</font>
                                                            </center>
                                                      </b></p>
                                                <div class="row" style="align-items: center;">
                                                      <div class="col-6">
                                                            <a href="#" class="btn btn-primary" onclick="window.print();"><i
                                                                        class="fa fa-print"></i> Print</a>
                                                      </div>
                                                </div>
                                                <br>
                                                <table class="table table-hover table-bordered" width="100%;" align="center">
                                                      <thead>
                                                            <tr>
                                                                  <td>Kode Stok Masuk</td>
                                                                  <td>Tanggal</td>
                                                                  <td>Nama Penjual</td>
                                                                  <td>Nama Barang</td>
                                                                  <td>Jumlah</td>
                                                                  <td>Penjualan (Harga Modal)</td>
                                                                  <td>Penjualan (Harga Jual)</td>
                                                            </tr>
                                                      </thead>
                                                      <tbody>
                                                            <?php foreach ($dataTransaksi as $dts): ?>
                                                                  <tr>
                                                                        <td><a href="?page=kelTransaksi&id=<?= $dts['kd_transaksi']; ?>"><?=
                                                                                $dts['kd_transaksi'] ?></a></td>
                                                                        <td>
                                                                              <?= $dts['tanggal_beli'] ?>
                                                                        </td>
                                                                        <td>
                                                                              <?= $dts['nama_user'] ?>
                                                                        </td>
                                                                        <td>
                                                                              <?= $dts['nama_barang'] ?>
                                                                        </td>
                                                                        <td>
                                                                              <?= $dts['jumlah'] ?>
                                                                        </td>
                                                                        <td>
                                                                              <?= "Rp." . number_format($dts['sub_totalmodal']) . ",-" ?>
                                                                        </td>
                                                                        <td>
                                                                              <?= "Rp." . number_format($dts['sub_total']) . ",-" ?>
                                                                        </td>
                                                                  </tr>
                                                            <?php endforeach ?>
                                                            <?php
                                                            $grand = $trs->selectSum("transaksi", "sub_total");
                                                            $grandM = $trs->selectSum("transaksi", "sub_totalmodal");
                                                            ?>
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
                                                                  <td colspan="5" style="text-align: center;">Keuntungan
                                                                        (Harga Jual -
                                                                        Harga Modal)</td>
                                                                  <td colspan="2" style="text-align: center;">
                                                                        <?php echo "Rp." . number_format($grand['sum'] - $grandM['sum']) . ",-" ?>
                                                                  </td>
                                                            </tr>
                                                      </tbody>
                                                </table>
                                          <?php endif ?>
                                          <!-- </div> -->
                                    </div>

                              </div>
                        </div>

                  </div>
            </div>