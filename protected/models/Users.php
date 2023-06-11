<?php
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
class Users extends EMongoDocument
{
    public $username;
    public $email;
    public $password;
    public $id;


    public function rules()
    {
        return array(
            array('username, email, password', 'required'),
            array('email', 'email'),
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

    public function embeddedDocuments()
    {
        return array(
            // property field name => class name to use for this embedded document
            'address' => 'UsersAddress',
        );
    }

}
