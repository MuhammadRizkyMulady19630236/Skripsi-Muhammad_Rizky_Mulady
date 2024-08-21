<?php
$dis = new lsp();

if ($response != "false") {

    $auth = $dis->AuthUser($_SESSION['username']);
    $kd_user = $auth['kd_user'];
    $table = "tb_customjersey";
    $dataJer = $dis->querySelect("SELECT * FROM tb_customjersey WHERE kd_user = '$kd_user' ");
    $autokode = $dis->autokode($table, "kd_pesanan", "DS");
}

if (isset($_GET['edit'])) {
    $id = $_GET['id'];
    $editData = $dis->selectWhere($table, "kd_distributor", $id);
    $autokode = $editData['kd_distributor'];
}

if (isset($_POST['getSave'])) {
    $kd_pesanan = $dis->validateHtml($_POST['kd_pesanan']);
    $tanggal = $dis->validateHtml($_POST['tanggal']);
    $nama_tim = $dis->validateHtml($_POST['nama_tim']);
    $ket = $dis->validateHtml($_POST['ket']);
    $foto = $_FILES['foto'];

    if ($kd_pesanan == "" || $tanggal == "" || $nama_tim == "" || $ket == "" || $foto == "") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi field'];
    } else {
        $response = $dis->validateImage();
        if ($response['types'] == "true") {
            $value = "'$kd_pesanan','$tanggal','$response[image]','$nama_tim','$ket','0','$kd_user'";

            $response = $dis->insert($table, $value, "?page=viewJersey");
        } else {
            $response = ['response' => 'negative', 'alert' => 'gambar error'];
        }
    }
}

?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <?php
            if ($response != "false") { ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title mb-3">Pemesanan Jersey</strong>
                            </div>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="">Kode Pemesanan Jersey</label>
                                        <input type="text" class="form-control form-control-sm" name="kd_pesanan"
                                            style="font-weight: bold; color: red;" value="<?php echo $autokode; ?>"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal</label>
                                        <input type="date" class="form-control form-control-sm" name="tanggal" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Tim</label>
                                        <input type="text" class="form-control form-control-sm" name="nama_tim" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <textarea name="ket" rows="2" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group" id="fotoF">
                                        <label for="">Foto Desain Jersey</label>
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="file" name="foto" id="foto" class="form-control-file">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <?php if (isset($_GET['edit'])): ?>
                                        <button type="submit" name="getUpdate" class="btn btn-warning"><i
                                                class="fa fa-check"></i> Update</button>
                                        <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                    <?php endif ?>
                                    <?php if (!isset($_GET['edit'])): ?>
                                        <button type="submit" name="getSave" class="btn btn-primary btn-block"><i
                                                class="fa fa-send"></i> Kirim</button>
                                    <?php endif ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title mb-3">Data Pesanan Saya</strong>
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
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($dataJer as $ds) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $ds['kd_pesanan'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $ds['tanggal'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $ds['nama_tim'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $ds['keterangan'] ?>
                                                    </td>
                                                    <td>
                                                        <a href="img/<?= $ds['foto_referensi'] ?>" target="_blank">Lihat
                                                            Foto</a>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($ds['status'] == '1') { ?>
                                                            <b>Sudah Selesai</b>
                                                        <?php } else if ($ds['status'] == '3') {
                                                            echo "Dibatalkan";
                                                        } else if ($ds['status'] == '0') {
                                                            echo "Menunggu Dikonfirmasi";
                                                        } else if ($ds['status'] == '2') {
                                                            echo "Sedang Dikerjakan";
                                                        } ?>
                                                    </td>
                                                </tr>
                                                <script src="vendor/jquery-3.2.1.min.js"></script>
                                                <script>
                                                    $('#btnDelete<?php echo $no; ?>').click(function (e) {
                                                        e.preventDefault();
                                                        swal({
                                                            title: "Hapus",
                                                            text: "Yakin Ingin menghapus?",
                                                            type: "error",
                                                            showCancelButton: true,
                                                            confirmButtonText: "Yes",
                                                            cancelButtonText: "Cancel",
                                                            closeOnConfirm: false,
                                                            closeOnCancel: true
                                                        }, function (isConfirm) {
                                                            if (isConfirm) {
                                                                window.location.href = "?page=viewDistributor&delete&id=<?php echo $ds['kd_distributor'] ?>";
                                                            }
                                                        });
                                                    });
                                                </script>
                                                <?php $no++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            <?php } ?>
        </div>
    </div>
</div>
</div>