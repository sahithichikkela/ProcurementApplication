<?php

    class Embedded extends EMongoEmbeddedDocument
    {

        public $country;
        public $pincode;
        public $district;
        public $state;
  
        public function rules()
        {
            return array(
                array('country,pincode,district,state','required')
            );
          
        }

    }

    
?>