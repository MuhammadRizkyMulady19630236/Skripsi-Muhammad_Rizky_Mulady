<?php
$trsP = new lsp();

if (isset($_POST['btnSearch'])) {
	$whereparam = "tanggal_beli";
	$param = $_POST['dateAwal'];
	$param1 = $_POST['dateAkhir'];
	$grand = $trsP->selectSumWhereBetween("detailtransaksi", "sub_total", "$whereparam", $param, $param1);
	$grandM = $trsP->selectSumWhereBetween("detailtransaksi", "sub_totalmodal", "$whereparam", $param, $param1);
	$dataB = $trsP->selectBetween("detailtransaksi", $whereparam, $param, $param1);
}
?>
<div class="main-content">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<form method="post">
							<div class="card-header">
								<h3>Transaksi Per Periode</h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-4">
										<label for="#">Dari Tanggal</label>
										<input value="<?= $_POST['dateAwal'] ?>" class="form-control" type="date"
											placeholder="Select Date" name="dateAwal" required>
									</div>
									<div class="col-sm-4">
										<label for="#">Ke Tanggal</label>
										<input value="<?= $_POST['dateAkhir'] ?>" class="form-control" type="date"
											placeholder="Select Date" name="dateAkhir" required>
									</div>
								</div>
								<br>
								<button class="btn btn-primary" name="btnSearch"><i class="fa fa-search"></i>
									Search</button>
								<a href="?page=transaksiPeriode" class="btn btn-danger">Reload</a>
								<br><br>
								<table class="table table-striped table-hover table-bordered">
									<thead>
										<tr>
											<td>Kode Transaksi</td>
											<td>Tanggal</td>
											<td>Nama Penjual</td>
											<td>Nama Barang</td>
											<td>Jumlah</td>
											<td>Penjualan (Harga Jual)</td>
										</tr>
									</thead>
									<tbody>
										<?php
										if (isset($_POST['btnSearch'])) { ?>
											<?php
											if (count(@$dataB['data']) > 0) {
												$no = 1;
												foreach (@$dataB['data'] as $ds) { ?>
													<tr>
														<td>
															<a href="?page=struk&id=<?= $ds['kd_transaksi']; ?>"><?=
															  	$ds['kd_transaksi'] ?></a>
														</td>
														<td>
														<?= $ds['tanggal_beli'] ?>
														</td>
														<td>
															<?= $ds['nama_user'] ?>
														</td>
														<td>
															<?= $ds['nama_barang'] ?>
														</td>
														<td>
															<?= $ds['jumlah'] ?>
														</td>
														<td>
															<?= "Rp." . number_format($ds['sub_total']) . ",-" ?>
														</td>
													</tr>
													<?php $no++;
												} ?>
											<?php } else { ?>
												<tr>
													<td colspan="7" class="text-center">Tidak ada data</td>
												</tr>
											<?php } ?>
											<?php ?>
										<?php } else { ?>
											<tr>
												<td colspan="7" class="text-center">Pilih Periode Terlebih Dahulu</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>