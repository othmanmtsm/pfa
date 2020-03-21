<?php include_once('header.php') ?>
<?php
require 'db.php';
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}
if (isset($_POST['submit'])) {
    $file = $_FILES['imgu'];
    $filename = $_FILES['imgu']['name'];
    $fileTmpName = $_FILES['imgu']['tmp_name'];
    $fileSize = $_FILES['imgu']['size'];
    $fileError = $_FILES['imgu']['error'];
    $fileType = $_FILES['imgu']['type'];

    $fileExt = explode('.', $filename);
    $fileAcExt = strtolower(end($fileExt));

    $allowedExt = array('jpg', 'jpeg', 'png');
    if (in_array($fileAcExt, $allowedExt)) {
        if ($fileError === 0) {
            if ($fileSize < 5e+6) {
                $nFileName = uniqid('', true) . "." . $fileAcExt;
                $fileDestination = 'images/' . $nFileName;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = 'insert into articles(name,img,price,descr,qte) values(:n,:im,:prc,:desc,:qt)';
                $statement = $connection->prepare($sql);
                $statement->execute([':n'=>$_POST['artname'],':im'=>$fileDestination,':prc'=>$_POST['price'],':desc'=>$_POST['desc'],':qt'=>$_POST['qte']]);
            } else {
                echo "file too large";
            }
        } else {
            echo "error uploading";
        }
    } else {
        echo "error";
    }
}
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-2">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-users-list" data-toggle="list" href="#list-users" role="tab" aria-controls="users">Manage users</a>
                <a class="list-group-item list-group-item-action" id="list-article-list" data-toggle="list" href="#list-article" role="tab" aria-controls="profile">Articles</a>
                <a class="list-group-item list-group-item-action" id="list-commandes-list" data-toggle="list" href="#list-commandes" role="tab" aria-controls="commandes">Commandes</a>
            </div>
        </div>
        <div class="col-10">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-users" role="tabpanel" aria-labelledby="list-users-list">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Accept</th>
                                <th scope="col">Deny</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $connection->query("SELECT * FROM users WHERE isVer=0");
                            $stmt->execute(); 
                            while ($row = $stmt->fetch()) {
                                echo "
                                    <tr>
                                        <th scope='row'>".$row['id']."</th>
                                        <td>".$row['username']."</td>
                                        <td>".$row['mail']."</td>
                                        <td><a href='./manageuser.php?id=".$row['id']."&op=accept'><box-icon type='solid' name='check-square'></box-icon></a></td>
                                        <td><a href='./manageuser.php?id=".$row['id']."&op=deny'><box-icon name='x-square' type='solid' ></box-icon></a></td>
                                    </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="list-article" role="tabpanel" aria-labelledby="list-article-list">

                    <!-- Button trigger modal -->
                    <box-icon style="cursor:pointer;" data-toggle="modal" data-target="#exampleModal" type='solid' name='add-to-queue'></box-icon>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add an article</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                        <input type="text" class="form-control" name="artname" placeholder="Article name" required />
                                        <div class="custom-file">
                                            <input name="imgu" id="img-inpt" type="file" class="custom-file-input" id="validatedCustomFile" required>
                                            <label class="custom-file-label" for="validatedCustomFile">Article image</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div>
                                        <input type="number" name="price" class="form-control" placeholder="Price">
                                        <input type="number" name="qte" class="form-control" placeholder="Quantity">
                                        <textarea name="desc" cols="30" rows="10" placeholder="Description" class="form-control"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Price</th>
                                <th scope="col">Availability</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $stmt = $connection->query("SELECT * FROM articles");
                            $stmt->execute(); 
                            while ($row = $stmt->fetch()) {
                                echo "
                            <tr>
                                <th scope='row'>".$row['id']."</th>
                                <td>".$row['name']."</td>
                                <td><img width='70' src='".$row['img']."' /></td>
                                <td>".$row['price']."</td>
                                <td>".$row['qte']."</td>
                                <td><a href='./managearticles.php?id=".$row['id']."&op=delete'><box-icon name='x-square' type='solid' ></box-icon></a><box-icon name='pencil' type='solid' data-toggle='modal' data-target='#exampleModal".$row['id']."' ></box-icon></td>
                            </tr>
                            <div class='modal fade' id='exampleModal".$row['id']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel".$row['id']."' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel".$row['id']."'>Modal title</h5>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div> 
                                    <div class='modal-body'>
                                        <input type='hidden' value='".$row['id']."' name='aid'>
                                        <input value='".$row['name']."' type='text' class='form-control' name='artname' placeholder='Article name' required/>
                                        
                                        <input value='".$row['price']."' type='number' name='price' class='form-control' placeholder='Price'>
                                        <input value='".$row['qte']."' type='number' name='qte' class='form-control' placeholder='Quantity'>
                                        <textarea name='desc'cols='30' rows='10' placeholder='Description' class='form-control'>".$row['descr']."</textarea>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                        <button type='button' class='btn btn-primary modf'>Save changes</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                            ";   
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="list-commandes" role="tabpanel" aria-labelledby="list-commandes-list">
                    <table class='table mt-5 mb-5'>
                        <thead>
                            <tr>
                                <th scope='col'>ID</th>
                                <th scope='col'>Date</th>
                                <th scope='col'>Status</th>
                                <th scope='col'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $connection->query("SELECT * FROM commandes WHERE isVer=0");
                            $stmt->execute(); 
                            while ($row = $stmt->fetch()) {
                                    $cid = $row['id'];
                                    $date = $row['dat'];
                                    $verif = $row['isVer'] == 0 ? "Unverified" : "Verified";
                                    $details = json_decode($row['detail']);
                                    echo "
                                        <tr>
                                        <td>$cid</td>
                                        <td>$date</td>
                                        <td>$verif</td>
                                        <td>
                                            <a href='managecomandes.php?id=$cid&op=accept'><box-icon type='solid' name='check-square'></box-icon></a>
                                            <a href='managecomandes.php?id=$cid&op=deny'><box-icon type='solid' name='x-square'></box-icon></a>
                                        </td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <canvas id="myChart"></canvas>
                    <div id="chartload" class="col-4 mx-auto text-center">
                        <img src="./images/6.gif">
                        <p>loading chart...</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script src="./chartlogic.js"></script>
<script>
    document.querySelectorAll('.modf').forEach(m => {
        m.addEventListener('click', () => {
            let aid = m.parentElement.parentElement.childNodes[3].childNodes[1].value;
            let name = m.parentElement.parentElement.childNodes[3].childNodes[3].value;
            let price = m.parentElement.parentElement.childNodes[3].childNodes[5].value;
            let qte = m.parentElement.parentElement.childNodes[3].childNodes[7].value;
            let desc = m.parentElement.parentElement.childNodes[3].childNodes[9].value;

            window.location.href = `managearticles.php?aid=${aid}&artname=${name}&price=${price}&desc=${desc}&qte=${qte}`;
        });
    })
</script>
<?php include_once('footer.php') ?>