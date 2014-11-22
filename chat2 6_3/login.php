<?php
session_start();
include "fuggvenyek.php";
include "config.php";

//bejelentkezunk a serverre es lekerdezzuk letezik-e ilyen user
open_database();
$query="select u_nick from users where users.u_nick='".$_POST[text_nick]."'";
$result=search_database($query,"login.php : searching 4 user : $query");
$line=mysql_fetch_array($result, MYSQL_ASSOC);
$nickr=$line[u_nick];
$query="select uid from users where users.u_passw='".$_POST[text_passw]."'";
$result=search_database($query,"login.php : searching 4 user password : $query");
$line=mysql_fetch_array($result, MYSQL_ASSOC);
$passwr=$line[uid];
close_database();
if($nickr=="" || !isset($nickr))
 {
	?>
	<script language="JavaScript" type="text/JavaScript">
		alert("Nick nincs regisztralva : "+"<?=$_POST[text_nick]?>");
		history.back();
	</script>
	<?php
 }
if($passwr=="" || !isset($passwr))
 {
	?>
	<script language="JavaScript" type="text/JavaScript">
		alert("Rossz a jelszo");
		history.back();
	</script>
	<?php
 }
//ha idaig elertunk akkor be kene engedjuk a usert
//aloszor adjunk a browser-nek jogot hasznalni a chat-et
$_SESSION[uid]=$line[uid];
$_SESSION[last_msg_id]=0;
?>
<script language="JavaScript" type="text/JavaScript">
//	alert("'<?=$_SESSION[uid]?>'"+"'<?=$GLOBALS[uid]?>'");
	document.location="main.htm";
</script>
<?php

?>