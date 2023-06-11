<?php

class RegisterAdmin extends EMongoDocument
{
    public $username;
    public $email;
    public $password;
    public $cpassword;
    public $profilepic;
    public $phone;
    public $budget;
    public $status;
    
   

    public function rules()
    {
        return array(
            array('username,email,password,cpassword,phone','required')
        );
        
    }


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function embeddedDocuments(){
        return array(
            'inventory'=>'Inventory'
        );
    }

    /**
     * @inheritDoc
     */
    public function getCollectionName()
    {
        return 'admins';
    }
}
