<?php

use Aws\Sqs\SqsClient;

class SqsWrapper 
{
    private $client;

    public function __construct()
    {
        $this->client = new SqsClient([
            'region' => 'ap-south-1', // Replace with your desired region
            'version' => 'latest',
            'credentials' => [
               
			'key' => 'aa',
			'secret' => 'xxx',
            ],
        ]);
    }

    public function sendMessage($queueUrl, $message, $messageGroupId)
    {
        $response=$this->client->sendMessage([
            'QueueUrl' => $queueUrl,
            'MessageBody' => $message,
            'MessageGroupId' => $messageGroupId,
            // 'MessageAttributes' => [
            //     'MessageGroupId' => [
            //         'DataType' => 'String',
            //         'StringValue' => $messageGroupId,
            //     ],
            // ],
            // 'MessageDeduplicationId' => $messageDeduplicationId,
        ]);
    
        return $response['MessageId'];
    }
        
  
    public function displayMessagesByGroupId($queueUrl, $messageGroupId)
    {
        $result = $this->client->receiveMessage([
            'QueueUrl' => $queueUrl,
            'MaxNumberOfMessages' => 10,
        ]);
        echo '<pre>';
        var_dump($result);
        // $messages = $result->get('Messages');
    
        // foreach ($messages as $message) {
        //     $messageAttributes = $message['MessageAttributes'] ?? [];
        //     $groupIdAttribute = $messageAttributes['MessageGroupId'] ?? null;
        //     $groupId = $groupIdAttribute['StringValue'] ?? null;
    
        //     if ($groupId === $messageGroupId) {
        //         // Process the message
        //         $messageId = $message['MessageId'];
        //         $messageBody = $message['Body'];
    
        //         // Process the message further as needed
        //         echo "Message ID: $messageId, Body: $messageBody\n";
        //     }
        // }
        
    }
    

    // public function displayMessagesByGroupId($queueUrl, $messageGroupId)
    // {
    //     $response = $this->client->receiveMessage([
    //         'QueueUrl' => $queueUrl,
    //         'MaxNumberOfMessages' => 10,
    //     ]);
    
    //     $messages = $response['Messages'] ?? [];
    
    //     foreach ($messages as $message) {
    //         echo "Message ID: " . $message['MessageId'] . "\n";
    //         echo "Message Body: " . $message['Body'] . "\n";
    //         echo "-------------------\n";
    //     }
    // }
    
    
    

    public function receiveAndProcessMessage($queueUrl)
    {
        $response = $this->client->receiveMessage([
            'QueueUrl' => $queueUrl,
            'MaxNumberOfMessages' => 5,
        ]);

        $messages = $response['Messages'] ?? null;
        if ($messages !== null) {
            foreach ($messages as $message) {
                // Process the message
                $messageBody = $message['Body'];

                // Delete the message from the queue
                $this->client->deleteMessage([
                    'QueueUrl' => $queueUrl,
                    'ReceiptHandle' => $message['ReceiptHandle'],
                ]);
            }
        }
    }
}
