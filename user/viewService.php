<?php
$dis = new lsp();

if (isset($_POST['getSave'])) {
    $kd_pesanan = $dis->validateHtml($_POST['kd_pesanan']);
    $editData = $dis->selectWhere("tb_service", "kd_service", $kd_pesanan);
}

?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Tracking Service</strong>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="">Masukkan Kode Layanan Service</label>
                                    <input type="text" class="form-control form-control" name="kd_pesanan"
                                        placeholder="Masukkan Kode Layanan Service">
                                </div>
                                <?php if (!isset($_GET['edit'])): ?>
                                    <button type="submit" name="getSave" class="btn btn-primary btn-block"><i
                                            class="fa fa-send"></i> Kirim</button>
                                <?php endif ?>
                                <?php if (isset($_POST['getSave'])): ?>
                                    <a href="?page=viewService" class="btn btn-danger btn-block">Reset</a>
                                    <hr>
                                    <div class="form-group">
                                        <label for="">Tanggal</label>
                                        <input type="date" class="form-control form-control" name="tanggal"
                                            value="<?php echo @$editData['tanggal']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Device</label>
                                        <input type="text" class="form-control form-control" name="tanggal"
                                            value="<?php echo @$editData['device']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <input type="text" class="form-control form-control" name="tanggal" value="<?php if (@$editData['status'] == "0") {
                                            echo "Belum Selesai";
                                        } else {
                                            echo "Sudah Selesai";
                                        }
                                        ; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Total Biaya</label>
                                        <input type="text" class="form-control form-control" name="tanggal"
                                            value="<?= @$editData['jumlah'] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <textarea name="keterangan" rows="3" class="form-control"
                                            readonly><?php echo @$editData['keterangan']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kelengkapan</label>
                                        <textarea name="keterangan" rows="2" class="form-control"
                                            readonly><?php echo @$editData['kelengkapan']; ?></textarea>
                                    </div>
                                <?php endif ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>