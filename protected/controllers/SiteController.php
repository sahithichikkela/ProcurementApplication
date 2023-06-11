<?php
// Start the session
session_start();


?>
<?php
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;
use Beta\Microsoft\Graph\Model\ChatMessage;
use Aws\Sns\SnsClient;

require_once '/data/live/protected/modules/aws/models/S3demo.php';
require_once '/data/live/protected/modules/aws/components/helpers/S3helper.php';
require_once '/data/live/protected/components/SqsWrapper.php';
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	

	 public function filters()
	 {
		return array('accesscontrol');
	 }


	 public function accessRules()
	 {
		 return array(
			 array(
				 'deny',  // deny all users
				 'actions'=>['view','userposts','profedit','logout','post'],
				 'users' => array('?'),
				 'deniedCallback'=>function(){
					$url=Yii::app()->createUrl('index.php/site/login');
					Yii::app()->request->redirect($url);
				 }

			 ),
		);
	}
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionTest(){
		$model = new dbtest();
		$data = $model->findByAttributes(['message'=>"hi"]);
		print_r($data);
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'


		// try {
		// 	$jwt = Yii::app()->request->cookies['jwt']->value;
		// 	$jwtSecret = Yii::app()->params['jwtSecret'];
		// 	$decoded_jwt = JWT::decode($jwt, 'secret_key', ['HS256']);
		// 	$user_id = $decoded_jwt->user_id;
		// 	// Perform any necessary authorization checks using the user ID
		// } catch (Exception $e) {
		// 	// The JWT is invalid or has expired, redirect the user to the login page
		// 	$this->redirect('login');
		// 	exit;				
		// }	

		

		$this->render('index');

	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		// exit("here");
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{

			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			
			if($model->validate() && $model->login())
			{
				$_SESSION["name"]=$model->username;

				$jwtSecret = Yii::app()->params['jwtSecret'];

				// Generate a new JWT
				$payload = array('user_id' => 'okok');
				$jwt = JWT::encode($payload, $jwtSecret, 'HS256');
				
				
				Yii::app()->request->cookies['jwt'] = new CHttpCookie('jwt', $jwt);

				// Set cookie options, such as expiration time and path
				Yii::app()->request->cookies['jwt']->expire = time()+3600; // expires in 1 hour
				Yii::app()->request->cookies['jwt']->path = '/';
				
				$this->redirect('index');
				exit;
				// $this->render('index',array('username'=>$model->username));
			

			}
		}
		
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	public function actionProfedit(){
		$model1=new Register;

		$model = $model1->findByAttributes(['email'=>$_SESSION["name"]]);

		if(isset($_POST['Register']))
		{
			
			// $model->attributes=$_POST['Register'];
			$model->username=$_POST["Register"]["username"];
			$model->email=$_POST["Register"]["email"];
			$model->password=$_POST["Register"]["password"];
			$model->phone=$_POST["Register"]["phone"];
			$model->gender=$_POST["Register"]["gender"];
			$model->address->country=$_POST["Register"]["address"]['country'];
			$model->address->state=$_POST["Register"]["address"]['state'];
			$model->address->district=$_POST["Register"]["address"]['district'];
			$model->address->pincode=$_POST["Register"]["address"]['pincode'];

			$s3Helper = new S3helper();
			$url=$s3Helper->putObject($_FILES['Register']['name']['photo'], $_FILES['Register']['tmp_name']['photo']);
			$model->profilepic=$url;

			// var_dump($model);
			// exit;
			if($model->save()){

				
				$this->render("profedit",array('model'=>$model));
				exit;
			}
			else {
			echo "not saved";
			}
		}

	
		$this->render('profedit',array('model'=>$model));
	}

	public function actionRegister()
	{
		$model=new Register;
		
		// collect user input data
		if(isset($_POST['Register']))
		{
			// $model->attributes=$_POST['Register'];
			$model->username=$_POST["Register"]["username"];
			$model->email=$_POST["Register"]["email"];
			$model->password=$_POST["Register"]["password"];
			$model->phone=$_POST["Register"]["phone"];
			$model->gender=$_POST["Register"]["gender"];
			$model->address->country=$_POST["Register"]["address"]['country'];
			$model->address->state=$_POST["Register"]["address"]['state'];
			$model->address->district=$_POST["Register"]["address"]['district'];
			$model->address->pincode=$_POST["Register"]["address"]['pincode'];
			$model->profilepic="https://bootdey.com/img/Content/avatar/avatar2.png";
			// var_dump($model);
			// exit;
			if($model->save()){

				$model1= new LoginForm;
				
				$this->render("login",array('model'=>$model1));
				exit;
			}
			else {
			echo "not saved";
			}
		}
		// display the login form
		$this->render('register',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		
		Yii::app()->request->cookies['jwt'] = new CHttpCookie('jwt', "");

		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);

	}


	public  function actionView()
	{

		// Verify and decode an existing JWT

		# code...
		$model=new Register;
		$users= $model->findAll();
		
		// /////for aggregation
		// $data=AggregateTest::getUserGenderCount();
		// print_r($data);

		// $data1=AggregateTest::useremailsort();
		// print_r($data1);

		$jwt = Yii::app()->request->cookies['jwt']->value;
		$jwtSecret = Yii::app()->params['jwtSecret'];
		$decoded = JWT::decode($jwt, $jwtSecret, array('HS256'));	
		$user_id = $decoded->user_id;

		// if ($user_id=="okok"){
		// 	$this->render('view',array('users'=>$users,'decoded'=>$decoded));
		// 	// $this->redirect('view',array('decoded'=>$decoded));

		// }
		// else{
			// $this->redirect('/data/live/protected/views/login');
			// exit;	
		// }
		$this->render('view',array('users'=>$users,'decoded'=>$decoded));

	}

	// public function actionAbc(){

		
	// 	$this->render("view");
	// }



	public function actionGetData()

	{
		$model=new User1;

		$cursor = $model::model()->findAll();

		$data = array();
		foreach ($cursor as $document) {

		$data[] = array(

		'email' => $document['email'],
		'password' => $document['password'],
		);
		}

		echo CJSON::encode(array('data' => $data));

	}
	
	public function actionSampleagg()
	{
		
		/////for aggregation
		$data=AggregateTest::getUserGenderCount();
		print_r($data);

		$data1=AggregateTest::useremailsort();
		print_r($data1);
	}
	




	public  function actionUserposts()
	{
		$jwt = Yii::app()->request->cookies['jwt']?Yii::app()->request->cookies['jwt']->value:"";
		
		$jwtSecret = Yii::app()->params['jwtSecret'];
		# code...
		$model=new Post;
		
		$allposts=$model->findall();
		
		////aggregationss
		
		$collection=Post::model()->getCollection();

		$result=$collection->aggregate([['$addFields' => ['length' => ['$strLenCP' => '$postedby']]], ['$match' => ['length' => ['$gt' => 5]]]]);

		echo '<pre>';

		var_dump($result->toArray());

		echo '</pre>';
		//////aggregationsend
		try {
			
			$decoded_jwt = JWT::decode($jwt, $jwtSecret, ['HS256']);
			$user_id = $decoded_jwt->user_id;
			// Perform any necessary authorization checks using the user ID
			if ($user_id=="okok"){
				return $this->render('userposts',array('allposts'=>$allposts));
			}
		} catch (Exception $e) {
			// The JWT is invalid or has expired, redirect the user to the login page
			$this->redirect('/index.php/site/login');
			exit;				
		}

		 
		// $this->renderFile("/data/live/protected/views/site/userposts.php",array('allposts'=>$allposts));

	}

	public function actionSendmsg(){
		
        $sqsWrapper = new SqsWrapper();

		
		$queueUrl = 'https://sqs.ap-south-1.amazonaws.com/075339695128/mysqs.fifo'; // Replace with your queue URL
		
		
		$message = 'Hello 111!';
		$messageGroupId = 'group1'; // Replace with your desired message group ID
		$messageDeduplicationId = uniqid(); // Generate a unique ID for each message
		$messageId = $sqsWrapper->sendMessage($queueUrl, $message, $messageGroupId);

        echo "Message sent with ID: " . $messageId;


	}
	

	public function actionRecmsg(){

        $sqsWrapper = new SqsWrapper();

		$queueUrl = 'https://sqs.ap-south-1.amazonaws.com/075339695128/mysqs.fifo'; // Replace with your queue URL
		
		$message = 'Hello 22!';
		$messageGroupId = 'group1'; // Replace with your desired message group ID
		$messageDeduplicationId = uniqid(); // Generate a unique ID for each message
		// $messageId = $sqsWrapper->sendMessage($queueUrl, $message, $messageGroupId);

        // echo "Message sent with ID: " . $messageId;
        // $sqsWrapper->sendMessage($queueUrl, $message, $messageGroupId, $messageDeduplicationId);

        // Receive and process messages
        // $sqsWrapper->receiveAndProcessMessage($queueUrl);
		$sqsWrapper->displayMessagesByGroupId($queueUrl, $messageGroupId);

	}

	public function actionCreateTopicAndSubscribe()
    {
		$awsConfig = Yii::app()->params['aws'];
        $snsClient = new Aws\Sns\SnsClient(array(
			'version' => 'latest',
            'region' => 'ap-south-1', // Replace with your desired AWS region
			'credentials' => [
				'key' => $awsConfig['key'],
				'secret' => $awsConfig['secret'],
			],
        ));

        // Create SNS topic
        $topicName = 'Notifs'; // Replace with your desired SNS topic name

        $result = $snsClient->createTopic(array(
            'Name' => $topicName,
        ));

        $topicArn = $result['TopicArn'];

        // Create SQS queue
        $sqsClient = new Aws\Sqs\SqsClient(array(
			'version' => 'latest',
            'region' => 'ap-south-1', // Replace with your desired AWS region
        ));

        // $queueName = 'mysqs.fifo'; // Replace with your desired SQS queue name

        // $result = $sqsClient->createQueue(array(
        //     'QueueName' => $queueName,
        // ));

		// var_dump($result);
        $queueUrl = 'https://sqs.ap-south-1.amazonaws.com/075339695128/mysqs.fifo';

        // Subscribe SQS queue to SNS topic
        $result = $snsClient->subscribe(array(
            'TopicArn' => $topicArn,
            'Protocol' => 'sqs',
            'Endpoint' => $queueUrl,
        ));

        // Output the topic ARN and queue URL
        echo "SNS Topic ARN: " . $topicArn . "<br>";
        echo "SQS Queue URL: " . $queueUrl;
    }

	public function actionSendEmailNotification()
	{
		$awsConfig = Yii::app()->params['aws'];
		$snsClient = new Aws\Sns\SnsClient(array(
			'version' => 'latest',
			'region' => 'ap-south-1', // Replace with your desired AWS region
			'credentials' => [
				'key' => $awsConfig['key'],
				'secret' => $awsConfig['secret'],
			],
		));

		$topicArn = 'arn:aws:sns:ap-south-1:075339695128:Notifs'; // Replace with your SNS topic ARN

		$message = array(
			'default' => 'Default email message',
			'email' => 'Hello user, greetings from aws',
			'email.subject' => 'You are recieving this email as a part of sqs and sns implementation. ',
		);

		$messageJson = json_encode($message);

		$messageGroupId = 'allnotif'; // Replace with your desired message group ID
	

		$result = $snsClient->publish(array(
			'TopicArn' => $topicArn,
			'Message' => $messageJson,
			'Subject' => 'Email message subject',
			'MessageStructure' => 'json',
		));

		echo 'Email notification sent successfully!';
	}



	public function actionSes(){

		// Create an instance of the SES client
		// Create an instance of the SES client with the specific API version
		$awsConfig = Yii::app()->params['aws'];
		$ses = new Aws\Ses\SesClient([
			'version' => 'latest', // Specify the API version here
			'region' => $awsConfig['region'],
			'credentials' => [
				'key' => $awsConfig['key'],
				'secret' => $awsConfig['secret'],
			],
		]);

// Compose the email parameters and send the email...


		// Compose the email parameters
		$emailParams = array(
			'Source' => 'iamsahithirao@gmail.com', // Replace with your sender email address
			'Destination' => array(
				'ToAddresses' => array('reallysahithi@gmail.com'), // Replace with recipient email address(es)
			),
			'Message' => array(
				'Subject' => array(
					'Data' => 'using AWS SNS', // Replace with email subject
					'Charset' => 'UTF-8',
				),
				'Body' => array(
					'Html' => array(
						'Data' => '<h1>This is the body of the email</h1><img src="https://bootdey.com/img/Content/avatar/avatar2.png">', // Replace with email body
						'Charset' => 'UTF-8',
					),
				),
			),
		);

		// Send the email
		$result = $ses->sendEmail($emailParams);

		// Check the result
		if ($result['MessageId']) {
			echo ("<script>alert('Email sent successfully!')</script>");
		} else {
			echo "Failed to send email.";
		}

		$this->redirect('/index.php/site/index');
			exit;	
	}

	public function actionTests(){
		return "hello";
	}

	public function actionGen(){
		//$api_key = 'sk-waa';

		// include_once 'user/bin/curl/curl.php';

		$statement='hello';
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.openai.com/v1/completions',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
		"model": "text-davinci-003",
		"prompt": "hello" ,
		"temperature": 0.3,
		"max_tokens": 100,
		"top_p": 1.0,
		"frequency_penalty": 0.0,
		"presence_penalty": 0.0
		}',
		
		CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer 7',
			'Content-Type: application/json'
		),
		));
		
		$response = curl_exec($curl);
		curl_close($curl);

		print_r(json_decode($response)->choices[0]->text);
	}
	

	public function actionPost()
	{
		// $jwt = Yii::app()->request->cookies['jwt']->value;
		// $jwtSecret = Yii::app()->params['jwtSecret'];
		// try {
			
		// 	$decoded_jwt = JWT::decode($jwt, $jwtSecret,, ['HS256']);
		// 	$user_id = $decoded_jwt->user_id;
		// 	// Perform any necessary authorization checks using the user ID
		// 	if ($user_id=="okok"){
		// 		$this->redirect('userposts');

		// 	}
		// } catch (Exception $e) {
		// 	// The JWT is invalid or has expired, redirect the user to the login page
		// 	$this->redirect('login');
		// 	exit;				
		// }
	
		$model=new Post;
	
		// collect user input data
		if(isset($_POST['Post']))
		{
			// $model->attributes=$_POST['Register'];
			$model->postedby=$_POST['Post']['postedby'];
			$model->posttext=$_POST['Post']['posttext'];
		
			$s3Helper = new S3helper();
			$url=$s3Helper->putObject($_FILES['Post']['name']['photo'], $_FILES['Post']['tmp_name']['photo']);
			$model->url=$url;

			// Perform additional processing or save the file information to the database if needed
			if($model->save()){
				$this->redirect("post",array('model'=>$model));
				exit;
			}
			else {
				echo "not saved";
				}
			// if($model->save()){
			// 	$this->render("post",array('model'=>$model));
			// 	exit;
			// }
			// else {
			// echo "not saved";
			// }
		

		}
		// display the login form
		$this->render('post',array('model'=>$model));
	}

	// public function actionSendMessage()
    // {
    //     $message = new ChatMessage();
    //     $message->sender = ['email'=>$_SESSION["name"]]; // Assuming user authentication is implemented
    //     $message->receiver = 'user_id_here'; // Set the appropriate receiver
    //     $message->content = Yii::app()->request->getPost('content');
    //     if ($message->save()) {
    //         echo 'Message sent successfully!';
    //     } else {
    //         echo 'Failed to send message.';
    //     }
    // }

    // public function actionFetchMessages()
    // {
	// 	$model = new ChatMessage();
    //     $messages = $model->findByAttributes(['email'=>$_SESSION["name"]]);
    //     $formattedMessages = array();
    //     foreach ($messages as $message) {
    //         $formattedMessages[] = $message->attributes;
    //     }
    //     echo CJSON::encode(array('messages' => $formattedMessages));
    // }

	public function actionChat(){
		$model=new ChatMessage();


		$this->render('chat',array('model'=>$model));
	}
}


 