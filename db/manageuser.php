<?php
    require 'db.php';
    if (isset($_GET['id'])) {
        if ($_GET['op']=='accept') {
            $sql = "UPDATE users SET isVer=1 WHERE id=:id";
        }else if ($_GET['op']=='deny') {
            $sql = "DELETE FROM users WHERE id=:id";
        }
        $statement = $connection->prepare($sql);
        $statement->execute([':id'=>$_GET['id']]);
        header('location:dashboard.php');
    }
?>