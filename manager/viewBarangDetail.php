<?php
$dt = new lsp();
$detail = $dt->selectWhere("detailBarang", "kd_barang", $_GET['id']);
if ($_SESSION['level'] != "Manager") {
	header("location:../index.php");
}
?>
<div class="main-content">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<a href="?page=kelBarang" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
						<div class="card-body">
							<img style="min-height: 200px; width: 100%; display: block;"
								src="img/<?php echo $detail['gambar'] ?>">
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<h3>Detail Barang</h3>
						</div>
						<div class="card-body">
							<table class="table" cellpadding="10">
								<tr>
									<td>Kode Barang</td>
									<td>:</td>
									<td style="font-weight: bold; color: red;">
										<?php echo $detail['kd_barang']; ?>
									</td>
								</tr>
								<tr>
									<td>Nama Barang</td>
									<td>:</td>
									<td>
										<?php echo $detail['nama_barang']; ?>
									</td>
								</tr>
								<tr>
									<td>Merek</td>
									<td>:</td>
									<td>
										<?php echo $detail['merek']; ?>
									</td>
								</tr>
								<tr>
									<td>Distributor</td>
									<td>:</td>
									<td>
										<?php echo $detail['nama_distributor']; ?>
									</td>
								</tr>
								<tr>
									<td>Harga Modal</td>
									<td>:</td>
									<td>
										<?php echo "Rp." . number_format($detail['harga_modal']) . "-,"; ?>
									</td>
								</tr>
								<tr>
									<td>Harga Jual</td>
									<td>:</td>
									<td>
										<?php echo "Rp." . number_format($detail['harga_barang']) . "-,"; ?>
									</td>
								</tr>
								<tr>
									<td>Stok</td>
									<td>:</td>
									<td>
										<?php echo $detail['stok_barang'] ?>
									</td>
								</tr>
								<tr>
									<td>Keterangan</td>
									<td>:</td>
									<td>
										<?php echo $detail['keterangan'] ?>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>