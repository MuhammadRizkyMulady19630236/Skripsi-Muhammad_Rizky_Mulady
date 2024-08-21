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

<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="#">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Data Barang Habis</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main-content" style="margin-top: -30px;">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12" style="background: white; padding: 50px;">
					<h3>Laporan barang habis</h3>
					<p>Murakata Sport</p>
					<hr>
					<div class="row">
						<div class="col-6">
							<button class="btn btn-info" onclick="window.print()">Print</button>
						</div>
						<div class="col-6">
							<p class="text-right">Tanggal Cetak :
								<?= date("Y-m-d"); ?>
							</p>
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