<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">

<html>
<head>
<title>chat ablak amiben megjelennek a msg-ek</title>
<style type="text/css">
<!--
BODY {
		background-color: transparent;
		background-image: none;
		}
-->
</style>
</head>

<?php
//a user id-szerint keressuk ki a user settingsz-jeit
include "config.php";
include "fuggvenyek.php";
open_database();
$query="select kapott_style from users where uid=".$_SESSION[uid];
$result=search_database($query,"kapott.php : probalja a kapott style-t lekerdeni : $query");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
close_database();
?>

<body topmargin="0">
<div id="tartalom" name="tartalom" style="<?=$line[kapott_style]?>"></div>
</body>
