<?php

    class Subcat extends EMongoEmbeddedDocument
    {

        public $subcategory;
        public $description;
        public $scode;
        public $timestamp;
  
        public function rules()
        {
            return array(
                array('subcategory,description,scode','required'),
                array('timestamp', 'default', 'value' => new MongoDate()),
                array('scode', 'length', 'max' => 6)

            );
          
        }

    }

    
?>