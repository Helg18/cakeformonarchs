<?php
$numero = $_POST["numero"];
$filenameArray = [];
$handle = opendir(dirname(realpath(__FILE__)).'/carrusel/'.$numero.'');
        while($file = readdir($handle)){
            if($file !== '.' && $file !== '..'){
                array_push($filenameArray, "$file");
            }
        }
echo json_encode($filenameArray);
?>