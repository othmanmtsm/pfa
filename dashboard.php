<?php include_once('header.php') ?>
<?php
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
                $data = array(uniqid(), $_POST['artname'], $fileDestination, $_POST['price'], $_POST['desc'], $_POST['qte']);
                $file = fopen('articles.csv', 'a+');
                fputcsv($file, $data);
                fclose($file);
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
                            $comp = 1;
                            if (($file = fopen('users.csv', 'r')) != false) {
                                while ($data = fgetcsv($file, 1000, ',')) {
                                    if ($data[4] == 0) {
                                        echo "
                                <tr>
                                    <th scope='row'>$comp</th>
                                    <td>$data[1]</td>
                                    <td>$data[2]</td>
                                    <td><a href='./manageuser.php?id=$data[0]&op=accept'><box-icon type='solid' name='check-square'></box-icon></a></td>
                                    <td><a href='./manageuser.php?id=$data[0]&op=deny'><box-icon name='x-square' type='solid' ></box-icon></a></td>
                                </tr>
                            ";
                                        $comp++;
                                    }
                                }
                                fclose($file);
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
                            $comp = 1;
                            if (($file = fopen('articles.csv', 'r')) != false) {
                                while ($data = fgetcsv($file, 1000, ',')) {
                                    echo "
                            <tr>
                                <th scope='row'>$comp</th>
                                <td>$data[1]</td>
                                <td><img width='70' src='$data[2]' /></td>
                                <td>$data[3]</td>
                                <td>$data[5]</td>
                                <td><a href='./managearticles.php?id=$data[0]&op=delete'><box-icon name='x-square' type='solid' ></box-icon></a><box-icon name='pencil' type='solid' data-toggle='modal' data-target='#exampleModal$comp' ></box-icon></td>
                            </tr>
                            <div class='modal fade' id='exampleModal$comp' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel$comp' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel$comp'>Modal title</h5>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div> 
                                    <div class='modal-body'>
                                        <input type='hidden' value='$data[0]' name='aid'>
                                        <input value='$data[1]' type='text' class='form-control' name='artname' placeholder='Article name' required/>
                                        
                                        <input value='$data[3]' type='number' name='price' class='form-control' placeholder='Price'>
                                        <input value='$data[5]' type='number' name='qte' class='form-control' placeholder='Quantity'>
                                        <textarea name='desc'cols='30' rows='10' placeholder='Description' class='form-control'>$data[4]</textarea>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                        <button type='button' class='btn btn-primary modf'>Save changes</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                            ";
                                    $comp++;
                                }
                                fclose($file);
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
                            if (($file = fopen('commandes.csv', 'r')) != false) {
                                $ind = 1;
                                while ($data = fgetcsv($file, 1000, ',')) {
                                    $cid = $data[0];
                                    $date = $data[2];
                                    $verif = $data[3] == 0 ? "Inverified" : "Verified";
                                    $details = json_decode($data[1]);
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
                                    $ind++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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