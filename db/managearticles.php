<?php
    require 'db.php';
    if (isset($_GET['aid'])) {
        $sql = "UPDATE articles SET name=:nm,price=:prc,descr=:des,qte=:qt WHERE id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute([':nm'=>$_GET['artname'],':prc'=>$_GET['price'],':des'=>$_GET['desc'],':qt'=>$_GET['qte'],':id'=>$_GET['aid']]);
        header('location: dashboard.php');
    }
    if (isset($_GET['op']) && $_GET['op']=='delete') {
        $sql = "DELETE FROM articles WHERE id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute([':id'=>$_GET['id']]);
        header('location: dashboard.php');
    }
