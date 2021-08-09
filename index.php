<?php
$json = file_get_contents('https://jsonplaceholder.typicode.com/posts');
$obj = json_decode($json, true);
$titleId = 0;
unset($obj[35]);
foreach ($obj as $key => $value){
    $out=$value["title"];
    echo "title $titleId :".$out ."<br/>";
    $titleId++;
}
echo "deneme";
?>