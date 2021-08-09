<?php
$json = file_get_contents('http://localhost:3000/');
$obj = json_decode($json);
echo $obj->posts;
echo "deneme";
?>