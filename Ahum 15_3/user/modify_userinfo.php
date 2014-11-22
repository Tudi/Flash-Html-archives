<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=1, pre-check=1", false);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Edit users personal information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-size: 18px}
-->
</style></head>

<body  bgcolor="#ccffff">
<?php include "fuggvenyek.php";
open_database();
//let's see if user is registered in database
$user_acces=getct(no_acces);
$query="select uid from users where users.uname=\"$s_user\" and users.passw=\"$s_passw\"";
$result = search_database($query,"get acces code : is the user registred with this password ? : $query");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$uid=$line[uid];
if(isset($uid) && $uid!="")
		$user_acces=getct(user_acces);
//if user is not registered then we go to the login screen again
if($user_acces==getct(no_acces))
{
	?>
	<script>
	alert("Incorect user or password: <?=$user_acces?>\n\n Please log in again.")
	history.back();
	</script>
	<?php
	exit;
}
//if this is the second time when it runs then make modifications
if(isset($_POST[uid]))
{
	$field="";
	foreach($_POST as $key => $value)
		if($key[0]=='t' && $key[1]=='i' && $value!="")
				$field.=substr($key,3,strlen($key))."=\"".$value."\",";
	if(isset($_POST[c_ispublic]))
		$field.="ispublic=1";
		else $field.="ispublic=0";
	//modositsuk meg az adatbazisban a userinfo-t
	$query="UPDATE user_info SET ".$field." where uid=".$uid;
	$result=search_database($query,"modify_userinfo.php : update userinfo information : $query");
	//modositsuk meg az adatbazisban es a system-ben a user password-jat
	if($s_passw!=$_POST[tu_passw])
	{
		$query="UPDATE users SET passw=\"".$_POST[tu_passw]."\" where uid=".$uid;
		$result=search_database($query,"modify_userinfo.php : update user's passw : $query");
		$s_passw=$_POST[tu_passw];
		//////////////////////////////////SYStem Call//////////////////////////////
		$paramv[passw]=$_POST[tu_passw];
		$paramv[uid]=$uid;
		$paramv[uname]=$s_user;
		system_mod_user($paramv);
	}
}
//user is registered so we ask the database for informations registered for the user
$query="select name,uname,passw from users where users.uid=$uid";
$result = search_database($query,"modify_userinfo.php : get the user's informations ? : $query");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$query="select fax,BI_seria,BI_numar,CNP,adresa1,adresa2,tel1,tel2,email1,email2,ispublic,comment from user_info where uid=$uid";
$result2 = search_database($query,"modify_userinfo.php : get the user's informations ? : $query");
$line2 = mysql_fetch_array($result2, MYSQL_ASSOC);
close_database();
?>
<p align="center"><strong><span class="style1">Modify user's personal information </span></strong></p>
<form name="f_get_userinfo" method="post" action="modify_userinfo.php">
<input name="uid" type="hidden" value="<?=$uid?>">
<input name="s_user" type="hidden" value="<?=$s_user?>">
<input name="s_passw" type="hidden" value="<?=$s_passw?>">
<input name="b_submit2" type="submit" id="b_submit2" value="Make Changes" class="bluebutton">
<table width="100%"  border="1">
  <tr>
    <td width="30%">Full Name : </td>
    <td width="70%"><label><?=$line[name]?></label>&nbsp;</td>
  </tr>
  <tr>
    <td>Username : </td>
    <td><label><?=$line[uname]?></label>&nbsp;</td>
  </tr>
  <tr>
    <td>Password : </td>
    <td><input name="tu_passw" type="text" id="tu_passw" size="20" maxlength="50" value="<?=$line[passw]?>" ></td>
  </tr>
  <tr>
    <td>BI seria : </td>
    <td><input name="ti_BI_seria" type="text" id="ti_BI_seria" size="2" maxlength="2" value="<?=$line2[BI_seria]?>" ></td>
  </tr>
  <tr>
    <td>BI numar </td>
    <td><input name="ti_BI_numar" type="text" id="ti_BI_numar" size="6" maxlength="6" value="<?=$line2[BI_numar]?>" ></td>
  </tr>
  <tr>
    <td>CNP</td>
    <td><input name="ti_CNP" type="text" id="ti_CNP" value="<?=$line2[CNP]?>" size="13" maxlength="13" ></td>
  </tr>
  <tr>
    <td>Adress 1 (localitate, str, nr, bloc, scara, etaj, ap, judet/sector, cod postal, casuta postala) : </td>
    <td><input name="ti_adresa1" type="text" id="ti_adresa1" size="50" maxlength="250" value="<?=$line2[adresa1]?>" ></td>
  </tr>
  <tr>
    <td>Adress 2 (localitate, str, nr, bloc, scara, etaj, ap, judet/sector, cod postal, casuta postala) : </td>
    <td><input name="ti_adresa2" type="text" id="ti_adresa2" size="50" maxlength="250" value="<?=$line2[adresa2]?>" ></td>
  </tr>
  <tr>
    <td>tel 1 : </td>
    <td><input name="ti_tel1" type="text" id="ti_tel1" size="20" maxlength="20" value="<?=$line2[tel1]?>" ></td>
  </tr>
  <tr>
    <td>tel 2 : </td>
    <td><input name="ti_tel2" type="text" id="ti_tel2" size="20" maxlength="20" value="<?=$line2[tel2]?>" ></td>
  </tr>
  <tr>
    <td>Fax : </td>
    <td><input name="ti_fax" type="text" id="ti_fax" size="20" maxlength="20" value="<?=$line2[fax]?>" ></td>
  </tr>
  <tr>
    <td>email 1 : </td>
    <td><input name="ti_email1" type="text" id="ti_email1" size="30" maxlength="50" value="<?=$line2[email1]?>" ></td>
  </tr>
  <tr>
    <td>email 2 : </td>
    <td><input name="ti_email2" type="text" id="ti_email2" size="30" maxlength="50" value="<?=$line2[email2]?>" ></td>
  </tr>
  <tr>
    <td>ispublic ? (others will se only comment) </td>
    <td><input name="c_ispublic" type="checkbox" id="c_ispublic" value="checkbox" <?php if($line2[ispublic]==1)print("checked");?>></td>
  </tr>
  <tr>
    <td>Comment : </td>
    <td><textarea name="ti_comment" cols="50" rows="10" id="ti_comment" ><?=$line2[comment]?></textarea></td>
  </tr>
</table>
<p>
  <input name="b_submit" type="submit" id="b_submit" value="Make Changes"  class="bluebutton">
</p>
</form>
</body>
</html>
