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
        $keterangan     = $_POST['keterangan'];


        if ($kd_transaksi == "" || $kd_pretransaksi == "" || $barang == "" || $jumlah == "" || $total == "" || $keterangan == "") {
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
                        $response = $trans->update("table_pretransaksi",$value,"kd_transaksi = '$kd_transaksi' AND kd_barang",$barang,"?page=kasirPembayaran");
                    }else{
                        $value = "'$kd_pretransaksi','$kd_transaksi','$barang','$nama_barang','$jumlah','$total','$total_modal','0','$keterangan'";
                        $response = $trans->insert("table_pretransaksi",$value,"?page=kasirPembayaran");
                    }
                }
            }
        }
    }

 ?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
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
                                    <div class="form-group">
                                        <label for="">Kode Produk</label>
                                        <input type="text" class="form-control" name="kd_barang" readonly placeholder="Kode barang" value="<?php echo @$dataR['kd_barang'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Produk</label>
                                        <input type="text" class="form-control" name="nama_barang" value="<?php echo @$dataR['nama_barang']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Stok Tersedia</label>
                                        <input type="text" class="form-control" name="stok" value="<?php echo @$dataR['stok_barang']; ?>" readonly>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="">Harga Modal</label>
                                        <input type="text" class="form-control" max="100" name="harmo" value="<?php echo @$dataR['harga_modal']; ?>" id="harmo">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Harga Produk</label>
                                        <input type="text" class="form-control" max="100" name="harba" value="<?php echo @$dataR['harga_barang']; ?>" id="harba" readonly>
                                    </div>
                                    <div class="form-group">
                                            <label for="">Keterangan</label>
                                            <textarea name="keterangan" rows="2" class="form-control"></textarea>
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
                                    <button class="btn btn-primary btn-block" name="btnAdd"><i class="fa fa-cart-plus"></i> KIRIM</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
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