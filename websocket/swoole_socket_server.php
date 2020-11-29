<?php

use Swoole\Coroutine\Socket;
use function Swoole\Coroutine\run;

run(function (){
    $socket = new Socket(AF_INET, SOCK_STREAM);

    $socket->bind('127.0.0.1', 9504);

    $socket->listen();

    $connection = $socket->accept();

    $response = $connection->recv();
    var_dump($response);

    $content = "HTTP/1.1 101\r\nSwitching Protocols\r\nUpgrade: websocket\r\nConnection: Upgrade\r\nSec-WebSocket-Accept: vEurd/2zG5SNdFnO/3+g3WqlE1Y=\r\nSec-WebSocket-Version: 13\r\nServer: swoole-http-server\r\n\r\n";

    $connection->send($content);

    while (true) {
        $response = $connection->recv();
        var_dump($response);
        $connection->send("ni hao.");
        co::sleep(0.1);
    }

    $connection->close();


});