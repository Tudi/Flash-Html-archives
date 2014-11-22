<?php 
session_start();
$_SESSION[last_msg_id]=0;
include "fuggvenyek.php";
include "config.php";
if ($_POST[secondrun]=="1")
{
	//szoval mar bevannak irva az adatok akkor nezzuk meg tudonk-e veluk kezdeni valamit
	$ts=$_POST[t_start];
	$te=$_POST[t_stop];
	if(strlen($ts)!=19 || strlen($te)!=19)print("A datumot teljes egeszeben ird be<br>");
	else if($ts>$te)print("sajnos a kezdet ido nagyobb mint a vegso ido<br>");
	else if($ts[4]!="-" || $ts[7]!="-" || $ts[10]!="-" || $ts[13]!="-" || $ts[16]!="-")print("a kezdet datum formatum rossz<br>");
	else if($te[4]!="-" || $te[7]!="-" || $te[10]!="-" || $te[13]!="-" || $te[16]!="-")print("a vegso datum formatum rossz<br>");
	else 
	{
		//az adatbazisbol letoroljuk az osszes olyan msg-et aminek a datuma a ketto kozt van
		open_database();
		$query="select m_time from msgs";
		$result=search_database($query,"<br>Local error : intervalumot_torol_msg.php : lekeri az osszes  msg-et : $query");
		while($line = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			//mindegyik msg-nek nezzuk meg benne van-e az ido intervalumban ?
			if($line[m_time]<$te && $ts<=$line[m_time])
			{
				$query2="DELETE FROM msgs WHERE m_time='".$line[m_time]."'";
				$result2=search_database($query2,"<br>Local error : intervalumot_torol_msg.php : kitorli a msg-et : $query");
			}
		}
		close_database();
	}
}
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<p>Ha helytelenul irod be a datumot akkor semmit se torul le</p>
<p>Datum formatuma : &quot;ev-honap-nap-ora-perc-masodperc&quot;</p>
<p>Legfiatalabb ido : &quot;2005-00-00-00-00-00&quot;</p>
<form name="form_intervalumdata" method="post" action="intervalumot_torol_msg.php" target="_self">
  <p>Az elso datum ahhonan kezdi torolni : 
    <input name="t_start" type="text" id="t_start" size="19" maxlength="19">
  </p>
  <p>A datum ameddig torol : 
    <input name="t_stop" type="text" id="t_stop" size="19" maxlength="19">
  </p>
  <p> 
    <input name="t_delete" type="submit" id="t_delete" value="Torold le">
    <input name="t_back" type="button" id="t_back" onClick="MM_goToURL('parent','main.htm');return document.MM_returnValue" value="Vissza a foldalra">
  </p>
  <input type="hidden" name="secondrun" value="1">
</form>
<p>&nbsp;</p>
