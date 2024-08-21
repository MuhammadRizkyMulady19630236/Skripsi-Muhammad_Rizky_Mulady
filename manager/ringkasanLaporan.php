<?php
$trsP = new lsp();

if (isset($_POST['btnSearch'])) {
	$whereparam = "tanggal_beli";
	$param = $_POST['dateAwal'];
	$param1 = $_POST['dateAkhir'];
	$grand = $trsP->selectSumWhereBetween("detailtransaksi", "sub_total", "$whereparam", $param, $param1);
	$grandM = $trsP->selectSumWhereBetween("detailtransaksi", "sub_totalmodal", "$whereparam", $param, $param1);
	$dataB = $trsP->selectBetween("detailtransaksi", $whereparam, $param, $param1);
	$grandBy = $trsP->selectSumWhereBetween("table_biayaoperasional", "jumlah", "tanggal", $param, $param1);
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
								<h3>Ringkasan Laporan Pendapatan</h3>
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
								<a href="?page=ringkasanLaporan" class="btn btn-danger">Reload</a>
								<br><br>
								<?php if (isset($_POST['dateAwal'])): ?>
									<a target="_blank"
										href="manager/ringkasanLaporanPrint.php?dateAwal=<?php echo $param ?>&dateAkhir=<?php echo $param1 ?>"
										class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
								<?php endif ?>
								<br><br>
								<table class="table table-striped table-hover table-bordered">
									<tbody>
										<?php
										if (isset($_POST['btnSearch'])) { ?>
											<?php
											if (count(@$dataB['data']) > 0) { ?>
												<tr>
													<td colspan="2"><b>Pendapatan</b></td>
												</tr>
												<tr>
													<td>Penjualan Bersih</td>
													<td>
														<?php echo "Rp." . number_format($grand['sum']) . ",-" ?>
													</td>
												</tr>
												<tr>
													<td>Harga Pokok Penjualan</td>
													<td class="text-danger">
														-
														<?php echo "Rp." . number_format($grandM['sum']) . ",-" ?>
													</td>
												</tr>
												<tr>
													<td>Laba Kotor</td>
													<td>
														<?php echo "Rp." . number_format($grand['sum'] - $grandM['sum']) . ",-" ?>
													</td>
												</tr>
												<tr>
													<td colspan="2"><b>Beban Usaha</b></td>
												</tr>
												<tr>
													<td>Biaya Operasional</td>
													<td class="text-danger">
														-
														<?php echo "Rp." . number_format($grandBy['sum']) . ",-" ?>
													</td>
												</tr>
												<tr>
													<td><b>Laba Bersih</b></td>
													<td>
														<b>
															<?php echo "Rp." . number_format($grand['sum'] - $grandM['sum']  - $grandBy['sum']) . ",-" ?>
														</b>
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