<?php

class Myorders extends EMongoDocument
{
    public $id;
    public $product_name;
    public $quantity;
    public $category;
    public $subcategory;
    public $vendor;
    public $timestamp;
    public $amountpaid;
    public $photo;
    public $paymentid;
    public $deliveryexp;
    



    public function rules()
    {
        return array(
            
            array('timestamp', 'default', 'value' => new MongoDate())
        );
        
    }


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

   

    /**
     * @inheritDoc
     */
    public function getCollectionName()
    {
        return 'myorders';
    }
}
