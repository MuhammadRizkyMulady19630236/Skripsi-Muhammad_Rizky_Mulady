<?php
$pg = new lsp();

$table = "detailbarang";
$data = $pg->selectWhere($table, "kd_barang", $_GET['id']);

?>

<div class="main-content">
<div class="section__content section__content--p30">
        <div class="container-fluid">
    <?php
    if ($response != "false") { ?>
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="img/<?= @$data['gambar'] ?>" /></div>
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bolder">
                            <?php echo @$data['nama_barang'] ?>
                        </h1><br>
                        <p><b>Harga : </b></p>
                        <p>
                            <?= "Rp. " . number_format(@$data['harga_barang']) ?>
                        </p><br>
                        <p><b>Stok Tersedia : </b></p>
                        <p>
                            <?php echo @$data['stok_barang'] ?>
                        </p><br>
                        <p><b>Merek : </b></p>
                        <p>
                            <?php echo @$data['merek'] ?>
                        </p><br>
                        <p><b>Keterangan : </b></p>
                        <p>
                            <?php echo @$data['keterangan'] ?>
                        </p><br>
                        <div class="d-flex">
                            <a href="?page=kasirTransaksi&getItem&id=<?php echo @$data['kd_barang'] ?>"
                                class="btn btn-primary">
                                <i class="bi-cart-fill me-1"></i>
                                Beli Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-danger">
                        <h3 style="color: white;">Perhatian !!!</h3>
                    </div>
                    <div class="card-body">
                        <p>Maaf, untuk melanjutkan pemesanan custom jersey anda harus melakukan login terlebih
                            dahulu.</p><br>
                        <a href="login.php" class="btn btn-danger">Login</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
    <?php } ?>
</div>