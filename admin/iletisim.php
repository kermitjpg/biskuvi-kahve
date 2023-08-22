<?php
$sayfa = "Admin İletişim Form";
include("inc/ahead.php");

/* Tümünü sil butonu kodları */
if (isset($_POST['sil']) && $_SESSION["yetki"] == "1") {
    //Seçilenleri pdo ile toplu silme kodu:
    $silinecekler = implode(', ', $_POST['sil']);
    $sorgu = $baglanti->prepare('DELETE FROM iletisim WHERE id IN (' . $silinecekler . ')');
    $sorgu->execute();
}
/* Tümünü sil butonu kodları*/
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">İletişim Form </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Bilgi </li>
        </ol>

        <form action="" method="post">
            <div class="card mb-4">
                <div class="card-header">



                    <?php if ($_SESSION["yetki"] == "1") { /* Tümünü sil butonu kodları*/

                    ?>

                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#silModal"><span class="fa fa-trash"></span> Tümünü Sil</a>
                        <!-- Modal -->
                        <div class="modal fade" id="silModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Sil</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        Silmek istediğinizden emin misiniz?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                        <button type="submit" class="btn btn-danger my-3"> Sil </button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                    <!-- Tümünü sil butonu kodları -->

                </div>
                <div class="card-body">

                    <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">

                        <thead>
                            <tr>

                                <!-- Tümünü sil butonu kodları -->
                                <input type="checkbox" id="tumunuSec" onclick="TumunuSec();" value="" style="display: none;" checked>
                                <!-- Tümünü sil butonu kodları -->

                                <th class="text-center">ID</th>
                                <th class="text-center">Ad Soyad</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Mesaj</th>
                                <th class="text-center">Sil</th>
                            </tr>
                        </thead>



                        <?php
                        $sorgu = $baglanti->prepare("select * from iletisim order by okundu");
                        $sorgu->execute();
                        while ($sonuc = $sorgu->fetch()) {


                        ?>
                            <tr <?php if ($sonuc["okundu"] == 0) echo 'class="fw-bold"' ?>>
                                <!-- Okundu bilgisi sıfır olanları kalın yazıya dönüştür demek için ana kapsayıcıya bu kodları ekledik. -->
                                <!-- Verileri admin paneline çektik -->


                                <!-- Tümünü sil butonu kodları -->
                                <input class="cbSil" type="checkbox" name="sil[]" value="<?= $sonuc['id']; ?>" style="display: none;" checked>
                                <!-- Tümünü sil butonu kodları -->

                                <td><?= $sonuc["id"] ?></td>
                                <td><?= $sonuc["Adi"] ?></td>
                                <td><?= $sonuc["Mail"] ?></td>

                                <!-- Oku butonu kodları -->
                                <td class="text-center">
                                    <!-- Okundu bilgisinin ayarları için oku butonunda 'A' linkinin id sine ve classına ekleme yaptık. -->
                                    <a id="<?= $sonuc["id"] ?>" href="#" class="btn btn-primary oku" data-bs-toggle="modal" data-bs-target="#okuModal<?= $sonuc["id"] ?>">Oku</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="okuModal<?= $sonuc["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Mesaj</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <?= $sonuc["Mesaj"] ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <!-- Oku butonu kodları -->


                                <td class="text-center">
                                    <?php if ($_SESSION["yetki"] == "1") {

                                    ?>

                                        <a href="#" data-bs-toggle="modal" data-bs-target="#silModal<?= $sonuc["id"] ?>"><span class="fa fa-trash fa-2x text-danger"></span></a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="silModal<?= $sonuc["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sil</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        Silmek istediğinizden emin misiniz?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                                        <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=iletisim" class="btn btn-danger">Sil</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</main>



<?php
include("inc/afooter.php")
?>






<!-- Tümünü sil butonu scripti -->

<script type="text/javascript">
    //Tümünü seçme ve silme işlemini yapan script kodları:
    $(document).ready(function() {
        $('#tumunuSec').on('click', function() {
            if ($('#tumunuSec:checked').length == $('#tumunuSec').length) {
                $('input.cbSil:checkbox').prop('checked', true);
            } else {
                $('input.cbSil:checkbox').prop('checked', false);

            }
        });
    });
</script>
<!-- Tümünü sil butonu scripti -->



<!-- Okundu bilgisi scripti -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.oku').click(function(event) {
            var id = $(this).attr("id");
            var veri = $(this);
            var sayi = parseInt($('#okunmaSayisi').text());


            $.ajax({
                type: 'POST',
                url: 'inc/okundu.php',
                data: {
                    id: id,
                    tablo: 'iletisim'
                },
                success: function(result) {
                    if (result == true) {
                        veri.closest('tr').removeClass("fw-bold");
                        if (sayi > 0) $("#okunmaSayisi").text(sayi - 1);
                    }
                },
            });
        });

    });
</script>
<!-- Okundu bilgisi scripti -->