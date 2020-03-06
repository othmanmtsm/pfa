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
  }else {
    $count = (int)$_SESSION['loginc'];
    if ($count == 0) {
      unset($_SESSION['user']);
    }
  }
?>
<div class="container mb-5" id="main_body">
  <div class="row">
    <div class="col-12 mt-5">
      <h2 style="font-weight: 100;">ARTICLES</h2>
      <hr>
    </div>
    <div class="col-10 col-md-4 product mt-4 card text-center">
      <center><img class="card-img-top img-fluid mt-2" src="images/a1.jpg" alt="Card image cap"></center>
      <div class="card-body">
        <div class='infos'>
          <h5 class="card-title">RÉFRIGÉRATEUR</h5>
          <p style="margin-bottom: 0; color:#969696; font-weight:200;">Lorem ipsum sit dolor amet</p>
          <p class="card-text">6000DH</p>
        </div>
        <div class="addcart">
          <box-icon name='cart-alt' ></box-icon>
        </div>
      </div>
    </div>
    <div class="col-10 col-md-4 product mt-4 card text-center">
     <center><img class="card-img-top img-fluid mt-2" src="images/2.png" alt="Card image cap"></center>
      <div class="card-body">
        <div class="infos">
        <h5 class="card-title">CHAISE ROUGE</h5>
        <p style="margin-bottom: 0; color:#969696; font-weight:200;">Lorem ipsum sit dolor amet</p>
        <p class="card-text">600DH</p>
        </div>
        <div class="addcart hidden">
          <box-icon name="cart-alt"></box-icon>
        </div>
      </div>
    </div>
    <div class="col-10 col-md-3 product mt-4 card text-center">
      <center><img class="card-img-top img-fluid mt-2" src="images/a3.png" alt="Card image cap"></center>
      <div class="card-body">
        <div class="infos">
        <h5 class="card-title">TABLE BLANC</h5>
        <p style="margin-bottom: 0; color:#969696; font-weight:200;">Lorem ipsum sit dolor amet</p>
        <p class="card-text">800DH</p>
        </div>
        <div class="addcart hidden">
          <box-icon name="cart-alt"></box-icon>
        </div>
      </div>
    </div>
    <div class="col-10 col-md-5 product mt-4 card text-center">
      <center><img class="card-img-top img-fluid mt-2" src="images/a4.jpg" alt="Card image cap"></center>
      <div class="card-body">
        <div class="infos">
        <h5 class="card-title">CABINET</h5>
        <p style="margin-bottom: 0; color:#969696; font-weight:200;">Lorem ipsum sit dolor amet</p>
        <p class="card-text">500DH</p>
        </div>
        <div class="addcart hidden">
          <box-icon name="cart-alt"></box-icon>
        </div>
      </div>
    </div>
    <div class="col-10 col-md-3 product mt-4 card text-center">
      <center><img class="card-img-top img-fluid mt-2" src="images/a5.jpg" alt="Card image cap"></center>
      <div class="card-body">
        <div class="infos">
        <h5 class="card-title">LAPIN LAMPE</h5>
        <p style="margin-bottom: 0; color:#969696; font-weight:200;">Lorem ipsum sit dolor amet</p>
        <p class="card-text">100DH</p>
        </div>
        <div class="addcart hidden">
          <box-icon name="cart-alt"></box-icon>
        </div>
      </div>
    </div>
    <div class="col-10 col-md-3 product mt-4 card text-center">
      <center><img class="card-img-top img-fluid mt-2" src="images/a6.jpg" alt="Card image cap"></center>
      <div class="card-body">
        <div class="infos">
        <h5 class="card-title">COFFRE AU TRÉSOR</h5>
        <p style="margin-bottom: 0; color:#969696; font-weight:200;">Lorem ipsum sit dolor amet</p>
        <p class="card-text">900DH</p>
        </div>
        <div class="addcart hidden">
          <box-icon name="cart-alt"></box-icon>
        </div>
      </div>
    </div>
    <div class="col-10 col-md-3 product mt-4 card text-center">
      <center><img class="card-img-top img-fluid mt-2" src="images/a7.jpg" alt="Card image cap"></center>
      <div class="card-body">
        <div class="infos">
        <h5 class="card-title">BUREAU ENFANT</h5>
        <p style="margin-bottom: 0; color:#969696; font-weight:200;">Lorem ipsum sit dolor amet</p>
        <p class="card-text">400DH</p>
        </div>
        <div class="addcart hidden">
          <box-icon name="cart-alt"></box-icon>
        </div>
      </div>
    </div>
    <div class="col-10 col-md-3 product mt-4 card text-center">
      <center><img class="card-img-top img-fluid mt-2" src="images/a8.png" alt="Card image cap"></center>
      <div class="card-body">
        <div class="infos">
        <h5 class="card-title">MINI KITCHEN</h5>
        <p style="margin-bottom: 0; color:#969696; font-weight:200;">Lorem ipsum sit dolor amet</p>
        <p class="card-text">4500DH</p>
        </div>
        <div class="addcart hidden">
          <box-icon name="cart-alt"></box-icon>
        </div>
      </div>
    </div>
    <div class="col-10 col-md-5 product mt-4 card text-center">
      <center><img class="card-img-top img-fluid mt-2" src="images/a9.jpg" alt="Card image cap"></center>
      <div class="card-body">
        <div class="infos">
        <h5 class="card-title">MACHINE À CAFÉ</h5>
        <p style="margin-bottom: 0; color:#969696; font-weight:200;">Lorem ipsum sit dolor amet</p>
        <p class="card-text">1600DH</p>
        </div>
        <div class="addcart hidden">
          <box-icon name="cart-alt"></box-icon>
        </div>
      </div>
    </div>
  </div>
</div>



<?php include_once('footer.php')?>
