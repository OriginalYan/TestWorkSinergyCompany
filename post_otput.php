<?php
/**
 * Какая логика у всего этого...
 *
 * Есть файл с классами:
 * 1)для возврата массива данных из post запросов GetJson
 *
 * 2)для определения времени, а именно прошло ли меньше часа с момента последнего выполнения скрипта
 *
 * 3)для шифрования строки XOR методом
 *
 * Скрипт Cron-ом выполняется 1 раз в 10 минут.
 * При этом в файл cron.txt записывается время
 * последнего выполения скрипта, далее вычесляется
 * разница и ,если , прошло вемени больше часа или
 * равное часу с момента последнего выплнения, то он
 * снова делает запрос с параметрами (method=UPDATE&message=)
 *
 * Чтобы настроить выполнение крона на каждые 10 минут,
 * нужно просто настроить его на сервере, установив пакет php-5-cli и
 * почтовый клиент apt-get install mutt и набрав в crontab -e
 *
 *  #/10 # # # # /usr/bin/php -q path/to/phpscript/post_output.php > path/to/logtxt/cron.txt && mutt example@email.com -s cron-result < path/to/logtxt/cron.txt
 *
 * , тогда в случае ошибки логи будут приходить на почту.
 *
 */


require __DIR__ . '/Curl.php';

$responseJson = Curl::GetJson('method=get');
try{
    if (isset($responseJson['response']['message'])){
        if(!is_null(Curl::GetCronTime())){

            $string = $responseJson['response']['message'];
            $key = $responseJson['response']['key'];

            $params = 'method=update&message=' . base64_encode(Curl::StrToXor($string, $key));

            echo "<pre>";
            print_r(Curl::GetJson($params));
            echo "</pre>";

        } else {
            echo "Подождите...";
        }
    } else {
        throw new Exception("Не удалось получить ответ от сервера...");
    }
} catch (Exception $e){
    echo $e->getMessage();
}

