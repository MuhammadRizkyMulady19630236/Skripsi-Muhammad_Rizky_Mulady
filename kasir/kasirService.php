<?php
$me = new lsp();
if ($_SESSION['level'] != "Kasir") {
    header("location:../index.php");
}
$table = "tb_service";
$dataMerek = $me->select($table);
$autokode = $me->autokode($table, "kd_service", "SV");

if (isset($_POST['getSave'])) {
    $kode_service = $me->validateHtml($_POST['kode_service']);
    $tanggal = $me->validateHtml($_POST['tanggal']);
    $nama_lengkap = $me->validateHtml($_POST['nama_lengkap']);
    $device = $me->validateHtml($_POST['device']);
    $no_handphone = $me->validateHtml($_POST['no_handphone']);
    $kelengkapan = $me->validateHtml($_POST['kelengkapan']);
    $keterangan = $me->validateHtml($_POST['keterangan']);

    if ($kode_service == "" || $tanggal == "" || $nama_lengkap == "" || $device == "" || $no_handphone == "" || $kelengkapan == "" || $keterangan == "") {
        $response = ['response' => 'negative', 'alert' => 'lengkapi field'];
    } else {
        $value = "'$kode_service','$tanggal','$nama_lengkap','$device','$no_handphone','$keterangan','$kelengkapan','0','0'";
        $response = $me->insert($table, $value, "?page=kasirService");
    }
}

?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Service masuk</strong>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="">Kode Service</label>
                                    <input type="text" class="form-control form-control-sm" name="kode_service"
                                        style="font-weight: bold; color: red;" value="<?php echo $autokode; ?>"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" class="form-control form-control-sm" name="tanggal">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-sm" name="nama_lengkap">
                                </div>
                                <div class="form-group">
                                    <label for="">Device</label>
                                    <input type="text" class="form-control form-control-sm" name="device">
                                </div>
                                <div class="form-group">
                                    <label for="">No Handphone</label>
                                    <input type="text" class="form-control form-control-sm" name="no_handphone">
                                </div>
                                <div class="form-group">
                                    <label for="">Kelengkapan</label>
                                    <textarea name="kelengkapan" rows="2" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" rows="2" class="form-control"></textarea>
                                </div>
                                <hr>
                                <?php if (isset($_GET['edit'])): ?>
                                    <button type="submit" name="getUpdate" class="btn btn-warning"><i
                                            class="fa fa-check"></i> Update</button>
                                    <a href="?page=viewMerek" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['edit'])): ?>
                                    <button type="submit" name="getSave" class="btn btn-primary"><i
                                            class="fa fa-download"></i> Simpan</button>
                                    <button type="reset" class="btn btn-danger"><i class="fa fa-eraser"></i> Reset</button>
                                <?php endif ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Service Masuk</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Kode Service</th>
                                            <th>Tanggal</th>
                                            <th>Nama Lengkap</th>
                                            <th>Device</th>
                                            <th>No Handphone</th>
                                            <th>Keterangan</th>
                                            <th>Kelengkapan</th>
                                            <th>Biaya</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($dataMerek as $ds) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $ds['kd_service'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['tanggal'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['nama_lengkap'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['device'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['no_handphone'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['keterangan'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['kelengkapan'] ?>
                                                </td>
                                                <td>
                                                    <?= number_format($ds['jumlah']) ?>
                                                </td>
                                                <td>
                                                    <?php if ($ds['status'] == "0") {
                                                        echo "Belum Selesai";
                                                    } else {
                                                        echo "Sudah Selesai";
                                                    }
                                                    ; ?>
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
                                                            window.location.href = "?page=viewMerek&delete&id=<?php echo $ds['kd_merek'] ?>";
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
        </div>
    </div>
</div>
</div>