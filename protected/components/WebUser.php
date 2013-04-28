<?php
 
class WebUser extends CWebUser {
 
	// Store model to not repeat query.
	private $_model;


	// This is a function that checks the field 'role'
	// in the User model to be equal to 1, that means it's admin
	// access it by Yii::app()->user->isAdmin()
	function isAdmin(){
		if (!Yii::app()->user->isGuest)
		{
			$user = $this->loadUser(Yii::app()->user->id);
			return intval($user->isAdmin) == 1;
		}
		return 0;
	}

	function createTime()
	{
		if (!Yii::app()->user->isGuest)
		{
			$user = $this->loadUser(Yii::app()->user->id);
			return $user->createTime;
		}
		return 0;
	}
 
  	// Load user model.
  	protected function loadUser($id=null)
	{
        if ($this->_model === null)
        {
            if ($id !== null)
                $this->_model = User::model()->findByPk($id);
        }
        return $this->_model;
    }
}
?>
