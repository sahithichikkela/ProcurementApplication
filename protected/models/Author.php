<?php

class Author extends EMongoDocument
{
    public $name;
    public $books;



    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    // public function rules()
    // {
    //     return array(
    //         array('name', 'required'),
    //     );
    // }


    public function getCollectionName()
    {
        return 'author';
    }



    public function behaviors()
    {
        return array(
            'embeddedArrays' => array(
                'class' => 'ext.YiiMongoDbSuite.extra.EEmbeddedArraysBehavior',
                'arrayPropertyName' => 'books',
                'arrayDocClassName' => 'Book'
            ),
        );
    }


    public function embeddedDocuments()
    {
        return array(
            "info" => "Authorinfo",
        );
    }

    // public function beforesave(){
    //     if($this->findByAttributes(array('name'=>$_POST['author']))){
    //         return false;
    //     }
    //     return parent::beforeSave();
    // }

    // public function aftersave(){
    //     parent::afterSave();
    //     echo "Hello";
    // }

    

    public function authorname($name="Rohith3")
    {
        $this->getDbCriteria()->mergeWith(
            array(
                'conditions' => array(
                    'name' =>
                    array('equals' => $name),
                )
            )
        );
        return $this;
    }
}
