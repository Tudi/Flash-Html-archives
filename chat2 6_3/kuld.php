<?php session_start() ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>itten jellenek meg a kapott msg-ek</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.strech{
	height: 80%;
	width: 100%;
	margin: 0px;
	padding: 0px;
	top: 0px;
	left: 0px;
	border: 0px none;
}
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
$query="select kuld_style from users where uid=".$_SESSION[uid];
$result=search_database($query,"kuld.php : probalja a kuld style-t lekerdeni : $query");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
close_database();
?>
<body topmargin="0" leftmargin="0">
<form name="form_kuld" id="form_kuld" method="post" action="" class="strech">
  <input type="text"  maxlength="200" name="mit_kuld" id="mit_kuld" class="strech" onkeypress="send_msg_key()" style="<?=$line[kuld_style]?>" value="">
<!--
  <textarea name="mit_kuld" id="mit_kuld" class="strech" onkeyup="send_msg_key()" style="<?=$line[kuld_style]?>"></textarea>
  <input type="button" onClick="send_msg_button()" name="b_send" id="b_send" value="Send" style="height:30%">
-->
</form>

<script language="JavaScript" type="text/JavaScript">

function send_msg_key()
{
 if(event.keyCode==13 || event.keyCode==10)
   send_msg_button();
}

function focus_t()
{
//call this on blurr 
  parent.frame_kuldott.document.form_kuld.mit_kuld.focus();
}

function send_msg_button()
{
  parent.frame_refresh.document.form_refr.kapott.value=document.form_kuld.mit_kuld.value;
  document.form_kuld.mit_kuld.value="";
  parent.frame_refresh.document.form_refr.submit();
  parent.frame_kuldott.document.form_kuld.mit_kuld.focus();
  return;
}
</script>

</body>
</html>
