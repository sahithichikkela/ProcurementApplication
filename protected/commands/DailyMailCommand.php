<?php

class DailyMailCommand extends CConsoleCommand
{

    public function run($params)
    {

		$ses = new Aws\Ses\SesClient([
			'version' => 'latest', 
            'region' => 'ap-south-1',
			'credentials' => [
				'key' => 'aaa',
                'secret' => 'xxx',
			],
          
		]);
        
		$model= new Inventory;


        $data=$model->findAll();

        foreach ($data as $item) {
            if ($item->available < 40) {
		
		$emailParams = array(
			'Source' => 'iamsahithirao@gmail.com', 
			'Destination' => array(
				'ToAddresses' => array('reallysahithi@gmail.com'), 
			),
			'Message' => array(
				'Subject' => array(
					'Data' => ' Low Stock alert!!',
					'Charset' => 'UTF-8',
				),
				'Body' => array(
					'Html' => array(
						'Data' =>  'Your '.$item->product_name.' stock levels are reducing!! Please notice that your stock levels have reduced, to keep alloting and get out of last minute struggles, please restock the following asset!!' .$item->product_name. 'Minimum required quantity is minimum 40 !!', // Replace with email body
						'Charset' => 'UTF-8',
					),
				),
			),
		);

		
				$result = $ses->sendEmail($emailParams);
            }
        }
		
		if ($result['MessageId']) {
			echo ("Successfully sent");
		} else {	
			echo "Failed to send email.";
		}
	
    }


}