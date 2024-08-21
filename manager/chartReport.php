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
                                    <div class="col-sm-12" style="padding: 50px;">
                                          <p align="center"><b>
                                                      <center>
                                                            <font size="5">Ringkasan Statistik Penjualan 7 Hari Terakhir
                                                            </font>
                                                      </center>
                                                </b></p>
                                          <div class="row" style="align-items: center;">
                                                <div class="col-6">
                                                      <a href="#" class="btn btn-primary" onclick="window.print();"><i
                                                                  class="fa fa-print"></i> Print</a>
                                                </div>
                                          </div>
                                          <br>
                                          <div style="padding: 20px;">
                                                <canvas id="myChart"></canvas>
                                          </div>
                                    <?php endif ?>
                                    <!-- </div> -->
                              </div>
                        </div>

                  </div>
            </div>