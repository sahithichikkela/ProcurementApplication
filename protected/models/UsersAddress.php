<?php 
class UsersAddress extends EMongoEmbeddedDocument
{
    // public $apartment;
    // public $house;
    public $street;
    public $city;
    // public $zip;
 
    // We may define rules for embedded document too
    public function rules()
    {
        return array(
            // array('apartment, house, street, city, zip', 'safe'),
            // ...
        );
    }
 
    // And attribute names too
    // public function attributeNames() { /* ... */ }
 
    // NOTE: for embedded documents we do not define static model method!
    //       we do not define getCollectionName method either.
}