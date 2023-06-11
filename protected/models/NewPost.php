<?php

class NewPost extends EMongoDocument
{
    public $id;
    public $product_name;
    public $description;
    public $quantity;
    public $category;
    public $addedby;
    public $timestamp;
    public $location;
    public $price;
    public $discount;
    public $photo;
    public $orders=[];


    public function rules()
    {
        return array(
            array('product_name,quantity,category,price,discount','required'),
            array('quantity', 'numerical', 'integerOnly' => true),
            array('id, product_name, description, category, addedby, location, price, photo', 'length', 'max' => 255),
            array('discount', 'numerical', 'min' => 0, 'max' => 100),
            array('quantity', 'numerical', 'min' => 1),
            array('timestamp', 'default', 'value' => new MongoDate()),
            array('orders', 'safe'),
        );
        # code...
    }


    public function behaviors(){

   return array(

    array(

     'class'=>'ext.YiiMongoDbSuite.extra.EEmbeddedArraysBehavior',

     'arrayPropertyName'=>'orders', 
     'arrayDocClassName'=>'OrdersEmbedded' 

    ),

   );

  }
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


    // public function beforeSave()
    // {

    //     $this->save();
    //     return parent::beforeSave();
        
    // }


    // public function afterSave()
    // {
    //     parent::afterSave();
 
    //     Yii::app()->swiftMailer->send('notsahithi@gmail.com',"New product added",'New product saved');
    // }

    /**
     * @inheritDoc
     */
    public function getCollectionName()
    {
        return 'adsPosted';
    }
}
