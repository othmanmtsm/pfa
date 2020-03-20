<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ecommerce</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="css/iziToast.min.css">

</head>

<body>

    <div class="d-flex" id="wrapper">
        <div class="border-right position-fixed" id="sidebar-wrapper">
            <div id="sidebar" class="list-group list-group-flush">
                <a href="index.php" class="list-group-item-action text-center">
                    <box-icon name='home-alt'></box-icon>
                </a>
                <a href="commandes.php" class="list-group-item-action text-center">
                     <box-icon name='shopping-bag'></box-icon>
                </a>
                <?php
                    $page = basename($_SERVER['PHP_SELF']);
                    if ($page != "checkout.php") {
                        echo '
                            <a id="cart-toggle" href="#" class="list-group-item-action text-center">
                            <box-icon name="cart-alt"></box-icon><img src="images/bluecir.png" id="cartnot">
                            </a>
                        ';
                    }
                    if (isset($_SESSION['user'])) {
                        echo "<a href='logout.php' id='lo' class='list-group-item-action text-center'><box-icon name='log-out' ></box-icon></a>";
                    } else {
                        echo '<a href="login.php" class="list-group-item-action text-center"><box-icon name="user" ></box-icon></a>';
                    }
                    ?>
            </div>
        </div>
        <?php
            if ($page == "index.php") {
                $content = "";
                // if (isset($_SESSION['cart'])) {
                //     $data = json_decode($_COOKIE['cart'],true);
                //     foreach($data as $i){
                //         $img = $i['img'];
                //         $name = $i['name'];
                //         $qte = $i['qte'];
                //         $prc = $i['price'];
                //         //$content = "<li><img width='50' src='$img'/>$name<box-icon onclick='minusHandler(this)' class='minus float-right' type='solid' name='minus-square'></box-icon><box-icon onclick='plusHandler(this)' class='plus float-right' name='plus-square' type='solid' ></box-icon><span id='nbI' class='badge badge-light badge-pill'>$qte</span><p class='mt-3 float-right badge badge-light'>x $prc</p></li>";
                //     }
                // }
                $html = "
                <div id='cart' class='cart-toggled position-fixed'>
                    <h2 class='mt-2'>CART</h2>
                    <hr/>
                    <ul id='cartL' class='list-group'>
                        $content
                    </ul>
                    <button id='cou' class='btn btn-light btn-lg btn-block mt-5 mb-4'>VIEW CART</button>
                </div>
                ";
                echo $html;
            }
            
        ?>
        
        <div id="page-content-wrapper">
            <div class="container-fluid">