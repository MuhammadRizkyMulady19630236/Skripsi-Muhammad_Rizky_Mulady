<?php
$br = new lsp();
if ($_SESSION['level'] != "Admin") {
    header("location:../index.php");
}
$table = "table_barang";
$getMerek = $br->select("table_merek");
$getDistr = $br->select("table_distributor");
$autokode = $br->autokode("table_barang", "kd_barang", "BR");
$waktu = date("Y-m-d");
if (isset($_POST['getSimpan'])) {
    $kode_barang = $br->validateHtml($_POST['kode_barang']);
    $nama_barang = $br->validateHtml($_POST['nama_barang']);
    $merek_barang = $br->validateHtml($_POST['merek_barang']);
    $distributor = $br->validateHtml($_POST['distributor']);
    $harga_modal = $br->validateHtml($_POST['harga_modal']);
    $harga_jual = $br->validateHtml($_POST['harga_jual']);
    $stok = 0;
    $foto = $_FILES['foto'];
    $ket = $_POST['ket'];

    if ($kode_barang == " " || $nama_barang == " " || $merek_barang == " " || $distributor == " " || $harga_jual == " " || $harga_modal == " " || $foto == " " || $ket == " ") {
        $response = ['response' => 'negative', 'alert' => 'lengkapi field'];
    } else {
        $response = $br->validateImage();
        if ($response['types'] == "true") {
            $value = "'$kode_barang','$nama_barang','$merek_barang','$distributor','$harga_modal','$harga_jual','$stok','$response[image]','$ket'";

            $response = $br->insert($table, $value, "?page=viewBarang");
        }
    }
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
                                <li class="list-inline-item">Tambah Produk</li>
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
                <div class="col-md-12">
                    <form method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                                <div class="bg-overlay bg-overlay--blue"></div>
                                <h3>
                                    <i class="zmdi zmdi-account-calendar"></i>Data Produk
                                </h3>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Kode Produk</label>
                                            <input type="text" style="font-weight: bold; color: red;"
                                                class="form-control" name="kode_barang" value="<?php echo $autokode; ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama Produk</label>
                                            <input type="text" placeholder="Nama Barang" class="form-control"
                                                name="nama_barang" value="<?php echo @$_POST['nama_barang'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Merek</label>
                                            <select name="merek_barang" class="form-control">
                                                <option value=" ">Pilih merek</option>
                                                <?php foreach ($getMerek as $mr) { ?>
                                                    <option value="<?= $mr['kd_merek'] ?>"><?= $mr['merek'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Distributor</label>
                                            <select name="distributor" class="form-control">
                                                <option value=" ">Pilih distributor</option>
                                                <?php foreach ($getDistr as $dr) { ?>
                                                    <option value="<?= $dr['kd_distributor'] ?>"><?= $dr['nama_distributor'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>   
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Harga Jual</label>
                                            <input type="number" class="form-control" name="harga_jual">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Harga Modal</label>
                                            <input type="number" class="form-control" name="harga_modal">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Foto</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Keterangan</label>
                                            <textarea name="ket" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button name="getSimpan" class="btn btn-primary"><i class="fa fa-download"></i>
                                    Simpan</button>
                                <button type="reset" class="btn btn-danger"><i class="fa fa-eraser"></i> Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>