<?php

    class Inventory extends EMongoDocument
    {
        public $id;
        public $total_purchased;
        public $product_name;
        public $alloted;
        public $available;
        public $photo;
  

        public static function model($className = __CLASS__) {
            return parent::model($className);
        }

        
        public function getCollectionName()
        {
            return 'inventory';
        }

    }


    
?>