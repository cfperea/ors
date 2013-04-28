<?php

class ActivityController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	public $numberOfCommonParameters = 7; // This is the number of common parameters for all activities

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update', 'index', 'view', 'updateparameters', 'adduser'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
        		'actions'=>array('admin', 'create', 'delete'),
        		'expression'=>'$user->isAdmin()',
      		),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		// Gets the extra parameters
		$activityParameterOptions = ActivityParameterOption::model()->findAllBySql('select * from tbl_activityParameterOption where activity = '.strval($id));
		$extraParameters = array();
		foreach($activityParameterOptions as $activityParameterOption)
		{
			$parameterOption = ParameterOption::model()->findByPk($activityParameterOption->parameterOption);
			$parameter = Parameter::model()->findByPk($parameterOption->parameter);
			$extraParameters[] = array($parameter->name => $parameterOption->value);
		}

		// Render the view
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'extraParameters'=>$extraParameters,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Activity;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Activity']))
		{
			$model->attributes = $_POST['Activity'];		

			// Parses the date from mm/dd/yyyy to yyyy-mm-dd format for saving in the database
			$creationDate = mysql_real_escape_string($model->attributes['creationDate']);
			$creationDate = date('Y-m-d', strtotime(str_replace('-', '/', $creationDate)));

			$startDate = mysql_real_escape_string($model->attributes['startDate']);
			$startDate = date('Y-m-d', strtotime(str_replace('-', '/', $startDate)));

			$endDate = mysql_real_escape_string($model->attributes['endDate']);
			$endDate = date('Y-m-d', strtotime(str_replace('-', '/', $endDate)));
			
			$model->creationDate = $creationDate;
			$model->startDate = $startDate;
			$model->endDate = $endDate;
			
			// Make the current user the activity's leader
			$model->leader = Yii::app()->user->getId();
			
			if($model->save())
			{
				// Saves all the extra parameters
				$keys = array_keys($_POST['Activity']);
				for ($i = $this->numberOfCommonParameters; $i < count($keys); $i++)
				{
					// Creates the new activity-parameterOption relationship
					$parameterOptionId = $_POST['Activity'][$keys[$i]];
					$activityParameterOption = new ActivityParameterOption;
					$activityParameterOption->setAttributes(
										array(
											'activity' => $model->id,
											'parameterOption' => $parameterOptionId
											)
										);
					$activityParameterOption->save();
				}

				// Make the current user the owner of the activity using the RBAC authorization system
				$userId = Yii::app()->user->getId();
				$model->associateUserToRole('owner', $userId);
				$model->associateUserToActivity(Yii::app()->user->getId());

				// Add an authorization rule if this user doesn't have one yet
				$sql = "SELECT userid FROM AuthAssignment WHERE itemname = 'owner' AND userid = :userId";
				$command = Yii::app()->db->createCommand($sql);
				$command->bindValue(":userId", $userId, PDO::PARAM_INT);
				$result = $command->execute();
				if ($result != 1)
				{
					$auth = Yii::app()->authManager;
					$bizRule = 'return isset($params["activity"]) && $params["activity"]->isUserInRole("owner");';
					$auth->assign('owner', $userId, $bizRule);
				}
				
			
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Activity']))
		{
			$model->attributes=$_POST['Activity'];

			if($model->save())
			{
				// Saves all the extra parameters
				$keys = array_keys($_POST['Activity']);

				// Gets all the extra parameter options saved for this activity
				$activityParameterOptions = ActivityParameterOption::model()->findAllBySql('select * from tbl_activityParameterOption where activity = '.$id);
				
				// Goes through all the extra parameters saved for this activity
				for ($i = $this->numberOfCommonParameters + 1; $i < count($keys); $i++)
				{
					$currentIndex = $i - ($this->numberOfCommonParameters + 1);
					$parameterOptionId = $_POST['Activity'][$keys[$i]];
					
					// If the current index is greater or equal than the number of activity-parametersOptions for this activity then the next parameter wasn't saved previously
					// therefore create a new one with the selected value
					// Else select the activity-parameterOption from the ones that were saved previously
					if ($currentIndex >= count($activityParameterOptions))
						$activityParameterOption = new ActivityParameterOption;
					else
						$activityParameterOption = $activityParameterOptions[$currentIndex];
					$activityParameterOption->setAttributes(
										array(
											'activity' => $model->id,
											'parameterOption' => $parameterOptionId
											)
										);
					$activityParameterOption->save();
				}
	
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		
		$this->render('update',array(
			'model'=>$model,
		));
		
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Activity');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Activity('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Activity']))
			$model->attributes=$_GET['Activity'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Activity the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Activity::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Activity $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='activity-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	* Called when a user selects the activity type or when the update activity page is loaded
	* Returns all the available extra parameters for a particular activity type and its values
	*/
	public function actionUpdateParameters()
	{
		// Get all the parameter-activityType relationships for the selected activityType
		$parametersInActivities = ParameterInActivity::model()->findAll('activityType=:activityType', array(':activityType'=>(int) $_POST['activityType']));

		// For each extra parameter found then add its own drop-down list
		foreach ($parametersInActivities as $parameterInActivity)
		{
			$parameterId = $parameterInActivity->parameter;
			$parameter = Parameter::model()->findByPk($parameterId);
			$parameterValues = ParameterOption::model()->findAllBySql('select * from tbl_parameterOption where parameter = '.strval($parameterId));
			echo '<div class="row">';
			echo "<label>".$parameter->name."</label>";
			echo '<select name="Activity['.$parameter->name.']" id="Activity_'.$parameter->name.'">';
			foreach ($parameterValues as $value)
			{
				echo '<option value="'.$value->id.'">'.$value->value.'</option>';
			}
			echo '</select>';
			echo '</div>';
		}
	}

	/**
	* Action for adding a user to an activity
	*/
	public function actionAddUser($id)
	{
		$activity = $this->loadModel($id);

		// Checks whether the user is currently able to perform this action
		if (!Yii::app()->user->checkAccess('owner', array('activity'=>$activity)))
		{
			throw new CHttpException(403, "No está autorizado para realizar esta acción.");
		}
		
		$form = new ActivityUserForm();
		
		// Collect user input data
		if (isset($_POST['ActivityUserForm']))
		{
			$form->attributes = $_POST['ActivityUserForm'];
			$form->activity = $activity;
			if ($form->validate())
			{
				Yii::app()->user->setFlash("success", $form->name . " se ha agregado a la actividad.");
				$form = new ActivityUserForm();
			}
		}
		$users = User::model()->findAll();
		$usernames = array();
		foreach($users as $user)
		{
			$usernames[] = $user->name;
		}
		$form->activity = $activity;
		$this->render('adduser', array('model'=>$form, 'usernames'=>$usernames));
	}
}
