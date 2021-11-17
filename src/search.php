<?php
    function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);
    
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                getDirContents($path, $results);
            }
        }
        return $results;
    }
    $resultPath = array();
    $dirContents = getDirContents("./");
    foreach ($dirContents as $key => $value) {
        if(strpos($value, $_GET["q"])!==false){
            $resultPath[count($resultPath)] = str_replace("/var/www/html","",$value);
        }
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($resultPath);
?>