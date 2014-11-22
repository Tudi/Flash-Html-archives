<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include "config.php";
include "fuggvenyek.php";
//errol semikepp ne feledkezzunk meg mert hanem nem fog kiirni semmit
$_SESSION[last_msg_id]=0;
open_database();
//nezzuk meg masodszor fut-e a page , ha igen akkor kell torolni
if($_POST[secondrun]=="1")
{
//	$query="select msg,uid,mid from msgs where uid=".$_SESSION[uid];
	$query="select msg,uid,mid from msgs";
	$result=search_database($query,"<br>Local error : kivalaszt_torol_msg.php : lekeri az osszes msg-et : $query");
	while($line = mysql_fetch_array($result, MYSQL_ASSOC))
		if($_POST[$line[mid]]==$line[mid])
		{
			//ezt ki kell torolni
			$query2="DELETE FROM msgs WHERE mid=".$line[mid];
			$result2=search_database($query2,"<br>Local error : kivalaszt_torol_msg.php : torli a msg-et : $query");
		}
	
}
//kerjuk le a user acces-jet
$query="select u_acces from users where uid=".$_SESSION[uid];
$result=search_database($query,"<br>Local error : kivalaszt_torol_msg.php : lekeri a user acces-jet : $query");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$session_acces=$line[u_acces];
//adminok mindent szabad csinalajanak
//a user acces-jenel kisebb acces-u msg-eket le torolheti
$query="select msg,uid,mid from msgs";
$result=search_database($query,"<br>Local error : kivalaszt_torol_msg.php : lekeri az osszes kisebb acces msg-et : $query");
?>
<p><font size="+1"><strong>Habar a torlodnek az uzenetek a tobbiek meg latni fogjak 
  amig ujra be nem toltik az egesz ablakot (bejelentkezes,ablak valtas)</strong></font></p>
<form name="form_mittorol" method="post" action="egyenkent_torol_msg.php" target="_self">
  <table border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td><strong><font size="+2">Torli?</font></strong></td>
      <td><div align="center"><strong><font size="+2">Az uzenet tartalma</font></strong></div></td>
    </tr>
<?php
while($line = mysql_fetch_array($result, MYSQL_ASSOC))
{
	//mindegyik msg-nek nezzuk meg kisebb a gazdaja acces-je ?
	$query2="select u_acces from users where uid=".$line[uid];
	$result2=search_database($query2,"<br>Local error : kivalaszt_torol_msg.php : lekeri a user acces-jet : $query");
	$line2 = mysql_fetch_array($result2, MYSQL_ASSOC);
	if($line2[u_acces]<=$session_acces)
	{
		//szoval ki kell irjuk a msg-et
		print("<tr><td style='background-color:red'><center><input type=checkbox name='".$line[mid]."' value='".$line[mid]."'></center></td>");
		//a msg-bol toruljuk ki az idegesito ismetlodo reszt ami : "</a> :"-vel vegzodik
		$t=html_entity_decode($line[msg]);
		$rest = substr($t, strpos($t,"</a> :")+7);
		print("<td>&nbsp;&nbsp;&nbsp;&nbsp;".$rest."</td></tr>");
	}

}
close_database();
?>
  </table>
  <input type=hidden name=secondrun value="1">
  <input name="b_torol" type="submit" id="b_torol" value="torli a kivalasztottakat">
  <input name="b_vissza" type="button" id="b_vissza" onClick="vissza()" value="vissza a chathez">
</form>

<script language="JavaScript" type="text/JavaScript">
<!--
function vissza() 
{document.location="main.htm";}
//-->
</script>