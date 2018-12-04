<?php
/**
 * Created by PhpStorm.
 * User: sokol
 * Date: 03.12.2018
 * Time: 22:16
 */


$ch = curl_init();


curl_setopt($ch, CURLOPT_URL, 'https://syn.su/testwork.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'method=get');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, $headers);

$server_output = curl_exec($ch);

echo $server_output;

curl_close ($ch);