<?php

$rg = new lsp();
$table = "table_user";
$autokode = $rg->autokode($table, "kd_user", "US");
$data = $rg->querySelect("SELECT * FROM table_user WHERE level != 'Pelanggan'");

if (isset($_POST['btnInput'])) {
    $kd_user = $_POST['kd_user'];
    $nama_user = $_POST['nama_user'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $level = "Pelanggan";
    $alamat = $_POST['alamat'];
    $foto = $_FILES['foto'];
    $no_handphone = $_POST['no_handphone'];
    $redirect = "login.php";


    if ($nama_user == "" || $username == "" || $password == "" || $confirm == "" || $level == "") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi Field !!!'];
    } else {
        $response = $rg->register($kd_user, $nama_user, $username, $password, $confirm, $foto, $level, $alamat, $no_handphone, $email, $redirect);
    }
}


?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Formulir Pendaftaran</strong>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Kode User</label>
                                    <input style="color: red; font-weight: bold;" class="au-input au-input--full"
                                        type="text" name="kd_user" value="<?= $autokode; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="au-input au-input--full" required type="text" name="nama_user"
                                        placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" required type="text" name="username"
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input class="au-input au-input--full" required type="text" name="alamat" placeholder="Alamat">
                                </div>
                                <div class="form-group">
                                    <label>No Handphone</label>
                                    <input class="au-input au-input--full" required type="text" name="no_handphone" placeholder="Nomor Handphone">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="au-input au-input--full" required type="text" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" required type="password" name="password"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="au-input au-input--full" required type="password" name="confirm"
                                        placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <label for="foto_karyawan" class="control-label mb-1">Foto</label>
                                    <div style="padding-bottom: 15px;">
                                        <img alt="" width="120" class="img-responsive" id="pict">
                                    </div>
                                    <input required type="file" name="foto" id="gambar" class="form-control-file">
                                </div>
                                <button name="btnInput" class="au-btn au-btn--green m-b-20 btn-block" type="submit">DAFTAR</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>