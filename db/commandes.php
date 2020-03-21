<?php include_once('header.php') ?>
<?php
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}
?>
<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h2 style="font-weight: 100;">COMMANDES</h2>
            <hr>
        </div>
        <div class="col-12">
            <table class='table mt-5 mb-5'>
                <thead>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Date</th>
                        <th scope='col'>Status</th>
                        <th scope='col'>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'db.php';
                    $stmt = $connection->query("SELECT * FROM commandes");
                    $stmt->execute();
                    while ($row = $stmt->fetch()) {
                        $cid = $row['id'];
                        $date = $row['dat'];
                        $verif = $row['isVer'] == 0 ? "Unverified" : "Verified";
                        $details = json_decode($row['detail']);
                        $usr = $row['usr'];
                        if ($usr == $_SESSION['user']) {
                            echo "
                            <tr>
                            <td>$cid</td>
                            <td>$date</td>
                            <td>$verif</td>
                            <td>
                                <box-icon data-toggle='modal' data-target='#exampleModal$cid' type='solid' name='detail'></box-icon>
                            </td>
                        </tr>
                        
                        
                        <div class='modal fade' id='exampleModal$cid' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel$cid' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLabel$cid'>Order Details</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                    <ul class='list-group'>";
                            foreach ($details as $d) {
                                echo "
                                                    <li class='list-group-item d-flex justify-content-between align-items-center'>
                                                    $d->name
                                                    <span class='badge badge-primary badge-pill'>$d->qte</span>
                                                     </li>
                                                ";
                            }


                            echo "
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                            ";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once('footer.php') ?>