<?php
$sayfa = "Admin Keşfet";
include("inc/ahead.php");
$sorgu = $baglanti->prepare("select * from kesfet");
$sorgu->execute();
$sonuc = $sorgu->fetch();
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Keşfet </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Bilgi </li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <a href="kesfetEkle.php" class="btn btn-success">Keşfet Ekle</a>




            </div>
            <div class="card-body">
                <table id="dataTable" class="dataTable table table-bordered table-responsive" width="100%" cellspacing="0">
                    <!-- datatablesSimple / dataTable -->
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Üst Başlık</th>
                            <th class="text-center">Düzenle</th>
                            <th class="text-center">Sil</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>

                            <td><?= $sonuc["id"] ?></td>
                            <td><?= $sonuc["ustBaslik"] ?></td>



                            <td class="text-center">

                                <?php if ($_SESSION["yetki"] == "1") {
                                ?>

                                    <a href="kesfetbaslikGuncelle.php?id=<?= $sonuc["id"] ?>">
                                        <span class="fa fa-edit fa-2x"></span>
                                    </a>
                                <?php
                                }
                                ?>
                            </td>


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
                                                    <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=kesfet" class="btn btn-danger">Sil</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>






                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Fotoğraf</th>
                            <th class="text-center">Simge</th>
                            <th class="text-center">Link</th>
                            <th class="text-center">İsim</th>
                            <th class="text-center">Fiyat</th>
                            <th class="text-center">Sıra</th>
                            <th class="text-center">Aktif</th>
                            <th class="text-center">Düzenle</th>
                            <th class="text-center">Sil</th>


                        </tr>
                    </thead>


                    <?php
                    $sorgu10 = $baglanti->prepare("select * from kesfetfoto");
                    $sorgu10->execute();
                    while ($sonuc10 = $sorgu10->fetch()) {


                    ?>

                        <tr>
                            <td><?= $sonuc10["id"] ?></td>
                            <td><img width="150" src="../images/<?= $sonuc10["foto"] ?>"></td>
                            <td><?= $sonuc10["simge"] ?></td>
                            <td><?= $sonuc10["link"] ?></td>
                            <td><?= $sonuc10["kahveisim"] ?></td>
                            <td><?= $sonuc10["kahvefiyat"] ?></td>
                            <td><?= $sonuc10["sira"] ?></td>
                            <td>
                                <link href="css/switch.css" rel="stylesheet" />
                                <label class="switch">
                                    <!-- checkbox a id ve checked bilgilerini ekliyoruz -->
                                    <input type="checkbox" id='<?= $sonuc10['id'] ?>' class="aktifPasif" <?= $sonuc10['aktif'] == 1 ? 'checked' : '' ?> />
                                    <span class="slider round"></span>
                                </label>
                            </td>



                            <td class="text-center">

                                <?php if ($_SESSION["yetki"] == "1") {
                                ?>

                                    <a href="kesfetfotoGuncelle.php?id=<?= $sonuc10["id"] ?>">
                                        <span class="fa fa-edit fa-2x"></span>
                                    </a>
                                <?php
                                }
                                ?>
                            </td>


                            <td class="text-center">
                                <?php if ($_SESSION["yetki"] == "1") {

                                ?>

                                    <a href="#" data-bs-toggle="modal" data-bs-target="#silModal<?= $sonuc10["id"] ?>"><span class="fa fa-trash fa-2x text-danger"></span></a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="silModal<?= $sonuc10["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <a href="kesfetsil.php?id=<?= $sonuc10["id"] ?>&tablo=kesfetfoto" class="btn btn-danger">Sil</a>
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
    </div>
</main>



<?php
include("inc/afooter.php")
?>


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
                    tablo: 'kesfetfoto',
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