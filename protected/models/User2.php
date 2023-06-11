<?php
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class User2 extends EMongoDocument
{
    public $email;
    public $password;
   
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @inheritDoc
     */
    public function getCollectionName()
    {
        return 'admins';
    }
}
