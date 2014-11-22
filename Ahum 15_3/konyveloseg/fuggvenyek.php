<?php

include "const.php";

//alakitsunk at minden GET vagy POST variable-t szimpla variable-a
foreach($_REQUEST as $key => $val) ${$key}=$val;
  

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