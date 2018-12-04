<?php
/**
 * Created by PhpStorm.
 * User: sokol
 * Date: 03.12.2018
 * Time: 22:16
 */

function xorIt($string, $key, $type = 0)
{
    $sLength = strlen($string);
    $xLength = strlen($key);
    for($i = 0; $i < $sLength; $i++) {
        for($j = 0; $j < $xLength; $j++) {
            if ($type == 1) {
                //decrypt
                $string[$i] = $key[$j]^$string[$i];

            } else {
                //crypt
                $string[$i] = $string[$i]^$key[$j];
            }
        }
    }
    return $string;
}


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://syn.su/testwork.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'method=get');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, $headers);

$server_output = curl_exec($ch);

echo $server_output . "<br>";

$json_out = json_decode($server_output, true);

$xor_key = $json_out['response']['key'];
$string = $json_out['response']['message'];

$signal = base64_encode(xorIt($string, $xor_key));
echo $signal . PHP_EOL;

$string = xorIt(base64_decode($signal), $xor_key, 1);
echo $string . PHP_EOL;

curl_close ($ch);