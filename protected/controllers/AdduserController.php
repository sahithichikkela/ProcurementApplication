<?php
use \Firebase\JWT\JWT;

class AdduserController extends Controller2
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	

	/**
	 * @return array action filters
	 */

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
						
						return $key!='admin' and $key!='vendor';
						
					}
				),
					array('deny','users'=>array('*'),
					'deniedCallback' => function () {
						$rolecookie = Yii::app()->request->cookies['role'];
						$key = $rolecookie ? $rolecookie->value : null;

						$url='index.php/'.$key.'/dashboard';
							$this->redirect(array($url));
						
					
						Yii::app()->end();
					}
				)
		 );
	 }


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */



	 public function actionUserregister()
{
    $model = new Register;

    if (isset($_POST['ajax']) && $_POST['ajax'] === 'register-form') {
        echo CActiveForm::validate($model);
        Yii::app()->end();
    }


    if (isset($_POST['Register'])) {
        $token = Yii::app()->security->generateRandomString(32);
        $model->username = $_POST["Register"]["username"];
        $model->email = $_POST["Register"]["email"];
        $model->password = crypt($_POST["Register"]["password"], Yii::app()->params['password_salt']);
        $model->cpassword = crypt($_POST["Register"]["cpassword"],Yii::app()->params['password_salt']);
        $model->phone = $_POST["Register"]["phone"];
        $model->profilepic = "https://p.kindpng.com/picc/s/252-2524695_dummy-profile-image-jpg-hd-png-download.png";
        $model->status = "active";
        $model->location = $_POST["Register"]["location"];
        $model->token = $token;

        try {
            if ($model->save()) {
                Yii::app()->swiftMailer->send($model->email, 'Thank you for registering, please click on the link', 'http://localhost/index.php/addvendor/verify?token=' . $token);
                $model->unsetAttributes();

                $this->redirect("userlogin", array('model' => $model));
                exit;
            } else {
                echo "not saved";
            }
        } catch (EMongoException $e) {
            if ($e->getCode() === 11000) { 
                $model->addError('email', 'This email is already registered.');
            } else {
                throw $e; 
            }
        }
    }

    $this->render('userregister', array('model' => $model));
}

	 public function actionVerify($token){
		$model=new Register;

		$data=$model->findByAttributes(['token'=>$token]);
		if($data){
			$data->status='active';
			$data->save();
			Yii::app()->swiftMailer->send($data->email, 'Account activation successful !','Thank you for registering, your account is now activated');
               
		}
		$this->redirect('login');
	 }

     public function actionUserlogin()
	{
		$model=new LoginForm;
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}


		if(isset($_POST['LoginForm']))
		{

			$model->password=$_POST["LoginForm"]["password"];
			$model->email=$_POST["LoginForm"]["email"];
			
			if($model->validate() && $model->login())
			{
				$cookie = new CHttpCookie('email', $model->email);
                Yii::app()->request->cookies['email'] = $cookie;
				
				$rolecookie = new CHttpCookie('role', 'vendor');
                Yii::app()->request->cookies['role'] = $rolecookie;
             
				
				$this->redirect('../user/landing');
                exit;
 
			}
            else{
				$model->unsetAttributes();
                $this->render('userlogin',array('model'=>$model));
				echo "<script>alert('Your account is not activated, please check mail for activation link');</script>";
                exit;
            }
		}
		
		// display the login form
		$this->render('userlogin',array('model'=>$model));
        
	}

    public function actionLogout()
	{
		
		 Yii::app()->request->cookies['email'] = new CHttpCookie('email', "");
		 Yii::app()->request->cookies['role'] = new CHttpCookie('role', "");
		
		Yii::app()->user->logout();
        $this->redirect('../adduser/userlogin');
		

	}
}
