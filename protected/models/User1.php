<?php
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class User1 extends EMongoDocument
{
    public $email;
    public $password;
    public $status;
   
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
