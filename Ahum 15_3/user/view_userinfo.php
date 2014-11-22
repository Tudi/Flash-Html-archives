<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=1, pre-check=1", false);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>View users personal information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-size: 18px}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function pg_back() 
{ //v2.0
  history.back();
}
//-->
</script>
</head>

<body  bgcolor="#ccffff">
<?php include "fuggvenyek.php";
open_database();
//user is registered so we ask the database for informations registered for the user
$query="select name,uname from users where users.uid=$uid";
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
<input name="b_submit2" type="button" class="bluebutton" id="b_submit2" onClick="pg_back()" value="Make Changes">
<table width="100%"  border="1">
  <tr>
    <td width="30%">Full Name : </td>
    <td width="70%"><label><?=$line[name]?></label>&nbsp;</td>
  </tr>
  <tr>
    <td>Username : </td>
    <td><label><?=$line[uname]?></label>&nbsp;</td>
  </tr>
  <?php if($line2[ispublic]==1) { ?>
  <tr>
    <td>BI seria : </td>
    <td><?=$line2[BI_seria]?></td>
  </tr>
  <tr>
    <td>BI numar </td>
    <td><?=$line2[BI_numar]?></td>
  </tr>
  <tr>
    <td>CNP</td>
    <td><?=$line2[CNP]?></td>
  </tr>
  <tr>
    <td>Adress 1 (localitate, str, nr, bloc, scara, etaj, ap, judet/sector, cod postal, casuta postala) : </td>
    <td><?=$line2[adresa1]?></td>
  </tr>
  <tr>
    <td>Adress 2 (localitate, str, nr, bloc, scara, etaj, ap, judet/sector, cod postal, casuta postala) : </td>
    <td><?=$line2[adresa2]?></td>
  </tr>
  <tr>
    <td>tel 1 : </td>
    <td><?=$line2[tel1]?></td>
  </tr>
  <tr>
    <td>tel 2 : </td>
    <td><?=$line2[tel2]?></td>
  </tr>
  <tr>
    <td>Fax : </td>
    <td><?=$line2[fax]?></td>
  </tr>
  <tr>
    <td>email 1 : </td>
    <td><?=$line2[email1]?></td>
  </tr>
  <tr>
    <td>email 2 : </td>
    <td><?=$line2[email2]?></td>
  </tr>
  <?php } ?>
  <tr>
    <td>Comment : </td>
    <td><?=$line2[comment]?></td>
  </tr>
</table>
<p>
  <input name="b_submit" type="button"  class="bluebutton" id="b_submit" onClick="pg_back()" value="Make Changes">
</p>
</form>
</body>
</html>
