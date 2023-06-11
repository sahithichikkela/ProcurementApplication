<?php

require __DIR__ . '/../vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;


class MyWebSocketApp implements MessageComponentInterface
{
    protected $clients;
    protected $objectToConnectionMap = [];
    

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();

        $this->objectToConnectionMap = [];
    }


    public function onOpen(ConnectionInterface $conn)
    {

        $this->clients->attach($conn);


        echo "New connection! ({$conn->resourceId})\n";
    }


    public function onMessage(ConnectionInterface $from, $msg)
    {

        $data = json_decode($msg);
        // var_dump($data);
    

        if ($data->flag == 1) {

            echo $data->userid . "\n";

            $this->objectToConnectionMap[$data->userid] = $from;

            echo "user  " . $data->userid . "\n";
        } 
        else{
            
            $connection = $this->objectToConnectionMap[$data->recipientId];
            
            if ($connection) {

                echo "other user ";

                $data1 = ['message' => $data->message];

                $responseJson = json_encode($data1);

                $connection->send($responseJson);
            }
        }
    }


    public function onClose(ConnectionInterface $conn)
    {
        echo "Connection {$conn->resourceId} has disconnected\n";
    }


    public function onError(ConnectionInterface $conn, \Exception $e)
    {

        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    protected function sendToConnection($connectionId, $message)
    {
        foreach ($this->clients as $client) {
            if ($client->resourceId == $connectionId) {
                $client->send($message);
                break; 

            }
        }
    }
}





$server = IoServer::factory(


    new HttpServer(


        new WsServer(


            new MyWebSocketApp()


        )


    ),


    8083


);





$server->run();
