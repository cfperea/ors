<?php
/**
* ActivityUserForm class.
* ActivityUserForm is the data structure for keeping the form data related to adding an existing user to a project.
* It is used by the 'AddUser' action of 'ProjectController'.
*/
class ActivityUserForm extends CFormModel
{
	// username of the user being added to the activity
	public $name;
	
	// the role to which the user will be associated
	public $role;

	// the instance of the Activity AR model class
	public $activity;

	/**
	* Declares the validation rules.
	* The rules state that username and password are required, and password needs to be authenticated using the verify() method
	*/
	public function rules()
	{
		return array(
			array('name, role', 'required'),
			// password needs to be authenticated
			array('name', 'exist', 'className'=>'User'),
			array('name', 'verify'),
		);
	}

	public function verify($attribute, $params)
	{
		if (!$this->hasErrors())
		{
			$user = User::model()->findByAttributes(array('name'=>$this->name));
			if ($this->activity->isUserInActivity($user->id))
			{
				$this->addError('name', 'Este usuario ya se ha agregado a la actividad');
			}
			else
			{
				$this->activity->associateUserToActivity($user->id);
				$this->activity->associateUserToRole($this->role, $user->id);

				// Add an authorization rule if this user doesn't have one yet
				$sql = "SELECT userid FROM AuthAssignment WHERE itemname = '".$this->role."' AND userid = :userId";
				$command = Yii::app()->db->createCommand($sql);
				$command->bindValue(":userId", $user->id, PDO::PARAM_INT);
				$result = $command->execute();
				if ($result != 1)
				{
					$auth = Yii::app()->authManager;
					$bizRule = 'return isset($params["activity"]) && $params["activity"]->isUserInRole("'.$this->role.'");';
					$auth->assign($this->role, $user->id, $bizRule);
				}
			}
		}
	}	

}
