<?php
$sayfa = "Admin Hakkımızda";
include("inc/ahead.php");


if ($_SESSION["yetki"] != "1") {
    echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script> Swal.fire( {title: 'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='hakkimizda.php'}
        })</script>";
    exit;
}


$sorgu = $baglanti->prepare("select * from hakkimizda WHERE id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();

if ($_POST) { ///veri güncelle

    $guncelleSorgu = $baglanti->prepare("Update hakkimizda set ustBaslik=:ustBaslik, solYazi=:solYazi, sagYazi=:sagYazi");
    $guncelle = $guncelleSorgu->execute([
        'ustBaslik' => $_POST["ustBaslik"],
        'solYazi' => $_POST["solYazi"],
        'sagYazi' => $_POST["sagYazi"],


    ]);

    if ($guncelle) {
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo "<script> Swal.fire( {title: 'Başarılı!', text:'Güncelleme başarılı!', icon:'success', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='hakkimizda.php'}
        })</script>";
    }
}
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Hakkımızda</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Bilgi Girişi</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>

            </div>
            <div class="card-body">

                <form action="" method="post">
                    <div class="form-group">
                        <label>Üst Başlık</label>
                        <input type="text" name="ustBaslik" required class="form-control" value="<?= $sonuc["ustBaslik"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Sol Yazı </label>
                        <input type="text" name="solYazi" required class="form-control" value="<?= $sonuc["solYazi"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Sağ Yazı</label>
                        <input type="text" name="sagYazi" required class="form-control" value="<?= $sonuc["sagYazi"] ?>">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Güncelle" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>


<?php
include("inc/afooter.php")
?>