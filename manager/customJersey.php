<?php
$qb = new lsp();

if (isset($_POST['btnSearch'])) {
	$whereparam = "tanggal";
	$param = $_POST['dateAwal'];
	$param1 = $_POST['dateAkhir'];
	$dataB = $qb->selectBetween("detailjersey", $whereparam, $param, $param1);
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
								<h3>Laporan Custom Jersey</h3>
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
								<a href="?page=periode" class="btn btn-danger">Reload</a>
								<br><br>
								<?php if (isset($_POST['dateAwal'])): ?>
									<a target="_blank"
										href="manager/jerseyPrint.php?dateAwal=<?php echo $param ?>&dateAkhir=<?php echo $param1 ?>"
										class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
								<?php endif ?>
								<br><br>
								<table class="table table-striped table-hover table-bordered">
									<thead>
										<tr>
											<th>Kode Pemesanan</th>
											<th>Tanggal</th>
											<th>Nama Tim</th>
											<th>Keterangan</th>
											<th>Desain Jersey</th>
											<th>Status</th>
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
															<?= $ds['kd_pesanan'] ?>
														</td>
														<td>
															<?= $ds['tanggal'] ?>
														</td>
														<td>
															<?= $ds['nama_tim'] ?>
														</td>
														<td>
															<?= $ds['keterangan'] ?>
														</td>
														<td>
															<a href="img/<?= $ds['foto_referensi'] ?>" target="_blank">Lihat
																Foto</a>
														</td>
														<td class="text-center">
															<?php if ($ds['status'] == '1') { ?>
																Sudah Selesai
															<?php } else if ($ds['status'] == '3') {
																echo "Dibatalkan";
															} else if ($ds['status'] == '0') {
																echo "Menunggu Dikonfirmasi";
															} else if ($ds['status'] == '2') {
																echo "Sedang Dikerjakan";
															} ?>
														</td>
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