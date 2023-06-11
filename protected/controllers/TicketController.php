<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php

// Set your Razorpay API credentials
$key = 'rzp_test_lhqTkgN2GgpNKr';
$secret = 'uppECfbg1QGlyxpMdlBYsH8Q';
class TicketController extends Controller1
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

     public function actionSubcategories()
     {
         if (Yii::app()->request->isAjaxRequest) {
             $selectedCategory = Yii::app()->request->getPost('category');
             $category = Category::model()->findByAttributes(array('category' => $selectedCategory));
     
             $subcategories = array();
             if ($category !== null) {
                 foreach ($category->subcat as $subcategory) {
                     $subcategories[] = $subcategory['subcategory'];
                 }
             }
             
             echo json_encode($subcategories);
         }
     }
    


    public function actionNewcat(){
        $model = new Category;
       
        if (isset($_POST['Category']))
        {
        $cat=$_POST["Category"]["category"];
        $model->category= new MongoRegex('/^' . preg_quote($cat) . '$/i');
        $existingCategory = $model->findByAttributes(['category' => $model->category]);
        if ($existingCategory) {
            // Handle the case where the category_code is not unique
            $model->category=$cat;
            $model->addError('category', 'Category already exists. Please choose a unique Title.');

            $errors = $model->getErrors();
            $this->render("newcat", array('model' => $model, 'errors' => $errors));
            exit;

        }else{

        $model->category = $_POST["Category"]["category"];
        $model->description = $_POST["Category"]["description"];	
        $model->code = $_POST["Category"]["code"];
        $model->escalate_to = $_POST["Category"]["escalate_to"];

        $subcat = new Subcat();
        $subcat->subcategory ="default".$_POST["Category"]["category"] ;
        $subcat->scode = "s".$_POST["Category"]["code"];
        $subcat->description = "default subcategory";

        $model->subcat[] = $subcat;
     
        if ($model->save()) {
         

            $model->unsetAttributes();
            $this->render('newcat',array('model' => $model));
            exit;
            
        } else {
            
            $errors = $model->getErrors();
            $this->render("newcat", array('model' => $model, 'errors' => $errors));
            exit;
        
        }
    }
        }
        $this->render('newcat',array('model' => $model));
    }

    public function actionNewsubcat() {
        $catmodel = new Category;
        $model = new Subcat;
        $data = $catmodel->findAll([]);
     
        $cat = [];
        for ($i = 0; $i < count($data); $i++) {
            $cat[] = array('cat' => $data[$i]->category,
                           'code' => $data[$i]->code);
        }
    
        if (isset($_POST['Subcat'])) {
            $category = $catmodel->findByAttributes(['category' => $_POST['Category']['category']]);
    
            $subcat = new Subcat();
            $subcat->subcategory = !empty($_POST['Subcat']['subcategory']) ? $_POST['Subcat']['subcategory'] : null;
            $subcat->scode = !empty($_POST['Subcat']['scode']) ? $_POST['Subcat']['scode'] : null;
            $subcat->description = !empty($_POST['Subcat']['description']) ? $_POST['Subcat']['description'] : null;

            if (!$subcat->validate()) {
                $errors = $subcat->getErrors();
                $this->render("newsubcat", array(
                    'model' => $subcat,
                    'categories' => $cat,
                    'catmodel' => $catmodel,
                    'errors' => $errors 
                ));
                exit;
            } else {
            $category->subcat[] = $subcat;

            if ($category->save()) {
                
            } else {
                $errors = $category->getErrors();
                $this->render("newsubcat", array(
                'model' => $model,
                'categories' => $cat,
                'catmodel' => $catmodel,
                'errors' => $errors 
                ));
             }
        }           

        }
    
        $this->render('newsubcat', array('model' => $model, 'categories' => $cat, 'catmodel' => $catmodel));
    }
    
  

    public function actionCreate()
    {
        $model = new Ticket;
		if(!(Yii::app()->user->hasState('stats_count')))
		{
			Yii::app()->user->setState('stats_count',86);
		}
		

		if (isset($_POST['Ticket'])) {

            $title=$_POST["Ticket"]["title"];
        $model->title= new MongoRegex('/^' . preg_quote($title) . '$/i');
        $existingTitle = $model->findByAttributes(['title' => $model->title]);
        if ($existingTitle) {
            // Handle the case where the category_code is not unique
            $model->title=$title;
            $model->addError('title', 'Title already exists. Please choose a unique Title.');

            $errors = $model->getErrors();
            $this->render("create", array('model' => $model, 'errors' => $errors));
            exit;

        }else{
			
			$cookie = Yii::app()->request->cookies['email'];
			if ($cookie !== null) {
                $email = urldecode($cookie->value);
			}
			$model1 = new Register;
			$user = $model1->findByAttributes(['email' => $email]);

            

			$model->id=strval(Yii::app()->user->stats_count);
			$model->title = $_POST["Ticket"]["title"];
			$model->description = $_POST["Ticket"]["description"];	
			$model->priority = $_POST["Ticket"]["priority"];
            $model->category = $_POST["Ticket"]["category"];
            $model->subcategory = $_POST["Ticket"]["subcategory"];
			$model->createdby = $email;
            $model->status = "Assigned";
            $model->timestamp=date('Y-m-d H:i:s');
        
            $result11 = Register::model()->startAggregation()
            ->addStage(['$match' => ['email' => ['$ne' => $user->email]]]) // Exclude current user's email
            ->addStage(['$sort' => ['tickets_ongoing' => 1]])
            ->addStage(['$limit' => 1])
            ->addStage(['$project' => ['_id' => 0, 'email' => 1]]) // Project only the email field
            ->aggregate();

    

            $leastOngoingEmail = $result11['result'][0]['email'];
             
            $model->assigned_to = $leastOngoingEmail;
            $assigneduser =  Register::model()->findByAttributes(['email' => $leastOngoingEmail]);
            // var_dump($assigneduser);
            // exit;
            $assigneduser->tickets_ongoing +=1;
			$assigneduser->save();

			if ($model->save()) {
				$count=Yii::app()->user->stats_count;
				$count=$count+1;
				Yii::app()->user->setState('stats_count',$count);
				// Yii::app()->params['id'] = $counter;

				$model->unsetAttributes();
				$this->render("create", array('model' => $model));
				
			} else {
				
				$errors = $model->getErrors();
				$this->render("create", array('model' => $model, 'errors' => $errors));
			
			}
		}} else {

			$this->render('create',array('model' => $model));
		}
	}




    public function actioncforothers()
    {
        $model = new Ticket;
		if(!(Yii::app()->user->hasState('stats_count')))
		{
			Yii::app()->user->setState('stats_count',66);
		}
		

		if (isset($_POST['Ticket'])) {
			
			$cookie = Yii::app()->request->cookies['email'];
			if ($cookie !== null) {
                $email = urldecode($cookie->value);
			}
			$model1 = new Register;
			$user = $model1->findByAttributes(['email' => $email]);

            

			$model->id=strval(Yii::app()->user->stats_count);
			$model->title = $_POST["Ticket"]["title"];
			$model->description = $_POST["Ticket"]["description"];	
			$model->priority = $_POST["Ticket"]["priority"];
            $model->category = $_POST["Ticket"]["category"];
            $model->subcategory = $_POST["Ticket"]["subcategory"];
			$model->createdby = $email;
            $model->status = "Assigned";
            $model->timestamp=date('Y-m-d H:i:s');
            $model->onBehalf = $_POST["Ticket"]["onBehalf"];
            $em=$_POST["Ticket"]["onBehalf"];
        
            $result11 = Register::model()->startAggregation()
            ->addStage(['$match' => ['email' => ['$ne' => $em]]]) // Exclude current user's email
            ->addStage(['$sort' => ['tickets_ongoing' => 1]])
            ->addStage(['$limit' => 1])
            ->addStage(['$project' => ['_id' => 0, 'email' => 1]]) // Project only the email field
            ->aggregate();

    

            $leastOngoingEmail = $result11['result'][0]['email'];
             
            $model->assigned_to = $leastOngoingEmail;
            $assigneduser =  Register::model()->findByAttributes(['email' => $leastOngoingEmail]);
            // var_dump($assigneduser);
            // exit;
            $assigneduser->tickets_ongoing +=1;
			$assigneduser->save();

			if ($model->save()) {
				$count=Yii::app()->user->stats_count;
				$count=$count+1;
				Yii::app()->user->setState('stats_count',$count);
				// Yii::app()->params['id'] = $counter;

				$model->unsetAttributes();
				$this->render("cforothers", array('model' => $model));
				
			} else {
				
				$errors = $model->getErrors();
				$this->render("cforothers", array('model' => $model, 'errors' => $errors));
			
			}
		} else {

			$this->render('cforothers',array('model' => $model));
		}
	}


    public function actionticketdetails(){
        $id = Yii::app()->request->getQuery('id');
        $model = new Ticket;
      
        $data = $model->findByAttributes(['id' => $id]);

        if (!empty($data->timestamp)) {
         
             $timestamp = strtotime($data->timestamp);
 
             $currentTime = strtotime(date('Y-m-d H:i:s'));
   
             $timeDifference = $currentTime - $timestamp;
     

             if (intval($timeDifference/3600)>24 && $data->status=="Assigned"){

          
                 $categoryTicket = Category::model()->findByAttributes(['category' => $data->category]);

                 if ($categoryTicket && $data->status!="Assigned (Escalated)") {
 
                     $data->escalated_to = $categoryTicket->escalate_to;

                     $comment = array(
                        'user' => "Ticket was escalated to", 
                        'text' =>  Register::model()->findByAttributes(array('email'=>$categoryTicket->escalate_to))['username'],
                        'timestamp' => new MongoDate()
                    );
                    $data->comments[] = $comment;
                    $data->assigned_to=$categoryTicket->escalate_to;
                    $data->sla=intval($timeDifference/3600)>24;
                    $data->status="Assigned (Escalated)";
                     $data->save();
                 }
             }
         }
        $this->render('ticketdetails',array('data'=>$data));
     
    }

    public function actionComment($id) {

        $ticket = Ticket::model()->findByAttributes(array('id'=>$id));
      
        $cookie = Yii::app()->request->cookies['email'];
			if ($cookie !== null) {
                $email = urldecode($cookie->value);
			}
        if (!$ticket) {
            throw new CHttpException(404, 'Ticket not found.');
        }
    
        $commentText = Yii::app()->request->getPost('comment');
        if (!empty($commentText)) {
            $comment = array(
                'user' =>  Register::model()->findByAttributes(array('email'=>$email))['username'],
                'text' => $commentText,
                'timestamp' => new MongoDate()
            );
            $ticket->comments[] = $comment;
            $ticket->save();
            // $ticket->unsetAttributes();
            $this->render('ticketdetails', array('data' => $ticket));
            
        }
        else{
        $this->render('ticketdetails', array('data' => $ticket));
        }
    }
    
    public function actionholdticket($id){

        $ticket = Ticket::model()->findByAttributes(array('id'=>$id));
        $ticket->status="Hold";
        $comment = array(
            'user' => "The ticket was set to hold by " .$ticket->assigned_to,
            'text' => " ",
            'timestamp' => new MongoDate()
        );
        $ticket->comments[] = $comment;
        $ticket->save();
        $this->redirect("/index.php/user/assigneeview/id/".$id,array('data'=>$ticket));
    }

    public function actionopenticket($id){

        $ticket = Ticket::model()->findByAttributes(array('id'=>$id));
        $ticket->status="Assigned";
        $comment = array(
            'user' => "The ticket was opened by " .$ticket->assigned_to,
            'text' => " ",
            'timestamp' => new MongoDate()
        );
        $ticket->comments[] = $comment;
        $ticket->save();
        $this->redirect("/index.php/user/assigneeview/id/".$id,array('data'=>$ticket));
    }

 
    public function actioncloseticket($id){
        
        $ticket = Ticket::model()->findByAttributes(array('id'=>$id));
        $ticket->status="Closed";
        $comment = array(
            'user' => "The ticket was closed by " .$ticket->createdby,
            'text' => " ",
            'timestamp' => new MongoDate()
        );
        $ticket->comments[] = $comment;
        $ticket->save();
        $this->redirect("/index.php/user/creatorview/id/".$id,array('data'=>$ticket));
    }

  

    public function actionreopenticket($id){

        $ticket = Ticket::model()->findByAttributes(array('id'=>$id));
        $ticket->status="Assigned";
        $comment = array(
            'user' => "The ticket was reopened by " .Register::model()->findByAttributes(array('email'=>$ticket->createdby))['username'],
            'text' => " ",
            'timestamp' => new MongoDate()
        );
        $ticket->comments[] = $comment;
        $ticket->save();
        $this->redirect("/index.php/user/creatorview/id/".$id,array('data'=>$ticket));
    }

    public function actioncategorypage(){
        $model = new Category;

        $data = $model->findAll();

        $this->render('categorypage', array('data' => $data));

    }

    public function actionsubcategorypage(){
        $model = new Category;

        $data = $model->findAll();

        $this->render('subcategorypage', array('data' => $data));
        
    }

    public function actionLogout()
    {
        
        Yii::app()->request->cookies['email'] = new CHttpCookie('email', "");

        Yii::app()->user->logout();
        $this->redirect('../user/userlogin');

    }

}


