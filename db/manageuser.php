<?php
    $data = [];
    if (isset($_GET['id'])) {
        if (($file = fopen('users.csv','a+'))!=false) {
            while ($line = fgetcsv($file,1000,',')) {
                $data[] = $line;
            }
            if ($_GET['op']=='accept') {
                foreach ($data as $item) {
                    if ($item[0]==$_GET['id']) {
                        $data[array_search($item,$data)][4] = '1';
                    }
                }
            }else if ($_GET['op']=='deny') {
                foreach ($data as $item) {
                    if ($item[0]==$_GET['id']) {
                        unset($data[array_search($item,$data)]);
                    }
                }
            }
            
        }
        if (($file1 = fopen('users.csv','w'))!=false) {
            foreach ($data as $item) {
                fputcsv($file1,$item);
            }
        }   
    }
?>