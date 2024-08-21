<?php 
    $trans     = new lsp();
    $transkode = $trans->autokode("table_transaksi","kd_transaksi","TR");
    $antrian   = $trans->autokode("table_pretransaksi","kd_pretransaksi","AN");
    $barangs   = $trans->selectBarang("table_barang","stok_barang",0);
    if (isset($_GET['getItem'])) {
        $id = $_GET['id'];
        $dataR = $trans->selectWhere("table_barang","kd_barang",$id);
    }
    $sum       = $trans->selectSum("table_pretransaksi","sub_total");
    $sql2      = "SELECT COUNT(kd_pretransaksi) as count FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
    $exec2     = mysqli_query($con,$sql2);
    $assoc2    = mysqli_fetch_assoc($exec2);

    if (isset($_POST['btnAdd'])) {
        if (!isset($_SESSION['transaksi'])) {
            $_SESSION['transaksi'] = true;
        }
        $kd_transaksi    = $_POST['kd_transaksi'];
        $kd_pretransaksi = $_POST['kd_pretransaksi'];
        $barang          = $_POST['kd_barang'];
        $nama_barang     = $_POST['nama_barang'];
        $jumlah          = $_POST['jumlah'];
        $total           = $_POST['total'];
        $total_modal     = $_POST['totalmodal'];


        if ($kd_transaksi == "" || $kd_pretransaksi == "" || $barang == "" || $jumlah == "" || $total == "") {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
            if ($jumlah < 1) {
                $response = ['response'=>'negative','alert'=>'Pembelian minimal 1'];
            }else{
                $sisa = $trans->selectWhere("table_barang","kd_barang",$barang);
                if ($sisa['stok_barang'] < $jumlah) {
                    $response = ['response'=>'negative','alert'=>'Stok tersisa '.$sisa['stok_barang']];
                }else{
                    $sql = "SELECT * FROM table_pretransaksi WHERE kd_transaksi = '$kd_transaksi' AND kd_barang = '$barang'";
                    $exe = mysqli_query($con,$sql);
                    $num = mysqli_num_rows($exe);
                    $dta = mysqli_fetch_assoc($exe);
                    if ($num > 0) {
                        $jumlah = $dta['jumlah'] + $jumlah;
                        $value = "jumlah='$jumlah'";
                        $insert = $trans->update("table_pretransaksi",$value,"kd_transaksi = '$kd_transaksi' AND kd_barang",$barang,"?page=kasirTransaksi");
                    }else{
                        $value = "'$kd_pretransaksi','$kd_transaksi','$barang','$nama_barang','$jumlah','$total','$total_modal','1',''";
                        $insert = $trans->insert("table_pretransaksi",$value,"?page=kasirTransaksi");
                    }
                }
            }
        }
    }

    if (isset($_GET['delete'])) {
        $id       = $_GET['id'];
        $where    = "kd_pretransaksi";
        $response = $trans->delete("table_pretransaksi",$where,$id,"?page=kasirTransaksi");
    }

 ?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                    <div class="card-header">
                        <h3>Pilih Produk</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Kode Transaksi</label>
                                    <input style="font-weight: bold; color: red;" type="text" class="form-control" value="<?= $transkode; ?>" readonly name="kd_transaksi">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Kode Antrian</label>
                                    <input style="font-weight: bold; color: red;" type="text" class="form-control" value="<?= $antrian; ?>" readonly name="kd_pretransaksi" id="antrian">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="kd_barang" readonly placeholder="Kode barang" value="<?php echo @$dataR['kd_barang'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <a class="btn btn-primary btn-block" href="#fajarmodal" data-toggle="modal">Pilih Produk</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-4"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Produk</label>
                                        <input type="text" class="form-control" name="nama_barang" value="<?php echo @$dataR['nama_barang']; ?>" readonly>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="">Harga Modal</label>
                                        <input type="text" class="form-control" max="100" name="harmo" value="<?php echo @$dataR['harga_modal']; ?>" id="harmo">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Harga Produk</label>
                                        <input type="text" class="form-control" max="100" name="harba" value="<?php echo @$dataR['harga_barang']; ?>" id="harba">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jumlah</label>
                                        <input type="number" class="form-control" name="jumlah" value="" id="jumjum" min="0" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Total</label>
                                        <input type="text" class="form-control" max="100" name="total" readonly id="totals">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="">Total Modal</label>
                                        <input type="text" class="form-control" max="100" name="totalmodal" readonly id="totalsmodal">
                                    </div>
                                    <button class="btn btn-primary btn-block" name="btnAdd"><i class="fa fa-cart-plus"></i> Tambahkan ke Antrian</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Antrian Produk</h3>
                        </div>
                        <div class="card-body">
                            <?php if ($assoc2['count'] > 0 || isset($_POST['btnAdd'])): ?>  
                                <a class="btn btn-success" id="pembayaran" href="?page=kasirPembayaran">Lanjutkan ke pembayaran <i class="fa fa-cart-arrow-down"></i></a>
                            <?php endif ?>
                            <br><br>
                            <?php
                                $kr        = new lsp();
                                $transkode = $kr->autokode("table_transaksi","kd_transaksi","TR");
                                $datas     = $kr->querySelect("SELECT * FROM transaksi WHERE kd_transaksi = '$transkode'");
                                $sql       = "SELECT SUM(sub_total) as sub FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
                                $exec      = mysqli_query($con,$sql);
                                $assoc     = mysqli_fetch_assoc($exec);

                             ?>
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>Kode Antrian</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Sub Total</th>
                                        <td>Batal beli</td>
                                    </tr>
                                    <?php 
                                        if (count($datas) > 0) {
                                        $no = 1;
                                        foreach($datas as $dd){ ?>
                                        <tr>
                                            <td><?= $dd['kd_pretransaksi']; ?></td>
                                            <td><?= $dd['nama_barang']; ?></td>
                                            <td><?= $dd['jumlah']; ?></td>
                                            <td><?= $dd['sub_total']; ?></td>
                                            <td class="text-center">
                                                <a href="#" id="btdelete<?php echo $no; ?>" class="btn btn-danger">Batal</a>
                                            </td>
                                        </tr>
                                        <script src="vendor/jquery-3.2.1.min.js"></script>
                                        <script>
                                            $("#btdelete<?php echo $no; ?>").click(function(){
                                                swal({
                                                    title: "Hapus",
                                                    text: "Yakin Hapus?",
                                                    type: "warning",
                                                    showCancelButton: true,
                                                    confirmButtonText: "Yes",
                                                    cancelButtonText: "Cancel",
                                                    closeOnConfirm: false,
                                                    closeOnCancel: true
                                                },function(isConfirm){
                                                    if (isConfirm) {
                                                        window.location.href="?page=kasirTransaksi&delete&id=<?= $dd['kd_pretransaksi']; ?>";
                                                    }
                                                })
                                            })
                                        </script>
                                    <?php $no++; } ?>
                                    <?php if (!$assoc['sub'] == ""): ?>
                                        <tr>
                                            <td colspan="4">Total Harga</td>
                                            <td><?php echo $assoc['sub'] ?></td>
                                        </tr>
                                    <?php endif ?>
                                    <?php }else{ ?>
                                        <td colspan="5" class="text-center">Tidak ada antrian</td>
                                    <?php } ?>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="fajarmodal" tabindex="-1" role="dialog"aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
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
                                margin-bottom: 12px;"
                        type="text" id="trxKasir" onkeyup="myFunction()" placeholder="Cari Produk ...">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <td>Kode Produk</td>
                            <td>Nama Produk</td>
                            <td>Harga</td>
                            <td>Stok</td>
                        </tr>
                    </thead>
                    <tbody id="ketKasir">
                        <?php foreach($barangs as $brs){ ?>
                        <tr>
                            <td><a href="pageKasir.php?page=kasirTransaksi&getItem&id=<?php echo $brs['kd_barang'] ?>"><?php echo $brs['kd_barang'] ?></a></td>
                            <td><?php echo $brs['nama_barang'] ?></td>
                            <td><?php echo $brs['harga_barang'] ?></td>
                            <td><?php echo $brs['stok_barang'] ?></td>
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
    $(document).ready(function(){


        $('#barang_nama').change(function(){
            var barang = $(this).val();
            $.ajax({
                type:"POST",
                url :'ajaxTransaksi.php',
                data:{'selectData' : barang},
                success: function(data){
                    $("#harba").val(data);
                    $("#harmo").val(datamo);
                    $("#jumjum").val();
                    var jum   = $("#jumjum").val();
                    var kali  = data * jum;
                    var kalimo  = datamo * jum;
                    $("#totals").val(kali);
                    $("#totalsmodal").val(kalimo);
                }
            })
        });


        $('#jumjum').keyup(function(){
            var jumlah  = $(this).val();
            var harba   = $('#harba').val();
            var harmo   = $('#harmo').val();
            var kali    = harba * jumlah;
            var kalimo    = harmo * jumlah;
            $("#totals").val(kali);
            $("#totalsmodal").val(kalimo);
        });

        $('#bayar').keyup(function(){
            var bayar = $(this).val();
            var total = $('#tot').val();
            var kembalian = bayar - total;
            $('#kem').val(kembalian);
        })
    })

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