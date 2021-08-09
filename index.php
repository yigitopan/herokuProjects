<?php

$url = "https://jsonplaceholder.typicode.com/posts";

$data_array = array(
    'userId' => 'John Doe',
    'id' => 'Web Devel4oper',
    'title' => 'Web Devel4oper',
    'body' => 'Web Devel4oper',
);

$data = http_build_query($data_array);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST,true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($ch);

if($e = curl_error($ch)){
    echo "hata: ".$e;
}
else {
    $decoded = json_decode($resp);
    foreach ($decoded as $key => $val){
        echo $key . ': '. $val . '<br>';
    }
}
?>