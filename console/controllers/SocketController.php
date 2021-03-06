<?php


namespace console\controllers;


use console\components\SocketServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use yii\console\Controller;

class SocketController extends Controller
{
    public function actionStart($port = 8080)
    {
        $server = IoServer::factory(new HttpServer(new WsServer(new SocketServer())), $port);
        echo "Server started \r\n";
        $server->run();
        echo "Server stopped \r\n";
    }
}