<?php
$json = file_get_contents('https://jsonplaceholder.typicode.com/posts');
$obj = json_decode($json, true);
foreach ($obj as $key => $value){
    $out=$value["id.,i"];
    echo $out ."<br/>";
}
echo "deneme";
?>