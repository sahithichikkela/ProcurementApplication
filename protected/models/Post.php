<?php
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Post extends EMongoDocument
{
    // public $name;
    public $postedby;
    public $posttext;
    public $name;
    public $url;



    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @inheritDoc
     */
    public function getCollectionName()
    {
        return 'userposts';
    }
}
