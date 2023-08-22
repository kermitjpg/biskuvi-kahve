<?php
$sayfa = "İletişim";
include("inc/vt.php");
include("inc/head.php");
?>


<body class="swal2-shown swal2-height-auto" style="padding-right: 0px;">


    <style>
        .swal2-popup {
            display: none;
            position: relative;
            box-sizing: border-box;
            grid-template-columns: minmax(0, 100%);
            width: 32em;
            max-width: 100%;
            padding: 0 0 1.25em;
            border: none;
            border-radius: 5px;
            background: #fff;
            color: #545454;
            font-family: inherit;
            font-size: 2rem;
        }
    </style>

    <?php
    $sorgu = $baglanti->prepare("select * from iletisimbaslik");
    $sorgu->execute();
    $sonuc = $sorgu->fetch();
    ?>


    <section class="iletisim-background" id="iletisim-background">
        <div class="ana-kapsama">
            <div class="yazilar">
                <div class="iletisim-baslik">
                    <h3><?php echo $sonuc["ustBaslik"] ?></h3>
                </div>
            </div>
            <div class="form-elemanlar">
                <form id="iletisimForm">
                    <input type="text" name="ad_soyad" id="adSoyad" autocomplete="off" placeholder="ADINIZ SOYADINIZ" required />
                    <hr>
                    <input type="email" name="email" id="mail" autocomplete="off" placeholder="MAIL ADRESINIZ" required />
                    <hr>
                    <textarea name="not" id="mesajKontrol" cols="22" rows="10" placeholder="MESAJINIZ" required></textarea><br>
                    <hr>
                    <button type="button" id="btnGonder">Gönder</button>
                    <!-- <input type="submit" class="button" id="btnGonder" value="Gönder" /> -->
                </form>

                <?php

                if ($_POST) {
                    $sorgu = $baglanti->prepare("INSERT INTO iletisim SET Adi=:Adi, Mail=:Mail, Mesaj=:Mesaj");
                    $ekle = $sorgu->execute(
                        [
                            'Adi' => htmlspecialchars($_POST["ad_soyad"]), // Name
                            'Mail' => htmlspecialchars($_POST["email"]), // Name
                            'Mesaj' => htmlspecialchars($_POST["not"]), // Name
                        ]
                    );
                }

                ?>
            </div>
        </div>
    </section>

    
    <script type="text/javascript">
        // Yazılım

        $("#btnGonder").on("click", function() {

            if ($.trim($("#adSoyad").val()) === "" || $.trim($("#mail").val()) === "" || $.trim($("#mesajKontrol").val()) === "") {
                Swal.fire({
                    title: 'Hata!',
                    text: 'Lütfen bilgileri eksiksiz girdiğinizden emin olunuz.',
                    icon: 'error',
                    confirmButtonText: 'Tamam',
                    confirmButtonColor: "#000",

                }).then((result) => {
                    window.location.reload();
                })
                return false;
            } else {

                var data = $("#iletisimForm").serialize();
                $.ajax({
                    url: 'iletisim.php', 
                    type: 'POST',
                    data: data,
                    success: function(e) {

                        Swal.fire({
                            title: 'Harika',
                            text: 'Talebiniz başarıyla alınmıştır. En kısa sürede dönüş yapılacaktır.',
                            icon: 'success',
                            confirmButtonText: 'Tamam',
                            confirmButtonColor: "#000",

                        }).then((result) => {
                            window.location.reload();
                        })

                    }
                });
            }

        });
    </script>


    <?php
    include("inc/footer.php");
    ?>




  