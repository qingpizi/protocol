<?php

use Swoole\Coroutine\Socket;
use function Swoole\Coroutine\run;

run(function() {
    $socket = new Socket(AF_INET, SOCK_STREAM);
    $retval = $socket->connect('127.0.0.1', 9501);

    if (! $retval) {
        var_dump($socket->errCode);
        exit;
    }
    $content = "GET / HTTP/1.1\r\nHost: 127.0.0.1:9501\r\nConnection: close\r\nAccept-Encoding: br\r\n\r\n";

    $n = $socket->send($content);
    var_dump($n);

    $data = $socket->recv();
    var_dump($data);
    $socket->close();
});






