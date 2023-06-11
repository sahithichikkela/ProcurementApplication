<?php




// use protected\extensions\YiiMongoDbSuite\EMongoDocument;




class dbtest extends EMongoDocument




{




    public $_id;




    public $useremail;




    public $userpassword;







    public static function model($className = __CLASS__)
    {




        return parent::model($className);
    }







    /**




     * @inheritDoc




     */




    public function getCollectionName()




    {




        return 'users';
    }




    public function rules()




    {




        return array(




            array('email,password', 'required'),




            //array('personal_no', 'numeric', 'integerOnly' => true),




            array('email', 'email'),




        );
    }




    public function attributeNames()




    {




        return array(




            'email' => 'E-Mail Address',




        );
    }
}
