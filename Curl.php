<?php

class Curl
{
    public static function GetString($params, $url = 'https://syn.su/testwork.php'){
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $json_out = json_decode(curl_exec($curl), true);

        curl_close($curl);

        return $json_out;
    }

    public static function GetCronTime(){

        $last_cron_time = file_get_contents('cron.txt');

        $this_time = time();

        if (($last_cron_time + 0) <= $this_time) {

            file_put_contents('cron.txt',time());

            return array('1'=>$last_cron_time, '2'=>$this_time);
        }
    }

}