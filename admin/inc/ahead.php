<?php
session_start();
if (!(isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789")) {
    header("location:login.php");
}

include("../inc/vt.php")
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $sayfa ?> Bisküvi Kahve</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<style>
    .form-group label {
        padding-top: 25px;
    }

    .form-group input[type=submit] {
        margin-top: 25px;
    }
</style>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="anasayfa.php">Yönetim Paneli</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            </li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Çıkış</a></li>
        </ul>
        </li>
        </ul>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Çıkış</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Çıkış yapmak istediğinizden emin misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <a href="logout.php" class="btn btn-danger">Çıkış</a>
                </div>
            </div>
        </div>
    </div>




    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <div class="sb-sidenav-menu-heading">Ana Menü</div>
                        <a class="nav-link <?= $sayfa == "Admin Dashboard" ? "active" : "" ?>" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <div class="sb-sidenav-menu-heading">Sayfalar</div>
                        <a class="nav-link collapsed <?= $sayfa == "Admin Anasayfa" ? "active" : "" ?> " href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Anasayfa
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link <?= $sayfa == "Admin Anasayfa" ? "active" : "" ?>" href="anasayfa.php">Anasayfa</a>
                                <!-- <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a> -->
                            </nav>
                        </div>

                        <!-- EDİT -->
                        <a class="nav-link <?= $sayfa == "Admin Keşfet" ? "active" : "" ?>" href="kesfet.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Keşfet
                        </a>

                        <!-- EDİT -->
                        <a class="nav-link <?= $sayfa == "Admin Hakkımızda" ? "active" : "" ?>" href="hakkimizda.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Hakkımızda
                        </a>




                        <!-- EDİT -->
                        <!-- Okundu sayı bilgisi -->
                        <?php
                        $sorguOkundu = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM iletisim WHERE okundu=0");
                        $sorguOkundu->execute();
                        $sonucOkundu = $sorguOkundu->fetch();
                        ?>
                        <!-- Okundu sayı bilgisi -->

                        <a class="nav-link collapsed <?= $sayfa == "Admin İletişim Başlık" || $sayfa == "Admin İletişim Form" ? "active" : "" ?> " href="#" data-bs-toggle="collapse" data-bs-target="#iletisimbaslik" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            İletişim
                            <!-- Okundu sayı bilgisi -->
                            &nbsp;
                            <span id="okunmaSayisi" class="badge rounded-pill bg-warning text-dark"> <?= $sonucOkundu["sayi"] ?></span>
                            <!-- Okundu sayı bilgisi -->
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="iletisimbaslik" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link <?= $sayfa == "Admin İletişim Başlık" ? "active" : "" ?>" href="iletisimbaslik.php">Başlık</a>


                                <a class="nav-link <?= $sayfa == "Admin İletişim Form" ? "active" : "" ?>" href="iletisim.php">Form
                                    <!-- Okundu sayı bilgisi  
                                  &nbsp;
                                    <span id="okunmaSayisi" class="badge rounded-pill bg-warning text-dark"><?= $sonucOkundu["sayi"] ?></span> -->
                                </a>

                            </nav>
                        </div>




                        <!-- EDİT -->
                        <?php
                        if ($_SESSION["yetki"] == "1") { ?>
                            <a class="nav-link <?= $sayfa == "Kullanıcılar" ? "active" : "" ?>" href="kullanici.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Kullanıcılar
                            </a>
                        <?php } ?>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Kullanıcı:</div>
                    <?= $_SESSION["kadi"] ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">