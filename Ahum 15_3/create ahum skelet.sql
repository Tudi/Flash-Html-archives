# MySQL-Front Dump 2.5
#
# Host: localhost   Database: ahum
# --------------------------------------------------------
# Server version 4.0.16-nt

USE ahum;


#
# Table structure for table 'autofill'
#

DROP TABLE IF EXISTS autofill;
CREATE TABLE autofill (
  id tinyint(3) unsigned NOT NULL auto_increment,
  name varchar(50) default NULL,
  value varchar(20) default NULL,
  PRIMARY KEY  (id),
  KEY id (id)
) TYPE=MyISAM COMMENT='Ebben allitod be mivel toltse ki automatic a field-eket';



#
# Dumping data for table 'autofill'
#

INSERT INTO autofill (id, name, value) VALUES("1", "noconfig", NULL);
INSERT INTO autofill (id, name, value) VALUES("2", "quota", "10");
INSERT INTO autofill (id, name, value) VALUES("3", "quotaf", "1000");
INSERT INTO autofill (id, name, value) VALUES("4", "email", "1");
INSERT INTO autofill (id, name, value) VALUES("5", "samba", "1");
INSERT INTO autofill (id, name, value) VALUES("6", "p_min", NULL);
INSERT INTO autofill (id, name, value) VALUES("7", "p_max", NULL);
INSERT INTO autofill (id, name, value) VALUES("8", "expire", NULL);
INSERT INTO autofill (id, name, value) VALUES("9", "inactive", NULL);
INSERT INTO autofill (id, name, value) VALUES("10", "forcepw", NULL);
INSERT INTO autofill (id, name, value) VALUES("11", "comment", NULL);
INSERT INTO autofill (id, name, value) VALUES("12", "skeletonpath", NULL);
INSERT INTO autofill (id, name, value) VALUES("13", "shellpath", NULL);
INSERT INTO autofill (id, name, value) VALUES("14", "homepath", "/home");
INSERT INTO autofill (id, name, value) VALUES("15", "isadmin", "0");
INSERT INTO autofill (id, name, value) VALUES("16", "scriptpath", "/usr/local/bin/ahum/");
INSERT INTO autofill (id, name, value) VALUES("17", "no_acces", "0");
INSERT INTO autofill (id, name, value) VALUES("18", "user_acces", "1");
INSERT INTO autofill (id, name, value) VALUES("19", "admin_acces", "2");
INSERT INTO autofill (id, name, value) VALUES("20", "root_acces", "3");


#
# Table structure for table 'canbenull'
#

DROP TABLE IF EXISTS canbenull;
CREATE TABLE canbenull (
  id tinyint(3) unsigned NOT NULL auto_increment,
  name varchar(50) default NULL,
  value char(1) default NULL,
  minval int(11) default NULL,
  maxval int(11) default NULL,
  PRIMARY KEY  (id),
  KEY id (id)
) TYPE=MyISAM COMMENT='az adatok helyeseget ellenorzi';



#
# Dumping data for table 'canbenull'
#

INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("1", "uid", "0", "1000", "5000");
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("2", "gid", "0", "1000", "5000");
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("3", "uname", "0", NULL, NULL);
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("4", "gname", "0", NULL, NULL);
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("5", "email", "0", "0", "1");
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("6", "samba", "0", "0", "1");
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("7", "quota", "0", "1", "100");
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("8", "quotaf", "0", "0", "100000");
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("15", "skeletonpath", "1", NULL, NULL);
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("9", "homepath", "0", NULL, NULL);
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("16", "p_min", "1", NULL, NULL);
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("17", "p_max", "1", NULL, NULL);
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("18", "expire", "1", NULL, NULL);
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("19", "inactive", "1", NULL, NULL);
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("20", "forcepw", "1", NULL, NULL);
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("21", "comment", "1", NULL, NULL);
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("22", "name", "1", NULL, NULL);
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("23", "tname", "1", NULL, NULL);
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("10", "isadmin", "0", "0", "1");
INSERT INTO canbenull (id, name, value, minval, maxval) VALUES("24", "homepath", "1", NULL, NULL);


#
# Table structure for table 'groups'
#

DROP TABLE IF EXISTS groups;
CREATE TABLE groups (
  gid int(5) unsigned NOT NULL default '1000',
  name varchar(50) default NULL,
  gname varchar(50) default NULL,
  comment varchar(255) default NULL,
  homepath varchar(255) default NULL,
  tname varchar(50) default NULL,
  isadmin char(1) default NULL,
  PRIMARY KEY  (gid)
) TYPE=MyISAM COMMENT='the user is part of 1 or many groups';



#
# Dumping data for table 'groups'
#



#
# Table structure for table 'user_info'
#

DROP TABLE IF EXISTS user_info;
CREATE TABLE user_info (
  uid int(5) unsigned NOT NULL default '1000',
  BI_seria char(3) default NULL,
  BI_numar int(7) unsigned default NULL,
  adresa1 varchar(250) default NULL,
  tel1 bigint(20) unsigned default NULL,
  tel2 bigint(20) unsigned default NULL,
  comment varchar(255) default NULL,
  CNP bigint(20) unsigned default NULL,
  adresa2 varchar(250) default NULL,
  ispublic tinyint(1) unsigned default NULL,
  email1 varchar(50) default NULL,
  email2 varchar(50) default NULL,
  email3 varchar(50) default NULL,
  PRIMARY KEY  (uid)
) TYPE=MyISAM COMMENT='users own information';



#
# Dumping data for table 'user_info'
#



#
# Table structure for table 'users'
#

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  uid int(5) unsigned NOT NULL default '1000',
  name varchar(50) default NULL,
  uname varchar(50) default NULL,
  passw varchar(50) default NULL,
  quota varchar(5) default NULL,
  quotaf varchar(5) default NULL,
  p_min varchar(5) default NULL,
  p_max varchar(5) default NULL,
  expire varchar(5) default NULL,
  inactive char(1) default NULL,
  forcepw char(1) default NULL,
  email char(1) default NULL,
  comment varchar(255) default NULL,
  skeletonpath varchar(250) default NULL,
  shellpath varchar(250) default NULL,
  samba char(1) default NULL,
  homepath varchar(250) default NULL,
  PRIMARY KEY  (uid)
) TYPE=MyISAM COMMENT='Stores all the users';



#
# Dumping data for table 'users'
#

