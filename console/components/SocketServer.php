<?php


namespace console\components;

use common\models\ChatLog;
use Yii;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class SocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
       $this->clients->attach($conn);
       $this->echoToClient($conn);
       echo "New connection ({$conn->resourceId}) \n";
    }

    private function echoToClient(ConnectionInterface $conn)
    {
        $conn->send(json_encode([
            'message' => 'Всем привет!',
            'username' => 'Чат',
            'date' => Yii::$app->formatter->asDatetime(time())
        ]));
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        ChatLog::saveLog($msg);
        foreach ($this->clients as $client) {
            $msg = json_decode($msg, true);
            $msg['date'] = Yii::$app->formatter->asDatetime(time());
            $msg = json_encode($msg);
            $client->send($msg);
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection ({$conn->resourceId}) closed \n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error: {$e->getMessage()} \n";
        $conn->close();
    }
}