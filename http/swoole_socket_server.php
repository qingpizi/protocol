<?php

use Swoole\Coroutine\Socket;
use function Swoole\Coroutine\run;

run(function (){
    $socket = new Socket(AF_INET, SOCK_STREAM);

    $socket->bind('127.0.0.1', 9501);

    $socket->listen();

    while ($socket) {

        $connection = $socket->accept();

        $request = $connection->recv();

        $content = "HTTP/1.1 200 OK\r\nContent-Type: text/plain; charset=utf-8\r\nServer: swoole-http-server\r\n\r\nHello World\n";

        $connection->send($content);
        $connection->close();
        var_dump($request);
    }


});