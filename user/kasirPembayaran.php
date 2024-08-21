<?php
date_default_timezone_set('Asia/Jakarta');
$pem = new lsp();
$transkode = $pem->autokode("table_transaksi", "kd_transaksi", "TR");
$sql = "SELECT SUM(sub_total) as sub FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
$exec = mysqli_query($con, $sql);
$assoc = mysqli_fetch_assoc($exec);
$sql1 = "SELECT SUM(jumlah) as jum FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
$exec1 = mysqli_query($con, $sql1);
$assoc1 = mysqli_fetch_assoc($exec1);
$auth = $pem->selectWhere("table_user", "username", $_SESSION['username']);
$sql2 = "SELECT COUNT(kd_pretransaksi) as count FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
$exec2 = mysqli_query($con, $sql2);
$assoc2 = mysqli_fetch_assoc($exec2);
$sql3 = "SELECT SUM(sub_totalmodal) as sub3 FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
$exec3 = mysqli_query($con, $sql3);
$assoc3 = mysqli_fetch_assoc($exec3);
if ($assoc2['count'] <= 0) {
	header("location:index.php?page=kasirTransaksi");
}

if (isset($_POST['selesaiGet'])) {
	$total = $_POST['tot'];
	$total_modal = $_POST['totmodal'];
	$date = date("Y-m-d");
	$time = date("H:i:s");
	$value = "'$transkode','$auth[kd_user]','$assoc1[jum]','$assoc[sub]','$assoc3[sub3]','$date','$time'";
	$response = $pem->insert("table_transaksi", $value, "?page=struk&id=$transkode");
	if ($response['response'] == "positive") {
		unset($_SESSION['transaksi']);
	}
}
?>
<div class="main-content">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="card">
						<div class="card-header">
							<h3>Pembayaran</h3>
						</div>
						<div class="card-body">
							<form method="post">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="">Kode Transaksi</label>
										<input type="text" class="form-control" name="autokode" id="autokode"
											value="<?php echo $transkode ?>" readonly>
									</div>
									<div class="form-group" hidden>
										<label for="">Total Modal</label>
										<input type="text" class="form-control" name="totmodal" id="totmodal"
											value="<?php echo $assoc3['sub3'] ?>" readonly>
									</div>
									<div class="form-group">
										<label for="">Total harga</label>
										<input type="text" class="form-control" name="tot" id="tot"
											value="<?php echo $assoc['sub'] ?>" readonly>
										<label><b>*Total harga belum termasuk ongkir, silahkan untuk mengecek ongkir terlebih dahulu sebelum melakukan pembayaran melalui <a style="color:red;" href="?page=ongkir">link berikut</a></b></label>
									</div>										
									<button class="btn btn-primary" name="selesaiGet"><i class="fa fa-cart-plus"></i>
										Selesaikan Pembayaran </button>
									<a href="?page=kasirTransaksi" class="btn btn-danger"><i class="fa fa-repeat"></i>
										Kembali</a>
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
	$(document).ready(function () {
		$('#jumjum').keyup(function () {
			var jumlah = $(this).val();
			var harba = $('#harba').val();
			var kali = harba * jumlah;
			$("#totals").val(kali);
		});

		$('#bayar').keyup(function () {
			var bayar = $(this).val();
			var total = $('#tot').val();
			var kembalian = bayar - total;
			$('#kem').val(kembalian);
		});
	})
</script>