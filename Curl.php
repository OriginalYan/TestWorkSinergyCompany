<?php

class Curl
{
    /**
     * @param $params
     * @param string $url
     * @return mixed
     *
     * Здесь инициализируем, далее куда,
     * даем метод пост, передаем параметры
     */

    public static function GetJson($params, $url = 'https://syn.su/testwork.php'){
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $json_out = json_decode(curl_exec($curl), true);

        curl_close($curl);

        return $json_out;
    }

    /**
     * @return array
     * функция опрделения прошло ли более часа с момента последнего выполнения скрипта
     */
    public static function GetCronTime(){

        $last_cron_time = file_get_contents('cron.txt');
        $this_time = time();

        if (($last_cron_time + 3600) <= $this_time) {
            file_put_contents('cron.txt',time());
            return array('1'=>$last_cron_time, '2'=>$this_time);
        }
    }

    /**
     * @param $string
     * @param $key
     * @return string
     *
     * Функция преобразовния строки
     */
    public static function StrToXor($string, $key){

        $outText = '';

        for($i = 0; $i < strlen($string); ) {
            for($j = 0; ($j < strlen($key) && $i < strlen($string)); $j++,$i++) {
                $outText .= $string{$i} ^ $key{$j};
            }
        }
        return $outText;
    }

}