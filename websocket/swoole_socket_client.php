<?php

use Swoole\Coroutine\Socket;
use function Swoole\Coroutine\run;
use Swoole\WebSocket\Frame;

run(function() {
    $socket = new Socket(AF_INET, SOCK_STREAM);
    $retval = $socket->connect('127.0.0.1', 9504);

    if (! $retval) {
        var_dump($socket->errCode);
        exit;
    }

    $content = "GET / HTTP/1.1\r\nHost: 127.0.0.1:9504\r\nConnection: Upgrade\r\nUpgrade: websocket\r\nSec-WebSocket-Version: 13\r\nSec-WebSocket-Key: wilJUU96V2VZWnlLVCJWZw==\r\nAccept-Encoding: gzip, deflate\r\n\r\n";

    $n = $socket->send($content);
    var_dump($n);
    $data = $socket->recv();
    var_dump($data);

    while (true) {
        $frame = new Frame();
        $frame->finish = true;
        $frame->opcode = WEBSOCKET_OPCODE_TEXT;
        $frame->data = "hello";
        $n = $socket->send($frame);
        var_dump($n);
        $data = $socket->recv();
        var_dump($data);
        co::sleep(0.1);
    }
    $socket->close();
});