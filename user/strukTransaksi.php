<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

require_once dirname(__FILE__) . './Payment/Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-wVEk8DHo7jL1CzXm_bJ1W73s';
Config::$clientKey = 'SB-Mid-client-RBc2mhuUlw0KzW-L';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

// Required

$order_id = $_GET['id'];

// Query untuk menampilkan data siswa berdasarkan NIS yang dikirim
$query = "SELECT * FROM detailtransaksi WHERE kd_transaksi ='" . $order_id . "'";
$sql = mysqli_query($con, $query); // Eksekusi/Jalankan query dari variabel $query
$data = mysqli_fetch_array($sql);

$nama = $data['kd_user'];
$email = $data['email'];

$biaya = $data['total_harga'];

$transaction_details = array(
	'order_id' => $order_id,
	'gross_amount' => $biaya, // no decimal allowed for creditcard
);
// Optional
$item_details = array(
	array(
		'id' => 'a1',
		'price' => $biaya,
		'quantity' => 1,
		'name' => "$order_id"
	),
);
// Optional
$customer_details = array(
	'first_name' => "$nama",
	'last_name' => "",
	'email' => "$email",
	'phone' => ""
);
// Fill transaction details
$transaction = array(
	'transaction_details' => $transaction_details,
	'customer_details' => $customer_details,
	'item_details' => $item_details,
);

$snap_token = '';
try {
	$snap_token = Snap::getSnapToken($transaction);
} catch (\Exception $e) {
	echo $e->getMessage();
}


function printExampleWarningMessage()
{
	if (strpos(Config::$serverKey, 'your ') != false) {
		echo "<code>";
		echo "<h4>Please set your server key from sandbox</h4>";
		echo "In file: " . __FILE__;
		echo "<br>";
		echo "<br>";
		echo htmlspecialchars('Config::$serverKey = \'SB-Mid-server-wVEk8DHo7jL1CzXm_bJ1W73s\';');
		die();
	}
}
?>


<style>
	.col-sm-8 {
		background: white;
		padding: 20px;
	}

	@media print {
		table {
			align-content: center;
		}

		.ds {
			display: none;
		}

		.card {
			box-shadow: none;
			border: none;
		}

		.hd {
			display: none;
		}
	}
</style>

<div class="main-content">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<h4>Virtual Pembayaran</h4>
							<p>Murakata Sport</p>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-6">Kode Transaksi :
									<?php echo $order_id ?>
								</div>
								<div class="col-sm-6">
									<p class="text-right"><span>
											<?php echo "Tanggal : " . date("Y-m-d"); ?>
									</p>
								</div>
							</div> <br>
							<a href="?" class="btn btn-danger ds"><i class="fa fa-arrow_left"></i> Kembali</a>
							<button id="pay-button" class="btn btn-info ds">Selesaikan Pembayaran</button>

							<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
							<script src="https://app.sandbox.midtrans.com/snap/snap.js"
								data-client-key="<?php echo Config::$clientKey; ?>"></script>
							<script type="text/javascript">
								document.getElementById('pay-button').onclick = function () {
									// SnapToken acquired from previous step
									snap.pay('<?php echo $snap_token ?>');
								};
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>