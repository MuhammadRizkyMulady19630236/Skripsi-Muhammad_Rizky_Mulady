<?php
$trsP = new lsp();

if (isset($_POST['btnSearch'])) {
	$whereparam = "tanggal";
	$param = $_POST['dateAwal'];
	$param1 = $_POST['dateAkhir'];
	$grand = $trsP->selectSumWhereBetween("tb_service", "jumlah", "$whereparam", $param, $param1);
	$dataB = $trsP->selectBetween("tb_service", $whereparam, $param, $param1);
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
								<h3>Transaksi Service</h3>
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
								<?php if (isset($_POST['dateAwal'])): ?>
									<a target="_blank"
										href="manager/servicePrint.php?dateAwal=<?php echo $param ?>&dateAkhir=<?php echo $param1 ?>"
										class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
									<br><br>
								<?php endif ?>
								<table class="table table-striped table-hover table-bordered">
									<thead>
										<tr>
											<td>Kode Transaksi</td>
											<td>Tanggal</td>
											<td>Nama Lengkap</td>
											<td>No Handphone</td>
											<td>Device</td>
											<td>Keterangan</td>
											<td>Biaya</td>
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
															<?=
																$ds['kd_service'] ?>
														</td>
														<td>
															<?= $ds['tanggal'] ?>
														</td>
														<td>
															<?= $ds['nama_lengkap'] ?>
														</td>
														<td>
															<?= $ds['no_handphone'] ?>
														</td>
														<td>
															<?= $ds['device'] ?>
														</td>
														<td>
															<?= $ds['keterangan'] ?>
														</td>
														<td>
															<?= "Rp." . number_format($ds['jumlah']) . ",-" ?>
														</td>
													</tr>
													<?php $no++;
												} ?>
												<tr>
													<td colspan="6" style="text-align: center;">Total</td>
													<td>
														<?php echo "Rp." . number_format($grand['sum']) . ",-" ?>
													</td>
												</tr>
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