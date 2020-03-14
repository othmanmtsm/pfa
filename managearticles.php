<?php
    if (isset($_GET['aid'])) {
        $data = [];
        if (($file = fopen('articles.csv','a+'))!=false) {
            while ($line = fgetcsv($file,1000,',')) {
                $data[] = $line;
                foreach ($data as $item) {
                    if ($item[0]==$_GET['aid']) {
                        $data[array_search($item,$data)][1] = $_GET['artname'];
                        $data[array_search($item,$data)][3] = $_GET['price'];
                        $data[array_search($item,$data)][4] = $_GET['desc'];
                        $data[array_search($item,$data)][5] = $_GET['qte'];
                    }
                }
            }
        }
        if (($file1 = fopen('articles.csv','w'))!=false) {
            foreach ($data as $item) {
                fputcsv($file1,$item);
            }
        }
        header('location: dashboard.php');
    }
    if (isset($_GET['op']) && $_GET['op']=='delete') {
        $data = [];
        if (($file = fopen('articles.csv','a+'))!=false) {
            while ($line = fgetcsv($file,1000,',')) {
                $data[] = $line;
            }
        }
        foreach ($data as $item) {
            if ($item[0]==$_GET['id']) {
                unset($data[array_search($item,$data)]);
            }
        }
        if (($file1 = fopen('articles.csv','w'))!=false) {
            foreach ($data as $item) {
                fputcsv($file1,$item);
            }
        }
        header('location: dashboard.php');
    }
