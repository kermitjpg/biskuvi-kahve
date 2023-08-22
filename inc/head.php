<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $sayfa ?> Bisküvi Kahve</title>
    <!-- Bootstrap 5 cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">


</head>

<body>
    <!-- Header Başlangıç -->
    <header id="header">
        <div class="header">
            <div class="navbar">
                <div class="header-logo">
                    <a href="anasayfa">
                        <img class="clear" src="images/header-logo.png" alt="">
                    </a>
                </div>
                <div class="header-menu">
                    <ul id="menuItems">
                        <?php if ($sayfa == "Anasayfa") echo "" ?><li><a href="anasayfa.php">Anasayfa</a></li>
                        <?php if ($sayfa == "Hakkımızda") echo "" ?><li><a href="hakkimizda.php">Hakkımızda</a></li>
                        <?php if ($sayfa == "Keşfet") echo "" ?><li><a href="kesfet.php">Keşfet</a></li>
                        <?php if ($sayfa == "İletişim") echo "" ?><li><a href="iletisim.php">İletişim</a></li>


                        <!--Hamburger Menü Görünüm--> <span class="acik" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
                        <div id="myNav" class="overlay">
                            <!--Hamburger Menü Görünüm-->


                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                            <div class="overlay-content">
                                <?php if ($sayfa == "Anasayfa") echo "" ?><a href="anasayfa.php">Anasayfa</a>
                                <?php if ($sayfa == "Hakkımızda") echo "" ?><a href="hakkimizda.php">Hakkımızda</a>
                                <?php if ($sayfa == "Keşfet") echo "" ?><a href="kesfet.php">Keşfet</a>
                                <?php if ($sayfa == "Keşfet") echo "" ?><a href="iletisim.php">İletişim</a>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </header>


    <script src="js/main.js" type="text/javascript"></script>

    <!-- Font awesome cdn -->
    <script src="https://kit.fontawesome.com/c5eff4ee4b.js" crossorigin="anonymous"></script>

    <!-- Bootstrap 5 cdn -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- SweetAlert2 cdn -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>