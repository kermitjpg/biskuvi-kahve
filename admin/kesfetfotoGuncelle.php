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

$id = $_GET['id'];
$sorgu10 = $baglanti->prepare("select * from kesfetfoto WHERE id=:id");
$sorgu10->execute(['id' => $id]);
$sonuc10 = $sorgu10->fetch();


if ($_POST) {
    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;

    $hata = '';
    $foto = '';

    if ($_POST["simge"] != '' && $_POST["link"] != '' && $_POST["kahveisim"] != '' && $_POST["kahvefiyat"] != '' && $_POST["sira"] != '' && $_FILES["foto"]['name'] != '') {
        if ($_FILES['foto']['error'] != 0) {
            $hata .= 'Dosya yüklenirken bir hata oluştu!';
        } elseif (file_exists('../images/' . strtolower($_FILES["foto"]['name']))) {
            $hata .= 'Aynı isimde bir dosya zaten mevcut.';
        } elseif ($_FILES['foto']['size'] > (1024 * 1024 * 10)) {
            $hata .= 'Dosya boyutu 10 MB büyük olamaz.';
        } elseif (!in_array($_FILES['foto']['type'], ['image/png', 'image/jpeg'])) {
            $hata .= 'Hata, dosya türü PNG veya JPEG formatından biri olmalıdır.';
        } else {
            copy($_FILES['foto']['tmp_name'], '../images/' . strtolower($_FILES["foto"]['name']));
            unlink('../images/' . $sonuc10['foto']);
            $foto = strtolower($_FILES["foto"]['name']);
        }
        if ($hata != '') {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Hata!', text:'$hata', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', })</script>";
        }
    } else {
        $foto = $sonuc10['foto'];
    }

    if ($_POST["simge"] != '' && $_POST["link"] != '' && $_POST["kahveisim"] != '' && $_POST["kahvefiyat"] != '' && $_POST["sira"] != '' && $hata == '') {

        $guncelleSorgu = $baglanti->prepare('Update kesfetfoto SET foto=:foto, simge=:simge, link=:link, kahveisim=:kahveisim, kahvefiyat=:kahvefiyat, sira=:sira, aktif=:aktif WHERE id=:id');
        $guncelle = $guncelleSorgu->execute([
            'foto' => $foto,
            'simge' => $_POST['simge'],
            'link' => $_POST['link'],
            'kahveisim' => $_POST['kahveisim'],
            'kahvefiyat' => $_POST['kahvefiyat'],
            'sira' => $_POST['sira'],
            'aktif' => $aktif,
            'id' => $id,
        ]);

        if ($guncelle) {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Başarılı!', text:'Güncelleme başarılı!', icon:'success', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='kesfet.php'}
        })</script>";
        }
    }
}


?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Keşfet Güncelle</h1>
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
                        <input type="file" name="foto" class="form-control">
                    </div>

                    <div class=" form-group">
                        <label>Simge</label>
                        <input type="text" name="simge" class="form-control" value="<?= $sonuc10["simge"] ?>">
                    </div>


                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" name="link" required class="form-control" value="<?= $sonuc10["link"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Kahve İsim</label>
                        <input type="text" name="kahveisim" required class="form-control" value="<?= $sonuc10["kahveisim"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Fiyat</label>
                        <input type="text" name="kahvefiyat" required class="form-control" value="<?= $sonuc10["kahvefiyat"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Sıralama</label>
                        <input type="text" name="sira" required class="form-control" value="<?= $sonuc10["sira"] ?>">
                    </div>

                    <div class="form-group">

                        <link href="css/switch.css" rel="stylesheet" />
                        <label class="switch" style="margin-top: 25px;">
                            <!-- checkbox a id ve checked bilgilerini ekliyoruz -->
                            <input type="checkbox" id='<?= $sonuc10['id'] ?>' class="aktifPasif" <?= $sonuc10['aktif'] == 1 ? 'checked' : '' ?> />
                            <span class="slider round"></span>
                        </label>
                        <!-- Switch buton aktif pasif kodları kullanılırken jquery cdn gerekli -->


                        <!-- <label>
                                <input type="checkbox" name="aktif"
                                       class="form-check-input" <?= $sonuc10['aktif'] == 1 ? 'checked' : '' ?>>Aktif
                            </label> -->
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


<!-- Switch buton aktif pasif scripti kullanılırken jquery cdn gerekli -->

<script type="text/javascript">
    $(document).ready(function() {
        $('.aktifPasif').click(function(event) {
            var id = $(this).attr("id"); //id değerini alıyoruz

            var durum = ($(this).is(':checked')) ? '1' : '0';
            //checkbox a göre aktif mi pasif mi bilgisini alıyoruz.

            $.ajax({
                type: 'POST',
                url: 'inc/aktifPasif.php', //işlem yaptığımız sayfayı belirtiyoruz
                data: {
                    id: id,
                    tablo: 'kullanici',
                    durum: durum
                }, //datamızı yolluyoruz
                success: function(result) {
                    $('#sonuc').text(result);
                    //gelen sonucu h2 tagında gösteriyoruz
                },
                error: function() {
                    alert('Hata');
                }
            });
        });
    });
</script>