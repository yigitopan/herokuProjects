<?php

$url = 'https://jsonplaceholder.typicode.com/posts';

$data_array = array(
    'userId' => 102,
    'id' => 123456,
    'title' => '123456',
    'body' => '1233456'
);
$data1 = http_build_query($data_array);

$ch = curl_init();



curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, $url);

$resp = curl_exec($ch);
if($e = curl_error($ch))
{
    echo $e."</br>";
}



$data = file_get_contents('https://jsonplaceholder.typicode.com/posts');
$json_arr = json_decode($data, true);
$titleId = 0;
foreach ($json_arr as $key => $value){
    $out=$value["title"];
    echo "title $titleId :".$out ."<br/>";
    $titleId++;
}
echo "deneme";
?>