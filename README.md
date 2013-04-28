--------------------------------------------------------------------------------------------------------------------------------------------------

- Project: SIMARS
- Description: Activity manager
- Software Engineer: Carlos F. Perea Tanaka
- Start Date: March 10, 2013
- Last Modified: April 28th, 2013

--------------------------------------------------------------------------------------------------------------------------------------------------

====================
     TODO LIST
====================

--------------------------------------------------------------------------------------------------------------------------------------------------
*** April 28th, 2013 ***

--------------------------------------------------------------------------------------------------------------------------------------------------

====================
        DONE
====================

--------------------------------------------------------------------------------------------------------------------------------------------------
*** April 26th-28th 2013 ***

1) Allow for deletion of activities. Added the ON DELETE and ON UPDATE constraints to the foreign keys.

2) Created the RBAC (Roled-Based Access Control) system for the activities. Now a user can be identified as an owner, member, or viewer for an
   activity.

3) Added YiiBooster extension to the application. This framework is used for visual elements and aesthetics purposes.

4) Added the private messaging system using the one available at: http://www.yiiframework.com/extension/yii-messaging/

5) Created the local Git repository and added it to the remote repository at GitHub.

Problems encountered:

1) Had some problems with the loggin of users. This was because decided to implement the login page in the index page, thus the login action
   within the SiteController was never being called.
2) The first extra parameter option for the activities was not being saved, this was due to the fact that in the saving routine the counter
   started in 'numberOfCommonParameters + 1'; changed it to start in 'numberOfCommonParameters'.

--------------------------------------------------------------------------------------------------------------------------------------------------
*** April 6th, 2013 ***

1) Added the user authentication using encryption and added three properties to the user model: createTime, lastLogin, updateTime
    Files involved: models/User.php, components/UserIdentity.php, views/user/_form.php, views/site/index.php
    Methods involved: 
        - User.php: beforeValidate(), afterValidate(), encrypt(), rules()

--------------------------------------------------------------------------------------------------------------------------------------------------

--------------------------------------------------------------------------------------------------------------------------------------------------
*** March 23, 2013 ***

1) Added the ability to update an activity and save the extra parameters for that particular activity. The saving algorithm never saves two
   duplicate activity-parameterOption relationships because it only creates a new entry when that parameterOption wasn't previously saved in the 
   database.
    Files involved: controllers/ActivityController.php, /activity/_form.php

2) Added the functionality that automatically shows the saved values for the extra parameters when updating a saved activity.
    Files involved: /activity/_form.php
    Methods involved: $(document).ready(), updateExtraParameterValues(), updateSelectedValue() - All Javascript

Problems encountered:

1) Some minor problems in the actionUpdate() method

--------------------------------------------------------------------------------------------------------------------------------------------------
*** March 16, 2013 ***

1) Different parameters are shown depending on which activity type is selected using AJAX
    Files involved: controllers/ActivityController.php, views/activity/_view.php, views/activity/_form.php, models/Activity.php
    Methods involved: actionCreate(), actionView(), actionUpdateParameters()

2) Added a new table to the database called activityParameterOption that saves which value was selected for a particular parameter in an activity

3) Added fixtures for testing and a test database called ors_test
    Files involved: tests/fixtures/tbl_activity.php

4) Created the Models and CRUD functionality for the database entities
    Files involved: models folder and controllers folder

Problems encountered:

1) Had to learn how Yii uses AJAX
2) Some minor problems with keys in arrays

--------------------------------------------------------------------------------------------------------------------------------------------------
