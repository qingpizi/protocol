<?php

use Swoole\Coroutine\Socket;
use function Swoole\Coroutine\run;

run(function (){
    $socket = new Socket(AF_INET, SOCK_STREAM);

    $socket->bind('127.0.0.1', 9503);

    $socket->listen();

    while ($socket) {
        $connection = $socket->accept();
        $response = $connection->recv();

        $connection->send($response);
        $connection->close();
        var_dump($response);
    }


});