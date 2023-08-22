<?php
$sayfa = "Anasayfa";
include("inc/vt.php");
include("inc/head.php");
require('admin/inc/ayar.php'); // Sayaç bağlantı dosyaları //
require('admin/inc/fonksiyon.php'); // Sayaç bağlantı dosyaları //
sayac_ayar(); // Sayaç fonksiyonu //

$sorgu = $baglanti->prepare("select * from anasayfa");
$sorgu->execute();
$sonuc = $sorgu->fetch();
?>




<section class="home" id="anasayfa">
    <div class="ana-text">
        <h1><?php echo $sonuc["ustBaslik"] ?></h1>
        <?php if ($sayfa == "Anasayfa") echo "" ?><div class=""><a href="<?php echo $sonuc["link"] ?>" class="btn-2"><?php echo $sonuc["linkMetin"] ?></a></div>
        <!-- <div class=""><a href="kesfet" class="btn-2">Keşfet</a></div> -->
    </div>
</section>



<?php
include("inc/footer.php");
?>