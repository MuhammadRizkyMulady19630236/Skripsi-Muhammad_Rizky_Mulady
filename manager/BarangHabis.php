<?php
$qb = new lsp();
$dataB = $qb->edit("detailbarang", "stok_barang", 0);
if (isset($_GET['export'])) {
	$dateNow = date("Y-m-d");
	header("Content-type:application/vnd-ms-excel");
	header("Content-Disposition:attachment;filename='$dateNow'-DataBarangHabis.xls");
}
?>
<style>
	@media print {
		.btn {
			display: none;
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
				<div class="col-sm-12" style="background: white; padding: 50px;">
					<img src="./images/logo.jpg" align="left" width="100x">
					<p align="center"><b>
							<center>
								<font size="4">Murakata Sport</font><br>
								<font size="4"><b>Jalan IR. Pangeran Haji Muhammad Nur, Barabai, Kalimantan Selatan</b>
								</font><br>
								<font size="2"><i>Email : murakatasport@gmail.com, Telp/WA 081240002600</i></font><br>
								<hr size="2px" color="black">
							</center>
						</b></p>
					<div class="row">
						<div class="col-sm-12" style="padding: 50px;">
							<p align="center"><b>
									<center>
										<font size="5">Data Barang Habis Murakata Sport</font><br>
									</center>
								</b></p><br>
							<div class="row">
								<div class="col-6">
									<button class="btn btn-info" onclick="window.print()">Print</button>
								</div>
							</div><br>
							<table class="table" border="1" cellspacing="0" width="100%;">
								<thead>
									<tr>
										<th>Kode barang</th>
										<th>Nama barang</th>
										<th>Merek</th>
										<th>Distributor</th>
										<th>Harga Modal</th>
										<th>Harga Jual</th>
										<th>Stok</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($dataB as $ds) { ?>
										<tr>
											<td>
												<?= $ds['kd_barang'] ?>
											</td>
											<td>
												<?= $ds['nama_barang'] ?>
											</td>
											<td>
												<?= $ds['merek'] ?>
											</td>
											<td>
												<?= $ds['nama_distributor'] ?>
											</td>
											<td>
												<?= number_format($ds['harga_modal']) ?>
											</td>
											<td>
												<?= number_format($ds['harga_barang']) ?>
											</td>
											<td>
												<?= $ds['stok_barang'] ?>
											</td>
											<?php $no++;
									} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>