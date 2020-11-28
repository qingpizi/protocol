<?php

use Swoole\Http\Server;

//高性能HTTP服务器
$http = new Server("127.0.0.1", 9501);

$http->on("start", function ($server) {
    echo "Swoole http server is started at http://127.0.0.1:9501\n";
});

$http->on("request", function ($request, $response) {
    $response->header("Content-Type", "text/plain;");
    $response->end("Hello World\n");
});

$http->start();