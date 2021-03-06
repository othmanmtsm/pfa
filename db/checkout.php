<?php include_once('header.php') ?>
<?php
require 'db.php';
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}
if (isset($_GET['query'])) {
    $sql = "INSERT INTO commandes(detail,dat,usr) VALUES(:det,:dt,:usr)";
    $statement = $connection->prepare($sql);
    $statement->execute([':det'=>$_GET['query'],':dt'=>date("Y-m-d H:i:s"),':usr'=>$_SESSION['user']]);
    header('location:commandes.php');
}
?>

<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h2 style="font-weight:100;">MY CART</h2>
            <hr />
        </div>
        <div class="col-12 col-md-8 product-cl">
            <?php
            $count = 0;
            $total = 0;
            if (isset($_GET['json'])) {
                //setcookie('cart',$_GET['json'],time()+3600);
                $data = json_decode($_GET['json'], true);
                foreach ($data as $i) {
                    $img = $i['img'];
                    $name = $i['name'];
                    $qte = $i['qte'];
                    $prc = $i['price'];
                    echo "
                <div class='col-12 itms mt-2 d-flex justify-content-around'>
                    <img class='mt-3' width='70' src='$img'/>
                    <p style='margin-top:40px;'>$name</p>
                    <box-icon style='margin-top:43px;' onclick='minusHandler(this)' class='minus float-right' type='solid' name='minus-square'></box-icon><box-icon style='margin-top:43px;' onclick='plusHandler(this)' class='plus float-right' name='plus-square' type='solid' ></box-icon><span style='margin-top:43px;' id='nbI' class='badge'>$qte</span>
                    <p style='margin-top:35px; padding-top:15px;' class='float-right badge badge-light'>$prc DH</p>
                </div>
                ";
                    $count++;
                    $total += (float)$prc * (float)$qte;
                }
            }

            ?>
        </div>
        <div class="col-12 col-md-3 cl mt-2">
            <div class="summary">
                <?php
                echo "<h3>$count items in cart</h3>
                <div class='summary-item'><span class='text'>Subtotal</span><span class='price tot'>$total DH</span></div>
                <div class='summary-item'><span class='text'>Discount</span><span class='price'>0</span></div>
                <div class='summary-item'><span class='text'>Shipping</span><span class='price'>0</span></div>
                <div class='summary-item'><span class='text'>Total</span><span class='price tot'>$total DH</span></div>
                <button id='chout' type='button' class='btn btn-primary btn-lg btn-block'>Checkout</button>"
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    let getPrice = () => {
        let total = 0;
        document.querySelectorAll('.itms').forEach(i => {
            let price = i.childNodes[9].innerText;
            let p = price.substr(0, price.length - 2);
            let qte = i.childNodes[7].innerText;
            total += parseFloat(p) * parseInt(qte);
        });
        document.querySelectorAll('.tot').forEach(t => {
            t.innerText = total + " DH";
        })
        document.getElementById('chout').innerText = 'Checkout';
    };

    document.querySelectorAll('.minus').forEach(m => {
        m.addEventListener('click', () => {
            document.getElementById('chout').innerText = 'Update';
            document.getElementById('chout').addEventListener('click', () => {
                getPrice();
            });
        })
    });
    document.querySelectorAll('.plus').forEach(m => {
        m.addEventListener('click', () => {
            document.getElementById('chout').innerText = 'Update';
            document.getElementById('chout').addEventListener('click', () => {
                getPrice();
            });
        })
    });
    document.getElementById('chout').addEventListener('click', () => {
        if (document.getElementById('chout').innerText == 'Checkout') {
            let total = 0;
            let index = 1;
            let query = '{';
            document.querySelectorAll('.itms').forEach(i => {
                ;
                let name = i.childNodes[3].innerText;
                let img = i.childNodes[1].src;
                let price = i.childNodes[9].innerText;
                let p = price.substr(0, price.length - 2);
                let qte = i.childNodes[7].innerText;
                total += parseFloat(p) * parseInt(qte);
                if (index == document.querySelectorAll('.itms').length) {
                    query += `"item${index}":{"name":"${name}","img":"${img}","price":"${p}","qte":"${qte}"}`;
                } else {
                    query += `"item${index}":{"name":"${name}","img":"${img}","price":"${p}","qte":"${qte}"},`;
                }

                index++;
            });
            query += '}';
            window.location.href = `checkout.php?query=${encodeURI(query)}`;
        }
    })
</script>





<?php include_once('footer.php') ?>