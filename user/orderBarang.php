<?php
$br = new lsp();
$table = "detailbarang";
$data = $br->selectWhere($table, "kd_barang", $_GET['id']);

$waktu = date("Y-m-d");

?>


<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <?php
            if ($response != "false") { ?>
                <div class="row">
                    <div class="col-md-12">
                        <form action="user/prosespayment.php" method="POST">
                            <div class="card">
                                <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                                    <div class="bg-overlay bg-overlay--blue"></div>
                                    <h3>
                                        <i class="zmdi zmdi-account-calendar"></i>Form Order
                                    </h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="">Kode Produk</label>
                                                <input type="text" style="font-weight: bold; color: red;"
                                                    class="form-control" name="kode_barang"
                                                    value="<?php echo @$data['kd_barang'] ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Nama Produk</label>
                                                <input type="text" placeholder="Nama Barang" class="form-control"
                                                    name="nama_barang" value="<?php echo @$data['nama_barang'] ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Merek</label>
                                                <input type="text" placeholder="Merek" class="form-control" name="merek"
                                                    value="<?php echo @$data['merek'] ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Harga</label>
                                                <input type="text" placeholder="Harga" class="form-control" name="harga"
                                                    value="<?= "Rp. " . number_format(@$data['harga_barang']) ?>" readonly>
                                            </div>
                                            <div class="form-group" id="fotoF">
                                                <label for="">Foto Produk</label><br>
                                                <img alt="" src="img/<?= $data['gambar'] ?>" width="120"
                                                    class="img-responsive" id="pict">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="?page=detail&id=<?php echo @$data['kd_barang'] ?>" class="btn btn-danger"><i
                                            class="fa fa-arrow-left"></i> Kembali</a>
                                    <button name="getSimpan" class="btn btn-primary"><i class="fa fa-send"></i>
                                        Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h3 style="color: white;">Perhatian !!!</h3>
                            </div>
                            <div class="card-body">
                                <p>Maaf, untuk melanjutkan transaksi anda harus melakukan login terlebih dahulu.</p><br>
                                <a href="login.php" class="btn btn-primary">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
