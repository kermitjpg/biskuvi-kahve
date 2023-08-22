<?php
$sayfa = "Admin Keşfet";
include("inc/ahead.php");


if ($_SESSION["yetki"] != "1") {
    echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script> Swal.fire( {title: 'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='anasayfa.php'}
        })</script>";
    exit;
}


$sorgu = $baglanti->prepare("select * from kesfet WHERE id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();

if ($_POST) { ///veri güncelle

    $guncelleSorgu = $baglanti->prepare("Update kesfet set ustBaslik=:ustBaslik");
    $guncelle = $guncelleSorgu->execute([
        'ustBaslik' => $_POST["ustBaslik"]



    ]);

    if ($guncelle) {
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo "<script> Swal.fire( {title: 'Başarılı!', text:'Güncelleme başarılı.', icon:'success', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='kesfet.php'}
        })</script>";
    }
}
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Keşfet Başlık</h1>
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
                        <label>Üst başlık</label>
                        <input type="text" name="ustBaslik" required class="form-control" value="<?= $sonuc["ustBaslik"] ?>">
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