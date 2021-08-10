<?php

/*               //*** POST BASLANGIC

$url = "https://jsonplaceholder.typicode.com/posts";

$data_array = array(
   'userId' => 201,
   'id' => 999,
   'title' => 'Web Devel42oper',
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

               POST BITISSS*/

/* GET START
GET BITIS */

$ch = curl_init();

$url = "https://jsonplaceholder.typicode.com/posts";

curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

$resp = curl_exec($ch);

if($e = curl_error($ch)){
    echo $e;
}
else {
    $decoded = json_decode($resp);
    print_r($decoded);
}

?>