<?php

class Allotitems extends EMongoDocument
{
    public $product_name;
    public $quantity;
    public $to;
    public $purpose;
    public $timestamp;



    public function rules()
    {
        return array(
            array('product_name,purpose,quantity','required'),
            array('quantity', 'numerical', 'min' => 1),
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
        return 'alloteditems';
    }
}
