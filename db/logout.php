<?php
    session_start();
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
        unset($_SESSION['loginc']);
        session_destroy();
        header('location: index.php');
    }
?>