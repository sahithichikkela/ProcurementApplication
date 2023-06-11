<?php

class Register extends EMongoDocument
{
    public $username;
    public $email;
    public $password;
    public $cpassword;
    public $profilepic;
    public $phone;
    public $status;
    public $location;
    public $token;
    public $tickets_ongoing=0;

    // public $tickets_created;
    // public $cc_me;
    // public $raised_for_others;
    // public $tickets_assigned;
    
    // public $tickets_resolved;



   

    public function rules()
    {
        return array(   
            array('username,email,password,cpassword,phone,location','required'),
            array('phone', 'match', 'pattern' => '/^[0-9]{10}$/'),
            array('email','email'),
            array('cpassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match.'),
            
    
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
        return 'users';
    }

}
