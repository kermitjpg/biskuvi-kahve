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

if ($_POST) {
    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;


    if ($_POST["kadi"] != '' && $_POST["parola"] != '' && $_POST["email"] != '' && $_POST["yetki"] != '') {

        $ekleSorgu = $baglanti->prepare('INSERT INTO kullanici SET kadi=:kadi, parola=:parola, email=:email, yetki=:yetki, aktif=:aktif');
        $ekle = $ekleSorgu->execute([
            'kadi' => $_POST['kadi'],
            'parola' => md5("56" . $_POST['parola'] . "23"),
            'email' => $_POST['email'],
            'yetki' => $_POST['yetki'],
            'aktif' => $aktif
        ]);

        if ($ekle) {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Başarılı!', text:'Ekleme başarılı!', icon:'success', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='kullanici.php'}
        })</script>";
        } else {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Hata!', text:'Bir hata oluştu!', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', })</script>";
        }
    }
}



?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kullanıcı Ekle</h1>
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
                        <input type="text" name="kadi" required class="form-control" value="<?= @$_POST["kadi"] ?>">
                    </div>

                    <div class=" form-group">
                        <label>Parola</label>
                        <input type="password" name="parola" class="form-control">
                    </div>

                    <div class=" form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= @$_POST["email"] ?>">
                    </div>


                    <div class="form-group">
                        <label>Yetki</label> <br>
                        <label> <input type="radio" name="yetki" value="1">Admin</label><br>
                        <label><input type="radio" name="yetki" value="2" checked>Normal Kullanıcı</label>

                    </div>

                    <div class="form-group form-check">
                        <label>
                            <input type="checkbox" name="aktif" class="form-check-input">Aktif
                        </label>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Ekle" class="btn btn-primary">
                    </div>
                </form>


            </div>
        </div>
    </div>
</main>


<?php
include("inc/afooter.php")
?>