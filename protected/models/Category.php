<?php

class Category extends EMongoDocument
{
    
    public $category;
    public $description;
  
    public $escalate_to;
    public $code;
    public $timestamp;

    public $subcat=[];


    public function rules()
    {
        return array(
            array('category,description,code','required'),
            array('timestamp', 'default', 'value' => new MongoDate()),
            array('code', 'length', 'max' => 6)
        );
      
    }

    public function behaviors(){

        return array(
     
         array(
     
          'class'=>'ext.YiiMongoDbSuite.extra.EEmbeddedArraysBehavior',
     
          'arrayPropertyName'=>'subcat', 
          'arrayDocClassName'=>'Subcat' 
     
         ),
     
        );
     
       }

       public function embedMany() {
        return array(
            'subcat' => array('class' => 'Subcat', 'validateEmbedded' => true),
            // Other embedded relationships
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
        return 'categories';
    }
}
