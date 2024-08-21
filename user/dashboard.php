<?php
$pg = new lsp();

$dataB = $pg->select("detailbarang");

?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <!-- <div class="row" style="margin-top: -40px;">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 style="color: white;">Mulai Transaksi</h3>

                        </div>
                        <div class="card-body">
                            <a href="?page=kasirTransaksi" class="btn btn-primary">Disini !</a>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <?php
                $no = 1;
                foreach ($dataB as $ds) {
                    ?>
                    <div class="col mb-3 col-lg-3">
                        <a href="?page=detail&id=<?php echo $ds['kd_barang'] ?>">
                            <div class="card">
                                <!-- Product image-->
                                <img class="card-img-top" src="img/<?= $ds['gambar'] ?>" />
                                <!-- Product details-->
                                <div class="card-body">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">
                                            <?= $ds['nama_barang'] ?>
                                        </h5>
                                        <!-- Product price-->
                                        <?= "Rp. " . number_format($ds['harga_barang']) ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>