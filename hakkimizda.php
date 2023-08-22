<?php
$sayfa = "Hakkımızda";
include("inc/vt.php");
include("inc/head.php");

$sorgu = $baglanti->prepare("select * from hakkimizda");
$sorgu->execute();
$sonuc = $sorgu->fetch();
?>



<section class="home" id="anasayfa">
    <div class="ana-text-2">
        <section id="section-a">
            <div class="content">
                <h2><?php echo $sonuc["ustBaslik"] ?></h2>
                <hr><br>
            </div>

            <div class="hakkimizda-text clearfix">
                <div class="left">
                    <p class="text">
                        <?php echo $sonuc["solYazi"] ?>
                    </p>
                </div>
                <div class="right">
                    <p class="text">
                        <?php echo $sonuc["sagYazi"] ?>
                    </p>

                </div>
            </div>
        </section>
    </div>
</section>



<?php
include("inc/footer.php");
?>