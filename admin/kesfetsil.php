<?php

$sayfa = "";
include("inc/ahead.php");


if ($_SESSION["yetki"] != "1") {
    echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
    Swal.fire({
        title: 'Hata!',
        text: 'Yetkisiz kullanıcı',
        icon: 'error',
        confirmButtonText: 'Kapat',
        confirmButtonColor: '#000',
    }).then((value) => {
        if (value.isConfirmed) {
            window.location.href = 'kesfet.php'
        }
    })
</script>";
    exit;
}

if ($_GET) {
    $tablo = $_GET["tablo"];
    $id = (int)$_GET["id"];

    $sorgu10 = $baglanti->prepare("DELETE FROM $tablo WHERE id=:id");
    $sonuc10 = $sorgu10->execute(["id" => $id]);
    if ($sonuc10) {
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo "<script>
    Swal.fire({
        title: 'Başarılı!!',
        text: 'Silme işlemi başarılı.',
        icon: 'success',
        confirmButtonText: 'Kapat',
        confirmButtonColor: '#000',
    }).then((value) => {
        if (value.isConfirmed) {
            window.location.href = 'kesfet.php'
        }
    })
</script>";
    }
}
include("inc/afooter.php");
