<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Modify user's personal information login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style2 {font-size: 18px}
-->
</style>
</head>

<body>
<br><br><br><br>
<form action="modify_userinfo.php" method="post" name="Login page" target="_self">
<center>
	<p class="style2">Input user for wich userinfo should be modifyed </p>
	<table width="25%" border="0">
	  <tr>
    	<td width="18%"> <div align="right"><strong>User:</strong></div></td>
	    <td width="82%"><input name="s_user" type="text" id="s_user" size="30" maxlength="30" value="<?=$_GET[uname];?>"></td>
	  </tr>
	  <tr>
	    <td><div align="right"><strong>Password</strong></div></td>
	    <td><input name="s_passw" type="password" id="s_passw" size="30" maxlength="30"></td>
	  </tr>
	</table>
    <p>
      <input name="b_login" type="submit" id="b_login" value="Login">
    </p>
  </center>
</form>
</body>
</html>
