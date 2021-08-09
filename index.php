<?php
$json = file_get_contents('http://localhost:3000/posts');
$obj = json_decode($json, true);
foreach ($obj as $key => $value){
    $out=$value["id"];
    echo $out ."<br/>";
}
echo "deneme";
?>