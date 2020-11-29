<?php

use Swoole\Coroutine\Http\Client;
use function Swoole\Coroutine\run;



run(function () {
    $client = new Client("127.0.0.1", 9504);
    $ret = $client->upgrade("/");
    if ($ret) {
        while(true) {
            $client->push("hello");
            var_dump($client->recv());
//            $client->close();
            co::sleep(0.1);
        }
    }
});