<?php include_once('header.php') ?>
<?php
    if (isset($_SESSION['user'])) {
        header('location: index.php');
    }
    if (isset($_POST['user'])) {
        if ($_POST['user'] == 'othman' && $_POST['pass'] == 'password') {
            if (!isset($_SESSION['loginc'])) {
                $_SESSION['loginc'] = 0;
            }else {
                $count = (int)$_SESSION['loginc'];
                $count++;
                $_SESSION['loginc'] = $count;
            }
            $_SESSION['user'] = $_POST['user'];
            header('location: index.php');
        }
    }
?>

<div class="container">
    <div class="row">
        <div class="col-6 mx-auto text-center" id="loginf">
        <form class="form-signin" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h3 class="mt-5">Please sign in</h3>
            <hr/>
            <input type="text" name="user" class="form-control" placeholder="Username" required autofocus>
            <input type="password" name="pass" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
        </div>
    </div>
</div>

<?php include_once('footer.php')?>