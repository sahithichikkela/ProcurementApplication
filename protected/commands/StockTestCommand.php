<?php
require_once('/data/live/vendor/autoload.php');
require_once('/data/live/vendor/swiftmailer/swiftmailer/lib/swift_required.php');
// require_once('/data/live/vendor/swiftmailer/swiftmailer/lib/swift_init.php');
class StockTestCommand extends CConsoleCommand
{

    public function run($params)
    {
        echo "Hello\n";
        
        $model= new Inventory;
        echo "Hello\n";

        $data=$model->findAll();

        foreach ($data as $item) {
            if ($item->available < 10) {
                Yii::app()->swiftMailer->send('iamsahihirao@gmail.com', 'Your '.$item->product_name.' stock levels are reducing!!','Please notice that your stock levels have reduced, to keep alloting and get out of last minute struggles, please restock the following asset!!' .$item->product_name. 'Minimum required quantity is minimum 40 !!');
            }
        }


    }
}