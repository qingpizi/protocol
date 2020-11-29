<?php

use Swoole\Coroutine\Socket;
use function Swoole\Coroutine\run;

run(function (){
    $socket = new Socket(AF_INET, SOCK_STREAM, 0);
    $retval = $socket->connect('localhost', 9503);

    if (! $retval) {
        var_dump($socket->errCode);
        exit;
    }
    $n = $socket->send("hello");
    var_dump($n);

    $data = $socket->recv();
    var_dump($data);
    $socket->close();
});