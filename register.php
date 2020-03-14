<!-- TODO : Form validation -->
<?php include_once('header.php')?>
<?php
    if (isset($_POST['user'])){
        $data = array(uniqid(),$_POST['user'],$_POST['mail'],$_POST['pass'],0,0);
        $file = fopen('users.csv','a+');
        fputcsv($file,$data);
        fclose($file);
    }
?>
<div class="container">
    <div class="row">
        <div style="height: 500px !important;" class="col-6 mx-auto text-center" id="loginf">
        <form class="form-signin" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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