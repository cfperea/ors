<?php
/**
* Creates the RBAC authorization structure for the activity-user relationship
*/
class RbacCommand extends CConsoleCommand
{
	private $_authManager;
	
	public function getHelp()
	{
		return <<< EOD
USAGE
	rbac

DESCRIPTION

	This command generates an initial RBAC authorization hierarchy.

EOD;
	}

	public function run($args)
	{
		// ensure than an authMananager is defined as this is mandatory for creating an auth heirarchy
		if (($this->_authManager = Yii::app()->authManager) === null)
		{
			echo "Error: an authorization manager, named 'authManager' must be configured to use this command.\n";
			echo "If you already added 'authManager' component in application configuration,\n";
			echo "please quit and re-enter the yiic shell.\n";
			return;
		}
		// provide the opportunity for the user to abort the request
		echo "This command will create three roles: Owner, Member, and Reader and the following permissions:\n";
		echo "create, read, update and delete user\n";
		echo "create, read, update and delete activity\n";
		echo "Would you like to continue? [Yes|No]";

		if (!strncasecmp(trim(fgets(STDIN)),'y',1))
		{
			$this->_authManager->clearAll();

			// create the lowest level operations for users
			$this->_authManager->createOperation("createUser", "create a new user");
			$this->_authManager->createOperation("readUser", "read a user profile information");
			$this->_authManager->createOperation("updateUser", "update a user profile information");	
			$this->_authManager->createOperation("deleteUser", "remove a user from an activity");

			// create the lowest level operations for activities
			$this->_authManager->createOperation("createActivity", "create a new activity");
			$this->_authManager->createOperation("readActivity", "read an activity information");
			$this->_authManager->createOperation("updateActivity", "update an activity information");	
			$this->_authManager->createOperation("deleteActivity", "remove an activity");

			// create a reader role and the appropriate permissions as children of this role
			$role = $this->_authManager->createRole("reader");
			$role->addChild("readUser");
			$role->addChild("readActivity");
			
			// create a member role and the appropriate permissions as children of this role
			$role = $this->_authManager->createRole("member");
			$role->addChild("reader");
			$role->addChild("updateActivity");

			// create a member role and the appropriate permissions as children of this role
			$role = $this->_authManager->createRole("owner");
			$role->addChild("reader");
			$role->addChild("member");
			$role->addChild("updateActivity");
			$role->addChild("createActivity");
			$role->addChild("deleteActivity");
			$role->addChild("createUser");
			$role->addChild("updateUser");
			$role->addChild("deleteUser");
			
			// provide a message indicating success
			echo "Authorization hierarchy successfully generated.";
		}
	}
}
