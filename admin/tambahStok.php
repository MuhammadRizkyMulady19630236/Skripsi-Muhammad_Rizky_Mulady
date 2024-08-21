<?php
$ts = new lsp();
$nstok = new lsp();
$transkode = $ts->autokode("table_stokmasuk", "kd_stokmasuk", "ST");
$barangs = $ts->select("detailbarang");
$getDistr = $ts->select("table_distributor");
$stokN = $nstok->select("stokmasuk");
if (isset($_GET['getItem'])) {
    $id = $_GET['id'];
    $dataR = $ts->selectWhere("detailbarang", "kd_barang", $id);
}

if (isset($_POST['btnAdd'])) {
    $kd_transaksi = $_POST['kd_transaksi'];
    $kd_barang = $_POST['kd_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $harga_modal = $_POST['harmo'];
    $distributor = $_POST['distributor'];
    $date = date("Y-m-d");

    if ($kd_barang == "") {
        $response = ['response' => 'negative', 'alert' => 'Pilih Barang Terlebih Dahulu'];
    } else {
        if ($jumlah < 1) {
            $response = ['response' => 'negative', 'alert' => 'Qty minimal 1'];
        } else {
            $value = "'$kd_transaksi','$date','$kd_barang','$nama_barang','$harga_modal','$jumlah','$distributor','1'";
            $response = $ts->insert("table_stokmasuk", $value, "?page=tambahStok");
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $where = "kd_stokmasuk";
    $response = $ts->delete("table_stokmasuk", $where, $id, "?page=tambahStok");
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
                                <li class="list-inline-item">Tambah Stok Masuk</li>
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Tambah Stok Masuk</h3>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="row" hidden>
                                    <div class="col-md-6">
                                        <label for="">Kode Transaksi</label>
                                        <input style="font-weight: bold; color: red;" type="text" class="form-control"
                                            value="<?= $transkode; ?>" readonly name="kd_transaksi">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="kd_barang" readonly
                                                        placeholder="Kode Produk"
                                                        value="<?php echo @$dataR['kd_barang'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <a class="btn btn-primary btn-block" href="#fajarmodal"
                                                        data-toggle="modal">Pilih Produk</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-4"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama Produk</label>
                                            <input type="text" class="form-control" name="nama_barang"
                                                value="<?php echo @$dataR['nama_barang']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Distributor</label>
                                            <select name="distributor" class="form-control">
                                                <option value=" " disabled selected>Pilih distributor</option>
                                                <?php foreach ($getDistr as $dr) { ?>
                                                    <?php if ($dr['nama_distributor'] == $dataR['nama_distributor'] ?? '') { ?>
                                                        <option value="<?= $dr['kd_distributor'] ?>" selected><?=
                                                              $dr['nama_distributor'] ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $dr['kd_distributor'] ?>"><?=
                                                              $dr['nama_distributor'] ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Harga Modal</label>
                                            <input type="text" class="form-control" name="harmo"
                                                value="<?php echo @$dataR['harga_modal']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Qty</label>
                                            <input type="number" class="form-control" name="jumlah" value="" id="jumjum"
                                                min="0" autocomplete="off">
                                        </div>
                                        <button class="btn btn-primary btn-block" name="btnAdd"><i
                                                class="fa fa-cart-plus"></i>
                                            Tambahkan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Data Stok Masuk</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Produk</th>
                                            <th>Stok Masuk</th>
                                            <th>Harga Modal</th>
                                            <th>Distributor</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($stokN as $ds) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $ds['tanggal'] ?>
                                                </td>
                                                <td>
                                                    <?= "(" . $ds['kd_barang'] . ") " . $ds['nama_barang'] ?>
                                                </td>
                                                <td>
                                                    <?= $ds['jumlah'] ?>
                                                </td>
                                                <td>
                                                    <?= "Rp." . number_format($ds['harga_modal']) . "-," ?>
                                                </td>
                                                <td>
                                                    <?= $ds['nama_distributor'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" id="btdelete<?php echo $no; ?>"
                                                        class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                            <script src="vendor/jquery-3.2.1.min.js"></script>
                                            <script>
                                                $("#btdelete<?php echo $no; ?>").click(function () {
                                                    swal({
                                                        title: "Hapus",
                                                        text: "Yakin Hapus?",
                                                        type: "warning",
                                                        showCancelButton: true,
                                                        confirmButtonText: "Yes",
                                                        cancelButtonText: "Cancel",
                                                        closeOnConfirm: false,
                                                        closeOnCancel: true
                                                    }, function (isConfirm) {
                                                        if (isConfirm) {
                                                            window.location.href = "?page=tambahStok&delete&id=<?= $ds['kd_stokmasuk']; ?>";
                                                        }
                                                    })
                                                })
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

<div class="modal fade" id="fajarmodal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Pilih Produk</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input style="  background-position: 10px 10px;
                                background-repeat: no-repeat;
                                width: 100%;
                                font-size: 16px;
                                padding: 12px 12px 12px 12px;
                                border: 1px solid #ddd;
                                margin-bottom: 12px;" type="text" id="trxKasir" onkeyup="myFunction()"
                    placeholder="Cari Produk ...">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <td>Kode Produk</td>
                            <td>Nama Produk</td>
                            <td>Harga Modal</td>
                            <td>Harga Jual</td>
                            <td>Supplier</td>
                        </tr>
                    </thead>
                    <tbody id="ketKasir">
                        <?php foreach ($barangs as $brs) { ?>
                            <tr>
                                <td><a href="pageAdmin.php?page=tambahStok&getItem&id=<?php echo $brs['kd_barang'] ?>"><?php
                                   echo $brs['kd_barang'] ?></a></td>
                                <td>
                                    <?php echo $brs['nama_barang'] ?>
                                </td>
                                <td>
                                    <?php echo $brs['harga_modal'] ?>
                                </td>
                                <td>
                                    <?php echo $brs['harga_barang'] ?>
                                </td>
                                <td>
                                    <?php echo $brs['nama_distributor'] ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="vendor/jquery-3.2.1.min.js"></script>

<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("trxKasir");
        filter = input.value.toUpperCase();
        table = document.getElementById("ketKasir");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>