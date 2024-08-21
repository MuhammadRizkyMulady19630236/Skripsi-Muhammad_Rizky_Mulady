<?php
$op = new lsp();
$nstok = new lsp();
$transkode = $op->autokode("table_biayaoperasional", "kd_biayaoperasional", "BO");
$biayaO = $nstok->select("table_biayaoperasional");

if (isset($_POST['btnAdd'])) {
    $kd_transaksi = $_POST['kd_transaksi'];
    $keterangan = $_POST['keterangan'];
    $kategori = $_POST['kategori'];
    $biaya = $_POST['biaya'];
    $date = $_POST['date'];

    if ($keterangan == " " || $kategori == " " || $biaya == " ") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi Field'];
    } else {
        $value = "'$kd_transaksi','$date','$keterangan','$kategori','$biaya','1'";
        $response = $op->insert("table_biayaoperasional", $value, "?page=biayaOperasional");
    }
}

if (isset($_POST['btnUpdate'])) {
    $kd_transaksi = $_POST['kd_transaksi'];
    $keterangan = $_POST['keterangan'];
    $kategori = $_POST['kategori'];
    $biaya = $_POST['biaya'];
    $date = $_POST['date'];

    if ($keterangan == " " || $kategori == " " || $biaya == " ") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi Field'];
    } else {
        $value = "keterangan='$keterangan',kategori='$kategori',jumlah='$biaya',tanggal='$date'";
        $response = $op->update("table_biayaoperasional", $value, "kd_biayaoperasional", $_GET['id'], "?page=biayaOperasional");
    }
}

if (isset($_GET['edit'])) {
    $id = $_GET['id'];
    $editData = $op->selectWhere("table_biayaoperasional", "kd_biayaoperasional", $id);
    $transkode = $editData['kd_biayaoperasional'];
}
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
                                <li class="list-inline-item">Biaya Operasional</li>
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
            <div class="row" >
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Biaya Operasional</h3>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Kode Transaksi</label>
                                            <input style="font-weight: bold; color: red;" type="text"
                                                class="form-control" value="<?= $transkode; ?>" readonly
                                                name="kd_transaksi">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal</label>
                                            <input type="date" class="form-control" name="date"
                                                value="<?php echo @$editData['tanggal']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Keterangan</label>
                                            <textarea name="keterangan" rows="2"
                                                class="form-control"><?php echo @$editData['keterangan'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kategori</label>
                                            <select name="kategori" class="form-control">
                                                <option value=" " disabled selected>Pilih kategori</option>
                                                <option value="Gaji Karyawan" <?php if (@$editData['kategori'] == "Gaji Karyawan") {
                                                    echo "selected";
                                                } ?>>Gaji Karyawan</option>
                                                <option value="Tunjangan Pegawai" <?php if (@$editData['kategori'] == "Tunjangan Pegawai") {
                                                    echo "selected";
                                                } ?>>Tunjangan Pegawai</option>
                                                <option value="Transportasi" <?php if (@$editData['kategori'] == "Transportasi") {
                                                    echo "selected";
                                                } ?>>Transportasi</option>
                                                <option value="Komisi Penjualan" <?php if (@$editData['kategori'] == "Komisi Penjualan") {
                                                    echo "selected";
                                                } ?>>Komisi Penjualan</option>
                                                <option value="Perbaikan" <?php if (@$editData['kategori'] == "Perbaikan") {
                                                    echo "selected";
                                                } ?>>Perbaikan</option>
                                                <option value="Utilitas" <?php if (@$editData['kategori'] == "Utilitas") {
                                                    echo "selected";
                                                } ?>>Utilitas</option>
                                                <option value="Lainnya" <?php if (@$editData['kategori'] == "Lainnya") {
                                                    echo "selected";
                                                } ?>>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Biaya</label>
                                            <input type="number" class="form-control" name="biaya"
                                                value="<?php echo @$editData['jumlah']; ?>">
                                        </div>
                                        <?php if (isset($_GET['edit'])): ?>
                                            <button type="submit" name="btnUpdate" class="btn btn-warning"><i
                                                    class="fa fa-check"></i> Update</button>
                                            <a href="?page=biayaOperasional" class="btn btn-danger">Cancel</a>
                                        <?php endif ?>
                                        <?php if (!isset($_GET['edit'])): ?>
                                            <button class="btn btn-primary btn-block" name="btnAdd"><i
                                                    class="fa fa-cart-plus"></i>
                                                Tambahkan</button>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Data Biaya Operasional</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Kategori</th>
                                            <th>Biaya</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($biayaO as $ds) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $ds['tanggal'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['keterangan'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['kategori'] ?>
                                                </td>
                                                <td>
                                                    <?= "Rp." . number_format($ds['jumlah']) . "-," ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                            href="?page=biayaOperasional&edit&id=<?= $ds['kd_biayaoperasional'] ?>"
                                                            class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
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

<script src="vendor/jquery-3.2.1.min.js"></script>