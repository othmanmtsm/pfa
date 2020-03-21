<?php
    require 'db.php';
    header('Content-Type: application/json');
    $data = array();
    $stmt = $connection->query("SELECT MONTHNAME(dat) as 'month',count(*) as 'countCom' FROM commandes group by MONTHNAME(dat) order by dat asc");
    $stmt->execute(); 
    while ($row = $stmt->fetch()) {
        $data[] = $row;
    }
    print json_encode($data);
?>