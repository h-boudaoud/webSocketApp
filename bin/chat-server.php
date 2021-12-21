<?php

use App\Server\ChatApp;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/src/server/ChatApp.php';
const PORT= 3001;
$server = IoServer::factory(

    new HttpServer(
        new WsServer(
            new ChatApp()
        )
    ),
    PORT
);

echo "open webSocketApp server  on : http://127.0.0.1:".PORT."\n\r";
$server->run();