<?php

require __DIR__ . '/Curl.php';

$responseJson = Curl::GetString('method=get');

if (isset($responseJson['response']['message'])){
    if(Curl::GetCronTime() != ""){
        echo base64_encode($responseJson['response']['message']);
        $params = 'method=UPDATE&message=' . base64_encode($responseJson['response']['message']);

        echo "<pre>";
        print_r(Curl::GetString($params));
        echo "</pre>";
    }
} else {
    echo 'Увы, что-то пошло не так...';
}

