<?php
$json = file_get_contents('http://localhost:3000/');
$obj = json_decode($json, true);
foreach ($obj as $key => $value){
    $out=$value["email"];
    echo $out ."<br/>";
}
echo "deneme";
?>