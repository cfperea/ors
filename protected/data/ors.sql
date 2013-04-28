DROP TABLE IF EXISTS tbl_parameter;
DROP TABLE IF EXISTS tbl_activityType;
DROP TABLE IF EXISTS tbl_faculty;
DROP TABLE IF EXISTS tbl_parameterOption;
DROP TABLE IF EXISTS tbl_parameterInActivity;
DROP TABLE IF EXISTS tbl_user;
DROP TABLE IF EXISTS tbl_activity;

CREATE TABLE tbl_parameter
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(128) NOT NULL,
description TEXT
);

create table tbl_activityType
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(128) NOT NULL,
description TEXT
);

CREATE TABLE tbl_faculty
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(128) NOT NULL,
description TEXT
);

create table tbl_parameterOption
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
parameter INTEGER,
value VARCHAR(128) NOT NULL,
FOREIGN KEY (parameter) REFERENCES tbl_parameter(id) ON DELETE CASCADE ON UPDATE CASCADE;
);

create table tbl_parameterInActivity
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
parameter INTEGER,
activityType INTEGER,
FOREIGN KEY (parameter) REFERENCES tbl_parameter(id) ON DELETE CASCADE ON UPDATE CASCADE;,
FOREIGN KEY (activityType) REFERENCES tbl_activityType(id) ON DELETE CASCADE ON UPDATE CASCADE;
);

create table tbl_user
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(128) NOT NULL,
password VARCHAR(32) NOT NULL,
isAdmin BOOLEAN NOT NULL,
email VARCHAR(128) NOT NULL,
faculty INTEGER,
createTime DATETIME NOT NULL,
lastLogin DATETIME,
updateTime DATETIME,
FOREIGN KEY (faculty) REFERENCES tbl_faculty(id) ON DELETE CASCADE ON UPDATE CASCADE;
);

create table tbl_activity
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(128) NOT NULL,
creationDate DATE NOT NULL,
startDate DATE NOT NULL,
endDate DATE NOT NULL,
leader INTEGER,
activityType INTEGER,
budget FLOAT,
description TEXT,
FOREIGN KEY (leader) REFERENCES tbl_user(id) ON DELETE CASCADE,
FOREIGN KEY (activityType) REFERENCES tbl_activityType(id) ON DELETE CASCADE ON UPDATE CASCADE;
);

CREATE TABLE tbl_activityParameterOption
(
id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
activity INT,
parameterOption INT,
FOREIGN KEY(activity) REFERENCES tbl_activity(id) ON DELETE CASCADE ON UPDATE CASCADE;,
FOREIGN KEY(parameterOption) REFERENCES tbl_parameterOption(id) ON DELETE CASCADE ON UPDATE CASCADE;
);

CREATE TABLE tbl_activity_user
(
activity_id INTEGER NOT NULL,
user_id INTEGER NOT NULL,
PRIMARY KEY(activity_id, user_id),
FOREIGN KEY(activity_id) REFERENCES tbl_activity(id) ON DELETE CASCADE ON UPDATE CASCADE;,
FOREIGN KEY(user_id) REFERENCES tbl_user(id) ON DELETE CASCADE ON UPDATE CASCADE;
);

CREATE TABLE tbl_activity_user_role
(
	activity_id INTEGER NOT NULL,
	user_id INTEGER NOT NULL,
	role VARCHAR(64) NOT NULL,
	PRIMARY KEY(activity_id, user_id, role),
	FOREIGN KEY(activity_id) REFERENCES tbl_activity(id) ON DELETE CASCADE ON UPDATE CASCADE;,
	FOREIGN KEY(user_id) REFERENCES tbl_user(id) ON DELETE CASCADE ON UPDATE CASCADE;,
	FOREIGN KEY(role) REFERENCES AuthItem(name) ON DELETE CASCADE ON UPDATE CASCADE;
);

INSERT INTO tbl_user (name, password, isAdmin, email, createTime)
VALUES ("Admin", "098f6bcd4621d373cade4e832627b4f6", 1, "test@javerianacali.edu.co", NOW());
