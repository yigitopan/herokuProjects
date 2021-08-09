<?php
$url = 'https://jsonplaceholder.typicode.com/posts';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$data2 = array(
    'userId' => 'codexworld',
    'id' => '123456',
    'title' => '123456',
    'body' => '1233456'
);
$payload = json_encode(array("post" => $data2));

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);


$data = file_get_contents('https://jsonplaceholder.typicode.com/posts');
$json_arr = json_decode($data, true);
$titleId = 0;
unset($json_arr[35]);
foreach ($json_arr as $key => $value){
    $out=$value["title"];
    echo "title $titleId :".$out ."<br/>";
    $titleId++;
}
echo "deneme";
?>