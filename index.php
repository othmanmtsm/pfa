<?php include_once('header.php') ?>
<?php
// $count = (int)$_SESSION['loginc'];
// if ($count == 0) {
//   unset($_SESSION['user']);
// }
// if (!isset($_SESSION['user'])) {
//   header('location:login.php');
// }

if (!isset($_SESSION['user'])) {
  header('location:login.php');
}
?>
<div class="container mb-5" id="main_body">
  <div class="row">
    <div class="col-12 mt-5">
      <h2 style="font-weight: 100;">ARTICLES</h2>
      <hr>
    </div>
    <?php
    if (($file = fopen('articles.csv', 'r')) != false) {
      while ($data = fgetcsv($file, 1000, ',')) {
        echo "
              <div class='col-11 col-md-3 product mt-4 card text-center'>
              <center><img class='card-img-top img-fluid mt-2' src='$data[2]' alt='Card image cap'></center>
              <div class='card-body'>
                <div class='infos'>
                  <h5 class='card-title'>$data[1]</h5>
                  <p style='margin-bottom: 0; color:#969696; font-weight:200;'>$data[4]</p>
                  <p class='card-text'>$data[3] DH</p>
                </div>
                <div class='addcart'>
                  <box-icon name='cart-alt' ></box-icon>
                </div>
              </div>
            </div>
          ";
      }
    }
    ?>
  </div>
</div>



<?php include_once('footer.php') ?>