<?php

// Set your Razorpay API credentials
$key = 'rzp_test_lhqTkgN2GgpNKr';
$secret = 'uppECfbg1QGlyxpMdlBYsH8Q';
class UserController extends Controller1
{

    public $defaultAction = "landing";
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column1', meaning
     * using two-column layout. See 'protected/views/layouts/column1.php'.
     */
    

    /**
     * @return array action filters
     */
   
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */

     private $key = 'rzp_test_lhqTkgN2GgpNKr';
     private $secret = 'uppECfbg1QGlyxpMdlBYsH8Q';

    //  public function filters()
    //  {
    //     return array('accesscontrol');
    //  }
 
 
     public function accessRules()
	{
        return array(
            array('allow',
                'expression' => function() {
                    $rolecookie=Yii::app()->request->cookies['role'];
                    $key=$rolecookie ? $rolecookie->value : null;
                    return $key=='admin';
                    
                }
            ),
            array(
                'deny',
                'users' => array('*'),
                'deniedCallback' => function () {
                    $rolecookie = Yii::app()->request->cookies['role'];
                    $key = $rolecookie ? $rolecookie->value : null;

                    
                    // Redirect to a specific URL within the current controller
                    if($key){
                        $url='index.php/'.$key.'/dashboard';
                        $this->redirect(array($url));
                    }
                    else{
                        $url='index.php/addadmin/login';
                        $this->redirect(array($url));
                    }
                    
                    Yii::app()->end();
                }
            ),
        );
    }
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */


  

  

    public function actionlanding()
    {
        $model = new Ticket;

        $result11 = Ticket::model()->startAggregation()
        
        ->addStage(['$sort' => ['priority' => 1]])
        ->aggregate();

        $this->render('landing', array('data' => $result11['result']));
    }

    public function actiontcreated()
    {
        $model = new Ticket;

        $cookie = Yii::app()->request->cookies['email'];
        if ($cookie !== null) {
            $email = urldecode($cookie->value);
        }
  
        $data = $model->findAllByAttributes(['createdby' => $email, 'onBehalf' => 'none']);
        

        $this->render('tcreated', array('data' => $data));
    }

    public function actionother()
    {
        $model = new Ticket;

        $cookie = Yii::app()->request->cookies['email'];
        if ($cookie !== null) {
            $email = urldecode($cookie->value);
        }
  
        $data = $model->findAllByAttributes(array(
            'createdby' => $email,
            'onBehalf' => array('$ne' => 'none')
        ));
        
        
        $this->render('other', array('data' => $data));
    }

    public function actiontassigned()
    {
        $model = new Ticket;

        $cookie = Yii::app()->request->cookies['email'];
        if ($cookie !== null) {
            $email = urldecode($cookie->value);
        }

        $data = $model->findAllByAttributes(['assigned_to' => $email]);

  
        $this->render('tassigned', array('data' => $data));
    }

    public function actionassigneeview($id)
    {
       
        $ticket = Ticket::model()->findByAttributes(array('id'=>$id));
    
        $this->render("assigneeview",array('data'=>$ticket));
    }

    public function actioncreatorview($id)
    {
        
        $ticket = Ticket::model()->findByAttributes(array('id'=>$id));

  
        $this->render('creatorview', array('data' => $ticket));
    }




    public function actionLogout()
    {
        
        Yii::app()->request->cookies['email'] = new CHttpCookie('email', "");
   

        Yii::app()->user->logout();
        $this->redirect('../adduser/userlogin');

    }

}


