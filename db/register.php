<!-- TODO : Form validation -->
<?php include_once('header.php')?>
<?php
    require 'db.php';
    if (isset($_POST['user'])){
        $uname = $_POST['user'];
        $mail = $_POST['mail'];
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $sql = 'insert into users(username,mail,pass) values(:un,:ml,:ps)';
        $statement = $connection->prepare($sql);
        $statement->execute([':un'=>$uname, ':ml'=>$mail, ':ps'=>$pass]);
    }
?>
<div class="container">
    <div class="row">
        <div style="height: 500px !important;" class="col-6 mx-auto text-center" id="loginf">
        <form class="form-signin" method="POST">
            <h3 class="mt-5">Register</h3>
            <hr/>
            <input type="text" name="user" class="form-control" placeholder="Username" required autofocus>
            <input type="email" name="mail" class="form-control" placeholder="Username" required autofocus>
            <input type="password" name="pass" class="form-control" placeholder="Password" required>
            <input type="password" name="passC" class="form-control" placeholder="Confirm password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
        </form>
        </div>
    </div>
</div>
<?php include_once('footer.php');?>