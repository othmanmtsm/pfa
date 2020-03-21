<?php include_once('header.php') ?>
<?php
require 'db.php';
if (isset($_SESSION['user'])) {
    header('location: index.php');
}
if (isset($_POST['user'])) {
    $uname = $_POST['user'];
    $pass = $_POST['pass'];

    $stmt = $connection->prepare("SELECT * FROM users WHERE username=:un");

    $stmt->execute([':un' => $uname]); 
    $user = $stmt->fetch();
    if (isset($user) and password_verify($_POST['pass'],$user['pass'])) {
        if ($user['isVer']==1) {
            if ($user['isAd']==1) {
                $_SESSION['admin'] = $user['isAd'];
            }
            $_SESSION['user'] = $user['id'];
            header('location: index.php');
        }else {
            echo 'not verified';
        }
    }else {
        echo 'error';
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-6 mx-auto text-center" id="loginf">
            <form class="form-signin" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h3 class="mt-5">Please sign in</h3>
                <hr />
                <input type="text" name="user" class="form-control" placeholder="Username" required autofocus>
                <input type="password" name="pass" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <button id='reg' class="btn btn-lg btn-primary btn-block" type="submit">Create account</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('reg').addEventListener('click', () => {
        window.location.href = 'register.php';
    });
</script>
<?php include_once('footer.php') ?>