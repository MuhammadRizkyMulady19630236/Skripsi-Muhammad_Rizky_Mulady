<?php

$rg = new lsp();
$table = "table_user";
$autokode = $rg->autokode($table, "kd_user", "US");
$data = $rg->querySelect("SELECT * FROM table_user WHERE level != 'Pelanggan' AND level != 'Manager'");

if (isset($_POST['btnInput'])) {
    $kd_user = $_POST['kd_user'];
    $nama_user = $_POST['nama_user'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $foto = $_FILES['foto'];
    $level = $_POST['level'];
    $alamat = $_POST['alamat'];
    $no_handphone = $_POST['no_handphone'];
    $redirect = "?page=kelPegawai";


    if ($nama_user == "" || $username == "" || $password == "" || $confirm == "" || $level == "") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi Field !!!'];
    } else {
        $response = $rg->register($kd_user, $nama_user, $username, $password, $confirm, $foto, $level, $alamat, $no_handphone,$email, $redirect);
    }
}

if (isset($_GET['delete'])) {
    $response = $rg->delete($table, "kd_user", $_GET['id'], "?page=kelPegawai");
}

?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Input Pegawai</strong>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Kode User</label>
                                    <input style="color: red; font-weight: bold;" class="au-input au-input--full"
                                        type="text" name="kd_user" readonly value="<?= $autokode; ?>">
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
                                <div class="form-group">
                                    <label for="level" class="control-label mb-1">Level</label>
                                    <select name="level" class="form-control mb-1">
                                        <option value="">Level</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Kasir">Kasir</option>
                                    </select>
                                </div>
                                <button name="btnInput" class="au-btn au-btn--green m-b-20" type="submit">Input
                                    Pegawai</button>
                                <button name="btnRegister" class="au-btn btn-danger m-b-20" type="reset">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Pegawai</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pegawai</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Level</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data as $dataB) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $no; ?>
                                                </td>
                                                <td>
                                                    <?= $dataB['kd_user']; ?>
                                                </td>
                                                <td>
                                                    <?= $dataB['nama_user'] ?>
                                                </td>
                                                <td>
                                                    <?= $dataB['username'] ?>
                                                </td>
                                                <td>
                                                    <?= $dataB['level'] ?>
                                                </td>
                                                <td><img width="60" src="img/<?= $dataB['foto_user'] ?>" alt=""></td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button id="btnDelete<?php echo $no; ?>" class="item"
                                                            data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <script src="vendor/jquery-3.2.1.min.js"></script>
                                            <script>
                                                $('#btnDelete<?php echo $no; ?>').click(function (e) {
                                                    e.preventDefault();
                                                    swal({
                                                        title: "Hapus",
                                                        text: "Yakin Ingin menghapus?",
                                                        type: "error",
                                                        showCancelButton: true,
                                                        confirmButtonText: "Yes",
                                                        cancelButtonText: "Cancel",
                                                        closeOnConfirm: false,
                                                        closeOnCancel: true
                                                    }, function (isConfirm) {
                                                        if (isConfirm) {
                                                            window.location.href = "?page=kelPegawai&delete&id=<?php echo $dataB['kd_user'] ?>";
                                                        }
                                                    });
                                                });
                                            </script>
                                            <?php $no++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>