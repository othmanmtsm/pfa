<?php
    $data = [];
    if (isset($_GET['id'])) {
        if (($file = fopen('commandes.csv','a+'))!=false) {
            while ($line = fgetcsv($file,1000,',')) {
                $data[] = $line;
            }
            if ($_GET['op']=='accept') {
                foreach ($data as $item) {
                    if ($item[0]==$_GET['id']) {
                        $data[array_search($item,$data)][3] = '1';
                    }
                }
            }else if ($_GET['op']=='deny') {
                foreach ($data as $item) {
                    if ($item[0]==$_GET['id']) {
                        $data[array_search($item,$data)][3] = '-1';
                    }
                }
            }
            
        }
        if (($file1 = fopen('commandes.csv','w'))!=false) {
            foreach ($data as $item) {
                fputcsv($file1,$item);
            }
        } 
        header('location: dashboard.php');  
    }
