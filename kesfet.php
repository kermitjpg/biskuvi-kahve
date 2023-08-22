<?php
$sayfa = "Keşfet";
include("inc/vt.php");
include("inc/head.php");
$sorgu = $baglanti->prepare("select * from kesfet");
$sorgu->execute();
$sonuc = $sorgu->fetch();
?>



<section id="portfolyo">



    <div class="content-2" id="portfolyo">
        <h2><?php echo $sonuc["ustBaslik"] ?></h2>
        <hr>
    </div>



    <div class="py-5">
        <div class="container-fluid">
            <div class="row">

                <?php
                $sorgu10 = $baglanti->prepare("select * from kesfetfoto WHERE aktif=1 ORDER BY sira");
                $sorgu10->execute();
                while ($sonuc10 = $sorgu10->fetch()) {
                ?>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="<?php echo $sonuc10["link"] ?>"><img class="img-fluid d-block mx-auto" src="images/<?php echo $sonuc10["foto"] ?>" alt="" /></a>
                        <div class="gecis2">
                            <i class="<?php echo $sonuc10["simge"] ?>"></i>
                            <h3><?php echo $sonuc10["kahveisim"] ?></h3>
                            <h4><?php echo $sonuc10["kahvefiyat"] ?></h4>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    </div>
</section>
<?php
include("inc/footer.php");
?>