<?php
$sayfa = "Admin Keşfet";
include("inc/ahead.php");


if ($_SESSION["yetki"] != "1") {
    echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script> Swal.fire( {title: 'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='kesfet.php'}
        })</script>";
    exit;
}

if ($_POST) {
    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;

    $hata = '';

    if ($_POST["simge"] != '' && $_POST["link"] != '' && $_POST["kahveisim"] != '' && $_POST["kahvefiyat"] != '' && $_POST["sira"] != '' && $_FILES["foto"]['name'] != '') {
        if ($_FILES['foto']['error'] != 0) {
            $hata .= 'Dosya yüklenirken bir hata oluştu!';
        } /* elseif (file_exists('../images/'.strtolower($_FILES["foto"]['name']))) {
            $hata .= 'Aynı isimde bir dosya zaten mevcut.';
        }*/ elseif ($_FILES['foto']['size'] > (1024 * 1024 * 10)) {
            $hata .= 'Dosya boyutu 10 MB büyük olamaz.';
        } elseif (!in_array($_FILES['foto']['type'], ['image/png', 'image/jpeg'])) {
            $hata .= 'Hata, dosya türü PNG veya JPEG formatından biri olmalıdır.';
        } else {
            copy($_FILES['foto']['tmp_name'], '../images/' . strtolower($_FILES["foto"]['name']));
            $ekleSorgu = $baglanti->prepare('INSERT INTO kesfetfoto SET foto=:foto, simge=:simge, link=:link, kahveisim=:kahveisim, kahvefiyat=:kahvefiyat, sira=:sira, aktif=:aktif');
            $ekle = $ekleSorgu->execute([
                'foto' => strtolower($_FILES["foto"]['name']),
                'simge' => $_POST['simge'],
                'link' => $_POST['link'],
                'kahveisim' => $_POST['kahveisim'],
                'kahvefiyat' => $_POST['kahvefiyat'],
                'sira' => $_POST['sira'],
                'aktif' => $aktif
            ]);

            if ($ekle) {
                echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                echo "<script> Swal.fire( {title: 'Başarılı!', text:'Ekleme başarılı!', icon:'success', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='kesfet.php'}
        })</script>";
            }
        }
        if ($hata != '') {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Hata!', text:'$hata', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', })</script>";
        }
    }
}


?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Keşfet Ekle</h1>
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
                        <label>Fotoğraf</label>
                        <input type="file" name="foto" required class="form-control">
                    </div>

                    <div class=" form-group">
                        <label>Simge</label>
                        <input type="text" name="simge" class="form-control" value="<?= @$_POST["simge"] ?>">
                    </div>


                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" name="link" required class="form-control" value="<?= @$_POST["link"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Kahve İsim</label>
                        <input type="text" name="kahveisim" required class="form-control" value="<?= @$_POST["kahveisim"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Fiyat</label>
                        <input type="text" name="kahvefiyat" required class="form-control" value="<?= @$_POST["kahvefiyat"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Sıralama</label>
                        <input type="text" name="sira" required class="form-control" value="<?= @$_POST["sira"] ?>">
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="aktif" class="form-check-input"> Aktif mi?
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