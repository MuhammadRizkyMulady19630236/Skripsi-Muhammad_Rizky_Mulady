<?php

include "config/controller.php";
$function = new lsp();
session_start();

$response = $function->sessionCheck();

if (isset($_SESSION['level'])) {
    $auth = $function->AuthUser($_SESSION['username']);
}

if (isset($_GET['logout'])) {
    $function->logout();
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Murakata Sport</title>
    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="css/sweet-alert.css">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <script src="user/asset/jquery/jquery-3.3.1.min.js"></script>
    <script src="user/asset/bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
    <script src="user/asset/select2-4.0.6-rc.1/dist/js/select2.min.js"></script>   
    <script src="user/asset/select2-4.0.6-rc.1/dist/js/i18n/id.js"></script>   
    <script src="user/asset/js/app.js"></script>
</head>

<body>

    <div class="page-wrapper">
        <aside class="menu-sidebar2">
            <div class="logo">
                <div class="logo">
                    <h4 style="color: white;"> Murakata Sport</h4>
                </div>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                    <div class="image img-cir img-120">
                        <img src="images/logo.jpg" />
                    </div>
                    <h4 class="name">
                        Murakata Sport
                    </h4>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="?page">
                                <i class="fas fa-home"></i>Beranda</a>
                        </li>
                        <li>
                            <a href="?page=viewJersey">
                                <i class="fas fa-soccer-ball-o"></i>Custom Jersey</a>
                        </li>
                        <li>
                            <a href="?page=ongkir">
                                <i class="fas fa-truck"></i>Cek Ongkir</a>
                        </li>
                        <?php
                        if ($response != "false") { ?>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-archive"></i>Pesanan Saya</a>
                                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                    <li>
                                        <a href="?page=viewBelumbayar">Belum Bayar</a>
                                    </li>
                                    <li>
                                        <a href="?page=viewSudahbayar">Sudah Bayar</a>
                                    </li>
                                </ul>
                            </li>
                        <?php }
                        ?>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="page-container2">
            <header class="header-desktop2 hd">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <div class="logo">
                                    <h4 style="color: white;"> Murakata Sport</h4>
                                </div>
                            </div>
                            <div class="header-button2">
                                <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                    <div class="account-dropdown__body">
                                        <?php
                                        if ($response == "false") { ?>
                                            <div class="account-dropdown__item">
                                                <a href="login.php">
                                                    <i class="zmdi zmdi-account"></i>Login</a>
                                            </div>
                                        <?php } ?>
                                        <?php
                                        if ($response != "false") { ?>
                                            <div class="account-dropdown__item">
                                                <a href="?page=profile">
                                                    <i class="zmdi zmdi-account"></i>Akun</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="homepage.php?logout" id="forLogout">
                                                    <i class="zmdi zmdi-power"></i>Keluar</a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="logo">
                    <div class="logo">
                        <h4 style="color: white;"> Murakata Sport</h4>
                    </div>
                </div>
                <div class="menu-sidebar2__content js-scrollbar1">
                    <div class="account2">
                        <div class="image img-cir img-120">
                            <img src="images/logo.jpg" />
                        </div>
                        <h4 class="name">
                            Murakata Sport
                        </h4>
                    </div>
                    <?php
                    if ($response == "false") { ?>
                        <nav class="navbar-sidebar2">
                            <ul class="list-unstyled navbar__list">
                                <li>
                                    <a href="?page">
                                        <i class="fas fa-home"></i>Beranda</a>
                                </li>
                                <li>
                                    <a href="?page=viewJersey">
                                        <i class="fas fa-home"></i>Custom Jersey</a>
                                </li>
                                <?php
                                if ($response != "false") { ?>
                                    <li class="has-sub">
                                        <a class="js-arrow" href="#">
                                            <i class="fas fa-archive"></i>Pesanan Saya</a>
                                        <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                            <li>
                                                <a href="?page=viewBelumbayar">Belum Bayar</a>
                                            </li>
                                            <li>
                                                <a href="?page=viewSudahbayar">Sudah Bayar</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </nav>
                    <?php }
                    ?>
                </div>
            </aside>

            <?php

            @$page = $_GET['page'];
            switch ($page) {
                case 'detail':
                    include "user/detail.php";
                    break;
                case 'viewService':
                    include "user/viewService.php";
                    break;
                case 'invoice':
                    include "user/invoice.php";
                    break;
                case 'profile':
                    include "profile.php";
                    break;
                case 'ongkir':
                    include "user/ongkir.php";
                    break;
                case 'orderBarang':
                    include "user/orderBarang.php";
                    break;
                case 'register':
                    include "register.php";
                    break;
                case 'viewJersey':
                    include "user/viewJersey.php";
                    break;
                case 'dashboard':
                    include "user/dashboard.php";
                    break;
                case 'kasirTransaksi':
                    include "user/kasirTransaksi.php";
                    break;
                case 'kasirPembayaran':
                    include "user/kasirPembayaran.php";
                    break;
                case 'viewBelumbayar':
                    include "user/viewBelumbayar.php";
                    break;
                case 'viewSudahbayar':
                    include "user/viewSudahbayar.php";
                    break;
                case 'struk':
                    include "user/strukTransaksi.php";
                    break;
                case 'payment':
                    include "user/Payment/examples/snap/checkout-process-simple-version.php";
                    break;
                default:
                    $page = "dashboard";
                    include "user/dashboard.php";
                    break;
            }

            ?>

        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="vendor/vector-map/jquery.vmap.js"></script>
    <script src="vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="vendor/vector-map/jquery.vmap.world.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            function preview(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#pict').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#gambar').change(function () {
                preview(this);
            })
        });
    </script>
    <script>
        $(document).ready(function () {
            function preview(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#pict2').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#gambar2').change(function () {
                preview(this);
            })
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#forLogout').click(function (e) {
                e.preventDefault();
                swal({
                    title: "Logout",
                    text: "Yakin Logout?",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, function (isConfirm) {
                    if (isConfirm) {
                        window.location.href = "?logout";
                    }
                });
            });



        })
    </script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
    <?php include "config/alert.php"; ?>
</body>

</html>