<?php
$sorgu = $baglanti->prepare("select * from social");
$sorgu->execute();
$sonuc = $sorgu->fetch();
?>


<!--! Footer Başlangıç -->

<section class="footer">
    <h1>Bisküvi Kahve</h1>
    <div class="share">
        <a href="<?php echo $sonuc["facebook"] ?>" class="fab fa-facebook"></a>
        <a href="<?php echo $sonuc["twitter"] ?>" class="fab fa-twitter"></a>
        <a href="<?php echo $sonuc["instagram"] ?>" class="fab fa-instagram"></a>
        <a href="<?php echo $sonuc["linkedin"] ?>" class="fab fa-linkedin"></a>
    </div>

    <div class="credit">
        © COPYRIGHT - 2022 BISKUVI KAHVE<br>
        powered by <a href="https://www.instagram.com/umutboracaki" target="_blank"><span>UBC</span></a>
    </div>
</section>


<!--! Footer Bitiş-->






<script src="js/main.js" type="text/javascript"></script>

<!-- Font awesome cdn -->
<script src="https://kit.fontawesome.com/c5eff4ee4b.js" crossorigin="anonymous"></script>

<!-- Bootstrap 5 cdn -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<!-- Jquery cdn -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<!-- SweetAlert2 cdn -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>