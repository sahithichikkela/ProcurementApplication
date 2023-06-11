<?php

class AddAsset extends EMongoDocument
{
    public $asset;
    public $quantity;
    public $category;
    public $subcategory;
    public $addedby;
    public $timestamp;



    public function rules()
    {
        return array(
            array('asset,quantity,category,subcategory','required'),
            array('timestamp', 'default', 'value' => new MongoDate())
        );
        # code...
    }


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


    /**
     * @inheritDoc
     */
    public function getCollectionName()
    {
        return 'assets';
    }
}
