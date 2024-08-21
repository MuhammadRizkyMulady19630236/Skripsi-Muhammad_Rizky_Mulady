<?php
$br = new lsp();
if ($_SESSION['level'] != "Admin") {
	header("location:../index.php");
}
$table = "table_barang";
$data = $br->selectWhere($table, "kd_barang", $_GET['id']);
$getMerek = $br->select("table_merek");
$getDistr = $br->select("table_distributor");
$waktu = date("Y-m-d");
if (isset($_POST['getSimpan'])) {
	$kode_barang = $br->validateHtml($_POST['kode_barang']);
	$nama_barang = $br->validateHtml($_POST['nama_barang']);
	$merek_barang = $br->validateHtml($_POST['merek_barang']);
	$distributor = $br->validateHtml($_POST['distributor']);
	$harga_modal = $br->validateHtml($_POST['harga_modal']);
	$harga_jual = $br->validateHtml($_POST['harga_jual']);
	$tautan = $br->validateHtml($_POST['tautan']);
	$stok = $br->validateHtml($_POST['stok']);
	$ket = $_POST['ket'];

	if ($kode_barang == " " || $nama_barang == " " || $merek_barang == " " || $distributor == " " || $harga_modal == " " || $harga_jual == " " || $stok == " " || $ket == " ") {
		$response = ['response' => 'negative', 'alert' => 'lengkapi field'];
	} else {
			if ($_FILES['foto']['name'] == "") {
				$value = "kd_barang='$kode_barang',nama_barang='$nama_barang',kd_merek='$merek_barang',kd_distributor='$distributor',harga_modal='$harga_modal',harga_barang='$harga_jual',stok_barang='$stok',keterangan='$ket'";
				$response = $br->update($table, $value, "kd_barang", $_GET['id'], "?page=viewBarang");
			} else {
				$response = $br->validateImage();
				if ($response['types'] == "true") {
					$value = "kd_barang='$kode_barang',nama_barang='$nama_barang',tautan='$tautan',kd_merek='$merek_barang',kd_distributor='$distributor',harga_modal='$harga_modal',harga_barang='$harga_jual',stok_barang='$stok',keterangan='$ket',gambar='$response[image]'";
					$response = $br->update($table, $value, "kd_barang", $_GET['id'], "?page=viewBarang");
				} else {
					$response = ['response' => 'negative', 'alert' => 'gambar error'];
				}
			}
	}
}
?>
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
                                <li class="list-inline-item">Edit Data Produk</li>
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
				<div class="col-md-12">
					<form method="post" enctype="multipart/form-data">
						<div class="card">
							<div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
								<div class="bg-overlay bg-overlay--blue"></div>
								<h3>
									<i class="zmdi zmdi-account-calendar"></i>Data Produk
								</h3>
							</div>
							<div class="card-body">
								<div class="col-12">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="">Kode Produk</label>
												<input type="text" class="form-control" name="kode_barang"
													value="<?php echo $data['kd_barang']; ?>" readonly>
											</div>
											<div class="form-group">
												<label for="">Nama Produk</label>
												<input type="text" class="form-control" name="nama_barang"
													value="<?php echo @$data['nama_barang'] ?>">
											</div>
											<div class="form-group">
												<label for="">Merek</label>
												<select name="merek_barang" class="form-control">
													<option value=" " disabled selected>Pilih merek</option>
													<?php foreach ($getMerek as $mr) { ?>
														<?php if ($mr['kd_merek'] == $data['kd_merek']) { ?>
															<option value="<?= $mr['kd_merek'] ?>" selected><?= $mr['merek'] ?>
															</option>
														<?php } else { ?>
															<option value="<?= $mr['kd_merek'] ?>"><?= $mr['merek'] ?></option>
														<?php } ?>
													<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<label for="">Distributor</label>
												<select name="distributor" class="form-control">
													<option value=" " disabled selected>Pilih distributor</option>
													<?php foreach ($getDistr as $dr) { ?>
														<?php if ($dr['kd_distributor'] == $data['kd_distributor']) { ?>
															<option value="<?= $dr['kd_distributor'] ?>" selected><?= $dr['nama_distributor'] ?></option>
														<?php } else { ?>
															<option value="<?= $dr['kd_distributor'] ?>"><?= $dr['nama_distributor'] ?></option>
														<?php } ?>
													<?php } ?>
												</select>
											</div>	
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="">Harga Modal</label>
												<input type="number" class="form-control" name="harga_modal"
													value="<?php echo $data['harga_modal'] ?>">
											</div>
											<div class="form-group">
												<label for="">Harga Jual</label>
												<input type="number" class="form-control" name="harga_jual"
													value="<?php echo $data['harga_barang'] ?>">
											</div>
											<div class="form-group">
												<label for="">Stok Produk</label>
												<input readonly type="number" class="form-control" name="stok"
													value="<?php echo $data['stok_barang'] ?>">
											</div>
											<div class="form-group">
												<label for="">Keterangan</label>
												<textarea name="ket" rows="2"
													class="form-control"><?php echo $data['keterangan'] ?></textarea>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group" id="fotoF">
												<label for="">Foto</label>
												<div class="row">
													<div class="col-6">
														<input type="file" name="foto" id="gambar"
															class="form-control-file">
													</div>
													<div class="col-6">
														<div>
															<img style="margin-top: -20px;" alt=""
																src="img/<?= $data['gambar'] ?>" width="120"
																class="img-responsive" id="pict">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<a href="?page=viewBarang" class="btn btn-danger"><i class="fa fa-arrow-left"></i>
									Kembali</a>
								<button name="getSimpan" class="btn btn-primary"><i class="fa fa-download"></i>
									Update</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>