<?php

Co\run(function (){
    $cli = new Swoole\Coroutine\Http\Client('127.0.0.1', 9501);
    $cli->get('/');
    echo $cli->body;
    $cli->close();
});