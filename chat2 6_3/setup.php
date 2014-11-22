<?php session_start(); 
$_SESSION[last_msg_id]=0;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Beallitasok a chat kinezetevel kapcsolatosan</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<?php 
	include "fuggvenyek.php";
	include "config.php";
	//allitsuk osszea a style-t
	if(isset($_POST[kapott]) && $_POST[kapott]=="ok")
	{
		$style="";
		foreach($_POST as $key => $value)
			if($key!="kapott" && $key!="b_submit_kapott" && $value!=" " && $value!="")
				$style.=$key.":".$value.";";
		$style=substr($style,0,strlen($style)-1);
		open_database();
		$query="UPDATE users SET kapott_style='".$style."' WHERE uid=".$_SESSION[uid];
		$result=search_database($query,"setup.php : updating msg apearence settings : $query");
		close_database();
	}
	if(isset($_POST[kuldott]) && $_POST[kuldott]=="ok")
	{
		$style="";
		foreach($_POST as $key => $value)
			if($key!="kuldott" && $key!="b_submit_kuldott" && $value!=" " && $value!="")
				$style.=$key.":".$value.";";
		$style=substr($style,0,strlen($style)-1);
		open_database();
		$query="UPDATE users SET kuld_style='".$style."' WHERE uid=".$_SESSION[uid];
		$result=search_database($query,"setup.php : updating msg send apearence settings : $query");
		close_database();
	}
	if(isset($_POST[nick]) && $_POST[nick]=="ok")
	{
		$style="";
		foreach($_POST as $key => $value)
			if($key!="nick" && $key!="b_submit_nick" && $value!=" " && $value!="")
				$style.=$key.":".$value.";";
		$style=substr($style,0,strlen($style)-1);
		open_database();
		$query="UPDATE users SET nick_style='".$style."' WHERE uid=".$_SESSION[uid];
		$result=search_database($query,"setup.php : updating nick apearence settings : $query");
		close_database();
	}
	if(isset($_POST[user]) && $_POST[user]=="ok")
	{
		$what="";
		foreach($_POST as $key => $value)
			if($key!="user" && $key!="b_submit_user" && $value!=" " && $value!="")
				$what.=$key."='".$value."',";
		$what=substr($what,0,strlen($what)-1);
		open_database();
		$query="UPDATE users SET ".$what." WHERE uid=".$_SESSION[uid];
		$result=search_database($query,"setup.php : updating user settings : $query");
		close_database();
	}
open_database();
$query2="select u_group,u_name,u_email,u_comment,u_refrt,show_nr_msgs,u_passw from users where users.uid=".$_SESSION[uid];
$result2=search_database($query2,"setup.php : a user adatait probalja lekerni : $query2");
$line2 = mysql_fetch_array($result2, MYSQL_ASSOC);
close_database();
?>
<p align="center" class="style1">Kapott uzenetekre szolo bealitasok</p>
<form action="setup.php" method="post" name="setup_kapott_msgs" id="setup_kapott_msgs">
  <p>Select Font type : 
    <select name="font-family" id="font-family">
      <option> </option>
      <option>&quot;Times New Roman&quot;, Times, serif</option>
      <option>Arial, Helvetica, sans-serif</option>
      <option>&quot;Courier New&quot;, Courier, mono</option>
      <option>Georgia, &quot;Times New Roman&quot;, Times, serif</option>
      <option>Verdana, Arial, Helvetica, sans-serif</option>
      <option>Geneva, Arial, Helvetica, sans-serif</option>
    </select>
  </p>
  <p>Select Font size : 
    <select name="font-size" id="font-size">
      <option> </option>
      <option>9</option>
      <option>12</option>
      <option>14</option>
      <option>18</option>
      <option>22</option>
    </select>
</p>
  <p>Select Font color : 
    <select name="color" id="color">
      <option> </option>
      <option>black</option>
      <option>silver</option>
      <option>gray</option>
      <option>white</option>
      <option>maroon</option>
      <option>red</option>
      <option>purple</option>
      <option>fuchsia</option>
      <option>green</option>
      <option>lime</option>
      <option>olive</option>
      <option>yellow</option>
      <option>navy</option>
      <option>blue</option>
      <option>teal</option>
      <option>aqua</option>
    </select>
</p>
  <p>Select Background color : 
      <select name="background-color" id="background-color">
        <option> </option>
      <option>black</option>
      <option>silver</option>
      <option>gray</option>
      <option>white</option>
      <option>maroon</option>
      <option>red</option>
      <option>purple</option>
      <option>fuchsia</option>
      <option>green</option>
      <option>lime</option>
      <option>olive</option>
      <option>yellow</option>
      <option>navy</option>
      <option>blue</option>
      <option>teal</option>
      <option>aqua</option>
      </select>
      <input name="kapott" type="hidden" id="kapott" value="ok">
  </p>
  <p>
    <input name="b_submit_kapott" type="submit" id="b_submit_kapott" value="Hasznalja bealiasokat">
    <input name="back" type="button" id="back" onClick="MM_goToURL('parent','main.htm');return document.MM_returnValue" value="Vissza a chathez">
</p>
</form>
<p>&nbsp;</p>
<p align="center" class="style1">Kuldesre kesz uzenetek kinezetenek beallitasa</p>
<form action="setup.php" method="post" name="setup_kuldott_msgs" id="setup_kuldott_msgs">
  <p>Select Font type : 
    <select name="font-family" id="font-family">
      <option selected> </option>
      <option>&quot;Times New Roman&quot;, Times, serif</option>
      <option>Arial, Helvetica, sans-serif</option>
      <option>&quot;Courier New&quot;, Courier, mono</option>
      <option>Georgia, &quot;Times New Roman&quot;, Times, serif</option>
      <option>Verdana, Arial, Helvetica, sans-serif</option>
      <option>Geneva, Arial, Helvetica, sans-serif</option>
    </select>
  </p>
  <p>Select Font size : 
    <select name="font-size" id="font-size">
      <option> </option>
      <option>9</option>
      <option>12</option>
      <option>14</option>
      <option>18</option>
      <option>22</option>
    </select>
</p>
  <p>Select Font color : 
    <select name="color" id="color">
      <option> </option>
      <option>black</option>
      <option>silver</option>
      <option>gray</option>
      <option>white</option>
      <option>maroon</option>
      <option>red</option>
      <option>purple</option>
      <option>fuchsia</option>
      <option>green</option>
      <option>lime</option>
      <option>olive</option>
      <option>yellow</option>
      <option>navy</option>
      <option>blue</option>
      <option>teal</option>
      <option>aqua</option>
    </select>
</p>
  <p>Select Background color : 
      <select name="background-color" id="background-color">
        <option> </option>
      <option>black</option>
      <option>silver</option>
      <option>gray</option>
      <option>white</option>
      <option>maroon</option>
      <option>red</option>
      <option>purple</option>
      <option>fuchsia</option>
      <option>green</option>
      <option>lime</option>
      <option>olive</option>
      <option>yellow</option>
      <option>navy</option>
      <option>blue</option>
      <option>teal</option>
      <option>aqua</option>
      </select>
      <input name="kuldott" type="hidden" id="kuldott" value="ok">
  </p>
  <p>
    <input name="b_submit_kapott" type="submit" id="b_submit_kapott" value="Hasznalja bealiasokat">
    <input name="back" type="button" id="back" onClick="MM_goToURL('parent','main.htm');return document.MM_returnValue" value="Vissza a chathez">
</p>
</form>
<p align="center" class="style1">Nick kinezetenek beallitasa</p>
<form action="setup.php" method="post" name="setup_nick" id="setup_nick">
  <p>Select Font type : 
    <select name="font-family" id="font-family">
      <option> </option>
      <option>&quot;Times New Roman&quot;, Times, serif</option>
      <option>Arial, Helvetica, sans-serif</option>
      <option>&quot;Courier New&quot;, Courier, mono</option>
      <option>Georgia, &quot;Times New Roman&quot;, Times, serif</option>
      <option>Verdana, Arial, Helvetica, sans-serif</option>
      <option>Geneva, Arial, Helvetica, sans-serif</option>
    </select>
  </p>
  <p>Select Font size : 
    <select name="font-size" id="font-size">
      <option> </option>
      <option>9</option>
      <option>12</option>
      <option>14</option>
      <option>18</option>
      <option>22</option>
    </select>
</p>
  <p>Select Font color : 
    <select name="color" id="color">
      <option> </option>
      <option>black</option>
      <option>silver</option>
      <option>gray</option>
      <option>white</option>
      <option>maroon</option>
      <option>red</option>
      <option>purple</option>
      <option>fuchsia</option>
      <option>green</option>
      <option>lime</option>
      <option>olive</option>
      <option>yellow</option>
      <option>navy</option>
      <option>blue</option>
      <option>teal</option>
      <option>aqua</option>
    </select>
</p>
  <p>Select Background color : 
      <select name="background-color" id="background-color">
        <option> </option>
      <option>black</option>
      <option>silver</option>
      <option>gray</option>
      <option>white</option>
      <option>maroon</option>
      <option>red</option>
      <option>purple</option>
      <option>fuchsia</option>
      <option>green</option>
      <option>lime</option>
      <option>olive</option>
      <option>yellow</option>
      <option>navy</option>
      <option>blue</option>
      <option>teal</option>
      <option>aqua</option>
      </select>
      <input name="nick" type="hidden" id="nick" value="ok">
  </p>
  <p>
    <input name="b_submit_nick" type="submit" id="b_submit_nick" value="Hasznalja bealiasokat">
    <input name="back" type="button" id="back" onClick="MM_goToURL('parent','main.htm');return document.MM_returnValue" value="Vissza a chathez">
</p>
</form>
<p align="center" class="style1">User-re vonatkozo beallitasok</p>
<form action="setup.php" method="post" name="setup" id="setup">
  <p>Teljes nev : 
    <input name="u_name" type="text" id="u_name" value="<?=$line2[u_name];?>" size="50" >
  </p>
  <p>Email : 
    <input name="u_email" type="text" id="u_email" value="<?=$line2[u_email];?>" size="50" >
  </p>
  <p>Comment : 
    <input name="u_comment" type="text" id="u_comment" value="<?=$line2[u_comment];?>" size="50" >
</p>
  <p>Frisitesi ido : 
    <input name="u_refrt" type="text" id="u_refrt" value="<?=$line2[u_refrt];?>" size="50" >
</p>
  <p>Hany uzenetet kerjen le : 
    <input name="show_nr_msgs" type="text" id="show_nr_msgs" value="<?=$line2[show_nr_msgs];?>" size="50" >
</p>
  <p>Jelszo : 
    <input name="u_passw" type="text" id="u_passw" value="<?=$line2[u_passw];?>" size="50" >
</p>
  <p>Csoport : 
    <input name="u_group" type="text" id="u_group" value="<?=$line2[u_group];?>" size="50" >
    <input name="user" type="hidden" id="user" value="ok">
  </p>
  <p>
    <input name="b_submit_user" type="submit" id="b_submit_user" value="Hasznalja bealiasokat">
    <input name="back" type="button" id="back" onClick="MM_goToURL('parent','main.htm');return document.MM_returnValue" value="Vissza a chathez">
</p>
</form>
</body>
</html>
