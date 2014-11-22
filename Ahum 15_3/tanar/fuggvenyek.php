<?php

include "const.php";

//alakitsunk at minden GET vagy POST variable-t szimpla variable-a
foreach($_REQUEST as $key => $val) ${$key}=$val;

/************************************************************************************************/
//check if username and password exists in database , returns acces code
function acces_code($user,$passw)
{
	$user_acces=getct(no_acces);
	//user exists and it's part of a group that has admin acces
	$query="select uid from users where users.uname=\"$user\" and users.passw=\"$passw\"";
	$result = search_database($query,"get acces code : is the user registred with this password ? : $query");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$uid=$line[uid];
	if(isset($uid) && $uid!="")
	{
		$user_acces=getct(user_acces);
		$query="select gname from groups where isadmin=\"1\"";
		$result= search_database($query,"get acces code : search groups to see if the user has admin acces ? : $query");
		while ( $line = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$query2="select uid from ".$line[gname]." where uid=\"$uid\"";
			$result2 = search_database($query2,"get acces code : is the user in an admin group registred ? : $query");
			$line2 = mysql_fetch_array($result2, MYSQL_ASSOC);
			if(isset($line2[uid]) && $line2[uid]!="")$user_acces=getct(admin_acces);
		}
	}

	//ez kulonleges/kiveteles behatolasi mod de ki kene venni security hole miatt
	if($user==ahum_root_name && $passw==ahum_root_passw)
		$user_acces=getct(root_acces);
	return("$user_acces");
}  

/************************************************************************************************/
//kinyitja az addatbazist,hogy lekerje a user-eket es ellenorizze a bejelentkezest
function open_database()
{
	global $link;
    $link = mysql_connect(sql_hostname, sql_username, sql_password) or die("Could not connect : " . mysql_error());
    mysql_select_db(sql_database) or die("Could not select database");
	return($link);
}

/**********************************************************************************************/
//becsukja az adatbazist
function close_database()
{
	global $rezult;
	global $link;
    if (isset($result)) mysql_free_result($result);
    if (isset($link)) mysql_close($link);
}

/**********************************************************************************************/
//keres az adatbazisban
function search_database($sql_query,$err_no="")
{
	global $link;
	$rez = mysql_query($sql_query, $link) or die("Query failed : " . mysql_error()."<br>Local er no : ".$err_no);
	return($rez);
}

/**********************************************************************************************/
//lekeri az adatbazisbol 1 constans erteket
function getct($ctname)
{
	open_database();
	$query="select value from autofill where autofill.name=\"$ctname\"";
	$result=search_database($query,"getct : get the constant's value for constant name : $query");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	return($line[value]);
	close_database();
}
?>