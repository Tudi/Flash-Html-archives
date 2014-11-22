<?php
session_start();
$_SESSION[last_msg_id]=0;
include "fuggvenyek.php";
include "config.php";
//szamoljuk egyszer meg hogy a bizinys uzer hany uzenetet szabad letoroljon max
open_database();
//a user acces-je
$query="select u_acces from users where uid=".$_SESSION[uid];
$result=search_database($query,"<br>Local error : regibol_torol_msg.php : lekeri a user acces-jet : $query");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$session_acces=$line[u_acces];
if($_POST[secondrun]=="1")
{
	//szoval le kell torolni x legregibb uzenetet
	$query="select uid,mid from msgs order by mid asc";
	$result=search_database($query,"<br>Local error : regibol_torol_msg.php : lekeri az osszes msg-et : $query");
	$szamol=0;
	while($line = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$query2="select u_acces from users where uid=".$line[uid];
		$result2=search_database($query2,"<br>Local error : regibol_torol_msg.php : lekeri a user acces-jet : $query");
		$line2 = mysql_fetch_array($result2, MYSQL_ASSOC);
		if($line2[u_acces]<=$session_acces && $szamol<$_POST[t_torol])
		{
			$szamol++;
			//toroljuk is le
			$query3="DELETE FROM msgs WHERE mid=".$line[mid];
			$result3=search_database($query3,"<br>Local error : regibol_torol_msg.php : torli a msg-et : $query");

		}
	}
}
//kerjuk le az osszes msg-et
$query="select uid,mid from msgs";
$result=search_database($query,"<br>Local error : regibol_torol_msg.php : lekeri az osszes msg-et : $query");
$szamol=0;
while($line = mysql_fetch_array($result, MYSQL_ASSOC))
{
	$query2="select u_acces from users where uid=".$line[uid];
	$result2=search_database($query2,"<br>Local error : regibol_torol_msg.php : lekeri a user acces-jet : $query");
	$line2 = mysql_fetch_array($result2, MYSQL_ASSOC);
	if($line2[u_acces]<=$session_acces)
		$szamol++;
}
close_database();
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<body>
<form name="form_torol" method="post" action="regibol_torol_msg.php">
  <p>Max ennyi uzenetet torolhetsz le (masoket is ha van jogod) : 
    <?=$szamol?>
  </p>
  <p>Hany uzenetet szeretnel letrolni 
    <input name="t_torol" type="text" id="t_torol" size="4" maxlength="4">
  </p>
  <p> 
    <input name="b_submit" type="submit" id="b_submit2" value="Torold az uzeneteket">
    <input name="t_back" type="button" id="t_back" onClick="MM_goToURL('parent','main.htm');return document.MM_returnValue" value="Vissza a foldalra">
  </p>
  <input type="hidden" name="secondrun" value="1">
  </form>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</body>