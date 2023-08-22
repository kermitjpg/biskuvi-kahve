<?php
$sayfa = "Kullanıcılar";
include("inc/ahead.php");


if ($_SESSION["yetki"] != "1") {
    echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script> Swal.fire( {title: 'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='anasayfa.php'}
        })</script>";
    exit;
}


$sorgu = $baglanti->prepare("select * from kullanici where id=:id");
$sorgu->execute(['id' => $_GET['id']]);
$sonuc = $sorgu->fetch();
if ($_POST) {


    if ($_POST["kadi"] != '' && $_POST["parola"] != '' && $_POST["parola"] == $_POST["pTekrar"]) {

        $ekleSorgu = $baglanti->prepare('UPDATE kullanici SET kadi=:kadi, parola=:parola where id=:id');
        $ekle = $ekleSorgu->execute([
            'kadi' => $_POST['kadi'],
            'parola' => md5("56" . $_POST['parola'] . "23"),
            'id' => $_GET['id'],
        ]);

        if ($ekle) {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Başarılı!', text:'Güncelleme başarılı!', icon:'success', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='kullanici.php'}
        })</script>";
        } else {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Hata!', text:'Güncelleme başarısız!', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', })</script>";
        }
    } else {
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo "<script> Swal.fire( {title: 'Hata!', text:'Eksik bilgi!', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', })</script>";
    }
}

?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kullanıcı Parola Güncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Bilgi Girişi</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>

            </div>
            <div class="card-body">

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input type="text" name="kadi" required class="form-control" value="<?= $sonuc["kadi"] ?>">
                    </div>

                    <div class=" form-group">
                        <label>Parola</label>
                        <input type="password" name="parola" class="form-control">
                    </div>

                    <div class=" form-group">
                        <label>Parola Tekrar</label>
                        <input type="password" name="pTekrar" class="form-control">
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