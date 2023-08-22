<?php  // Veri Çekme - 2
//ajax dan gelen kodlar burada yer alıyor. Database'ye  veri eklemek için bu kodlar kullanılabilir.
include("inc/vt.php");
ob_start();
$Adi = @$_POST['ad_soyad']; //
$Mail = @$_POST['email'];
$Mesaj = @$_POST['not'];
if ($_POST) {
    if ($Adi <> "" && $Mail <> "" && $Mesaj <> "") {
        if ($baglanti->query("INSERT INTO iletisim (Adi,Mail,Mesaj) VALUES ('$Adi','$Mail','$Mesaj')")) {
            echo "Mesaj Gönderildi.....";
        } else {
            echo "Hata var";
        }
    }
}
ob_end_flush();
