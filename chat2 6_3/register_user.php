<?php
session_start();
include "fuggvenyek.php";
include "config.php";
//kezdjuk ellenorizni minden rendben van-e ha nincs akkor korigaljunk
//fontos,hogy meg 1 ilyen user name ne legyen nezzuk meg 
open_database();
$line[uid]="";
$query="select uid from users where users.u_nick='".$_POST[t_nick]."'";
$result=search_database($query,"register_user.php : keressuk meg meg van-e egy ilyen user : $query");
$line=mysql_fetch_array($result, MYSQL_ASSOC);
if($line[uid]!="" && isset($line[uid]))
{
	close_database();
		?>
	<script language="JavaScript" type="text/JavaScript">
		alert("Mar van regisztralva ilyen nick");
		document.location="register_user_getdata.htm";
	</script>
	<?php
}
if($_POST[t_refr]==0)$refr=1;
 else if($_POST[t_refr]>60)$refr=60;
	else $refr=$_POST[t_refr];
	
if($_POST[t_show_nr_msgs]==0)$show_nr_msgs=1;
	else if($_POST[t_show_nr_msgs]>max_msgs_can_show)$show_nr_msgs=max_msgs_can_show;
		else $show_nr_msgs=$_POST[t_show_nr_msgs];

//ha idaig ertunk akkor erdemes regisztralni a usert
$values="(NULL,0";
if($_POST[t_group]!="")$values.=",'".$_POST[t_group]."'";
	else $values.=",'hol is vagyok ?'";
if($_POST[t_uname]!="")$values.=",'".$_POST[t_uname]."'";
	else $values.=",'meg kell kerdezzem a szuleim'";
$values.=",1";
if($_POST[t_nick]!="")$values.=",'".$_POST[t_nick]."'";
	else $values.=",'susu'";
if($_POST[t_passw]!="")$values.=",'".$_POST[t_passw]."'";
	else $values.=",''";
$values.=",''";
if($_POST[t_email]!="")$values.=",'".$_POST[t_email]."'";
	else $values.=",'nem is letezik az internet'";
if($_POST[t_comment]!="")$values.=",'".$_POST[t_comment]."'";
	else $values.=",'Olyan hanyag vagyok ,hogy szinte semmire nem figyelek csak a szorakozasra'";
$values.=",".$refr.",".$show_nr_msgs.")";
//$query="INSERT INTO users (uid, msg_sent, u_group, u_name, u_acces, u_nick, u_passw, nick_style, u_email, u_comment, u_refrt, show_nr_msgs) VALUES (NULL, 0, '".$_POST[t_group]."', '".$_POST[t_uname]."', 1, '".$_POST[t_nick]."','','".$_POST[t_passw]."', '".$_POST[t_email]."','".$_POST[t_comment]."',".$refr.",".$show_nr_msgs.")";
$query="INSERT INTO users (uid, msg_sent, u_group, u_name, u_acces, u_nick, u_passw, nick_style, u_email, u_comment, u_refrt, show_nr_msgs) VALUES ".$values;
$result=search_database($query,"registr_user.php : probalja a usert regisztralni : $query");

//na megerdemli, hogy chateljen
//kerjuk le az ujonnan letrejott id-t
$query="select uid from users where users.u_nick='".$_POST[t_nick]."'";
$result=search_database($query,"registe_user.php : searching 4 user : $query");
$line=mysql_fetch_array($result, MYSQL_ASSOC);
close_database();
$_SESSION[uid]=$line[uid];
?>
<script language="JavaScript" type="text/JavaScript">
	document.location="main.htm";
</script>
