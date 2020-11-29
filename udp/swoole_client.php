<?php

use function Swoole\Coroutine\run;

run(function (){
    $client = new Swoole\Coroutine\Client(SWOOLE_SOCK_UDP);
    if (!$client->connect('127.0.0.1', 9502, 0.5))
    {
        echo "connect failed. Error: {$client->errCode}\n";
    }
    $client->send("hello world\n");
    echo $client->recv();
    $client->close();
});