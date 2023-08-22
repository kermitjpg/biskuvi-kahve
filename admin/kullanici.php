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
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kullanıcılar </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Kullanıcı Bilgileri </li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <a href="kullaniciEkle.php" class="btn btn-success">Kullanıcı Ekle</a>




            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="dataTable">
                    <thead>
                        <tr>
                            <th class="text-center">Kullanıcı Adı</th>
                            <th class="text-center">Yetki</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Aktif</th>
                            <th class="text-center">Parola Güncelle</th>
                            <th class="text-center">Güncelle</th>
                            <th class="text-center">Sil</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $sorgu = $baglanti->prepare("select * from kullanici");
                        $sorgu->execute();
                        while ($sonuc = $sorgu->fetch()) {
                        ?>
                            <tr>

                                <td><?= $sonuc["kadi"] ?></td>
                                <td><?= $sonuc["yetki"] == 1 ? 'Admin' : 'Normal Kullanıcı' ?></td>
                                <td><?= $sonuc["email"] ?></td>

                                <td>
                                   

                                    <link href="css/switch.css" rel="stylesheet" />
                                    <label class="switch">
                                        <!-- checkbox a id ve checked bilgilerini ekliyoruz -->
                                        <input type="checkbox" id='<?= $sonuc['id'] ?>' class="aktifPasif" <?= $sonuc['aktif'] == 1 ? 'checked' : '' ?> />
                                        <span class="slider round"></span>
                                    </label>

                                   
                                </td>

                                <td class="text-center">
                                    <a href="kullaniciParolaGuncelle.php?id=<?= $sonuc["id"] ?>">
                                        <span class="fa fa-key fa-2x"></span>
                                    </a>
                                </td>

                                <td class="text-center">
                                    <a href="kullaniciGuncelle.php?id=<?= $sonuc["id"] ?>">
                                        <span class="fa fa-edit fa-2x"></span>
                                    </a>
                                </td>


                                <td class="text-center">

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
                                                    <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=kullanici" class="btn btn-danger">Sil</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

