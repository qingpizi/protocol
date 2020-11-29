<?php

use Swoole\Coroutine\Socket;

use function Swoole\Coroutine\run;

run(function (){
    $socket = new Socket(AF_INET, SOCK_DGRAM, 2);

    $retval = $socket->connect('127.0.0.1', 9502);

    if (! $retval) {
        var_dump($socket->errCode);
        exit;
    }

    $socket->send("Hello world!");

    $response = $socket->recv();

    var_dump($response);

    $socket->close();

});