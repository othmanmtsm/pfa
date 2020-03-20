<?php include_once('header.php') ?>
<?php
if (isset($_SESSION['user'])) {
    header('location: index.php');
}
if (isset($_POST['user'])) {
    if (($file = fopen('users.csv', 'r')) != false) {
        while ($line = fgetcsv($file, 1000, ',')) {
            if ($_POST['user'] == $line[1] && $_POST['pass'] == $line[3]) {
                if ($line[4] == 1) {
                    if ($line[5] == 1) {
                        $_SESSION['admin'] = $line[5];
                    }
                    $_SESSION['user'] = $line[0];
                    header('location: index.php');
                }
            }
        }
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