<?php

use Swoole\Coroutine\Socket;
use function Swoole\Coroutine\run;

run(function() {

    $socket = new Socket(AF_INET, SOCK_DGRAM);

    $socket->bind('127.0.0.1', 9502);

    $socket->listen();

    while (true) {
        $peer = null;
        $data = $socket->recvfrom($peer);
        echo "[Server] recvfrom[{$peer['address']}:{$peer['port']}] : $data\n";
        $socket->sendto($peer['address'], $peer['port'], "Swoole: $data");
    }
    $socket->close();
});