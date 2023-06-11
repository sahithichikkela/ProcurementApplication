<?php

class Ticket extends EMongoDocument
{
    public $id;
    public $title;
    public $description;
    public $priority;
    public $category;
    public $subcategory;
    public $createdby;
    public $onBehalf='none';
    public $sla=0;
    public $assigned_to;
    public $comments=[];
    public $status; 
    public $escalated_to="none";
    public $timestamp;



    public function rules()
    {
        return array(
            array('title,description,priority','required'),
            array('timestamp', 'default', 'value' => new MongoDate())
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
        return 'tickets';
    }
}
