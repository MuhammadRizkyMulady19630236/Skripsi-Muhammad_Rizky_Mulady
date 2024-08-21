<?php
$trs = new lsp();
$dataTransaksi = $trs->select("detailtransaksi");
if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $dataDetail = $trs->edit("detailtransaksi", "kd_transaksi", $id);
      $total = $trs->selectSumWhere("detailtransaksi", "sub_total", "kd_transaksi='$id'");
      $jumlah_barang = $trs->selectSumWhere("detailtransaksi", "jumlah", "kd_transaksi='$id'");
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
<div class="main-content">
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
                                    <h4>Struk</h4>
                                    <p>Murakata Sport</p>
                                    <hr>
                                    <div class="row">
                                          <div class="col-sm-6">Kode Transaksi :
                                                <?php echo $id ?>
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
                                                <td>Kode Antrian</td>
                                                <td>Nama Barang</td>
                                                <td>Harga Satuan</td>
                                                <td>Jumlah</td>
                                                <td>Sub Total</td>
                                          </tr>
                                          <?php foreach ($dataDetail as $dd): ?>
                                                <tr>
                                                      <td>
                                                            <?= $dd['kd_pretransaksi'] ?>
                                                      </td>
                                                      <td>
                                                            <?= $dd['nama_barang'] ?>
                                                      </td>
                                                      <td>
                                                            <?= $dd['harga_barang'] ?>
                                                      </td>
                                                      <td>
                                                            <?= $dd['jumlah'] ?>
                                                      </td>
                                                      <td>
                                                            <?= "Rp." . number_format($dd['sub_total']) . ",-" ?>
                                                      </td>
                                                </tr>
                                          <?php endforeach ?>
                                          <tr>
                                                <td colspan="2"></td>
                                                <td>Jumlah Pembelian Barang</td>
                                                <td>
                                                      <?php echo $jumlah_barang['sum'] ?>
                                                </td>
                                                <td></td>
                                          </tr>
                                          <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2">Total</td>
                                                <td>
                                                      <?php echo "Rp." . number_format($total['sum']) . ",-" ?>
                                                </td>
                                          </tr>
                                    </table>
                                    <br>
                                    <p>Tanggal Beli :
                                          <?php echo $dd['tanggal_beli']; ?>
                                    </p>
                                    <br>
                                    <a href="?page=kelTransaksi" class="btn btn-danger"><i class="fa fa-arrow-left"></i>
                                          Kembali</a>
                                    <a href="#" class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i>
                                          Print</a>
                              <?php endif ?>
                              <?php if (!isset($_GET['id'])): ?>
                                    <img src="./images/logo.jpg" align="left" width="100x">
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
                                                                  <td>Kode Transaksi</td>
                                                                  <td>Tanggal</td>
                                                                  <td>Nama Penjual</td>
                                                                  <td>Nama Barang</td>
                                                                  <td>Jumlah</td>
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
                                                                              <?= "Rp." . number_format($dts['sub_total']) . ",-" ?>
                                                                        </td>
                                                                  </tr>
                                                            <?php endforeach ?>
                                                            <?php
                                                            $grand = $trs->selectSum("transaksi", "sub_total");
                                                            $grandM = $trs->selectSum("transaksi", "sub_totalmodal");
                                                            ?>
                                                      </tbody>
                                                </table>
                                          <?php endif ?>
                                          <!-- </div> -->
                                    </div>

                              </div>
                        </div>

                  </div>
            </div>