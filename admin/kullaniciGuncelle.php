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
    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;


    if ($_POST["kadi"] != '' && $_POST["email"] != '' && $_POST["yetki"] != '') {

        $ekleSorgu = $baglanti->prepare('UPDATE kullanici SET kadi=:kadi, email=:email, yetki=:yetki, aktif=:aktif WHERE id=:id');
        $ekle = $ekleSorgu->execute([
            'kadi' => $_POST['kadi'],
            'email' => $_POST['email'],
            'yetki' => $_POST['yetki'],
            'aktif' => $aktif,
            'id' => $_GET['id'],
        ]);

        if ($ekle) {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Başarılı!', text:'Güncelleme başarılı!', icon:'success', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
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
        <h1 class="mt-4">Kullanıcı Güncelle</h1>
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
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $sonuc["email"] ?>">
                    </div>


                    <div class="form-group">
                        <label>Yetki</label> <br>
                        <label> <input type="radio" name="yetki" value="1" <?= $sonuc['yetki'] == '1' ? 'checked' : '' ?>>Admin</label><br>
                        <label><input type="radio" name="yetki" value="2" <?= $sonuc['yetki'] == '2' ? 'checked' : '' ?>>Normal Kullanıcı</label>

                    </div>


                    <!-- Switch buton aktif pasif kodları kullanılırken jquery cdn gerekli -->
                    <!-- Div form-group form-check içine almıyoruz çünkü içine alınca tasarım kayıyor-->

                    <div class="form-group">
                        <link href="css/switch.css" rel="stylesheet" /> <!--  Switch CSS gerekli-->
                        <label class="switch" style="margin-top: 25px;">
                            <!-- checkbox a id ve checked bilgilerini ekliyoruz -->
                            <input type="checkbox" id='<?= $sonuc['id'] ?>' class="aktifPasif" <?= $sonuc['aktif'] == 1 ? 'checked' : '' ?> />
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <!-- Switch buton aktif pasif kodları kullanılırken jquery cdn gerekli -->


                    <div class="form-group">
                        <input type="submit" value="Güncelle" class="btn btn-primary">
                    </div>


                    <!-- Checkbox input yedek kodlar burada -->
                    <!-- Form-group form-check kullanılıyorsa input classında form-check-input kullanılmamalı yoksa önünde 
                    boşluk oluşuyor. Aynı zamanda form-group kullanılıyorsa form-check de kullanılmamalı.-->

                    <!-- <div class="form-group form-check">
                        <label>
                            <input type="checkbox" name="aktif" class="form-check-input" <?= $sonuc['aktif'] == '1' ? 'checked' : '' ?>>Aktif
                        </label>
                    </div> -->

                    <!-- Checkbox input yedek kodlar burada -->

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