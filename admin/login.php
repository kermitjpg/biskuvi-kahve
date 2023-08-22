<?php
$sayfa = "Admin Giriş";
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
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/c5eff4ee4b.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-dark">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 py-5 my-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Admin Giriş <i class="fa-solid fa-key text-success"></i></h3>
                                </div>
                                <div class="card-body">

                                    <?php
                                    session_start();
                                    include("../inc/vt.php");

                                    if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789") {
                                        header("location:index.php");
                                    } elseif (isset($_COOKIE["cerez"])) {

                                        $sorgu = $baglanti->prepare("select kadi, yetki from kullanici WHERE aktif=1");
                                        $sorgu->execute();
                                        while ($sonuc = $sorgu->fetch()) {
                                            if ($_COOKIE["cerez"] == md5("aa" . $sonuc["kadi"] . "bb")) {

                                                $_SESSION["Oturum"] = "6789";
                                                $_SESSION["kadi"] = $sonuc["kadi"];
                                                $_SESSION["yetki"] = $sonuc["yetki"];
                                                header("location:index.php");
                                            }
                                        }
                                    }


                                    if ($_POST) {
                                        $kadi = $_POST["txtKadi"];
                                        $parola = $_POST["txtParola"];
                                    }

                                    ?>


                                    <form method="post" action="login.php">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="text" name="txtKadi" placeholder="name@example.com" />
                                            <label for="inputEmail">Kullanıcı Adı</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" name="txtParola" placeholder="Password" />
                                            <label for="inputPassword">Parola</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" name="cbHatirla" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Beni Hatırla</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Forgot Password?</a>
                                            <input type="submit" class="btn btn-primary" value="Giriş"></input>
                                            <!-- <a class="btn btn-primary" href="index.html">Login</a> -->
                                        </div>
                                    </form>
                                    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                    <?php


                                 

                                    // echo md5("56" . "biskuvibey" . "23");

                                    if ($_POST) {
                                        $sorgu = $baglanti->prepare("select parola, yetki from kullanici WHERE kadi=:kadi and aktif=1");
                                        $sorgu->execute(['kadi' => htmlspecialchars($kadi)]);
                                        $sonuc = $sorgu->fetch();
                                        if (md5("56" . $parola . "23") == $sonuc["parola"]) {

                                            $_SESSION["Oturum"] = "6789";
                                            $_SESSION["kadi"] = $kadi;
                                            $_SESSION["yetki"] = $sonuc["yetki"];

                                            if (isset($_POST["cbHatirla"])) {
                                                setcookie("cerez", md5("aa" . $kadi . "bb"), time() + (60 * 60 * 24 * 7));
                                            }


                                            header("location:index.php");
                                        } else {
                                            echo "<script> Swal.fire({
                            title: 'Hata!',
                            text: 'Kullanıcı adı veya şifre hatalı!',
                            icon: 'error',
                            confirmButtonText: 'Tamam',
                        })</script>";
                                        }
                                    }

                                    ?>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Biskuvi Kahve 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>