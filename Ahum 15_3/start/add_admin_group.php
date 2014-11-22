<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
print("<center><h2><strong>Create a new admin group please : input data</strong></h2></center><br>");
//ha a page mar masodszor van feltoltve akkor intezkedjunk a modositasokrol
if(isset($_POST[t_gname]) && isset($_POST[t_tname]) && $_POST[t_tname]!="" && $_POST[t_gname]!="")
{
	$paramv[gid]=$_POST[t_gid];
	$paramv[name]=$_POST[t_name];
	$paramv[gname]=$_POST[t_gname];
	$paramv[comment]=$_POST[t_comment];
	$paramv[tname]=$_POST[t_tname];
	$paramv[homepath]=$_POST[t_homepath];
	$paramv[isadmin]=$_POST[t_isadmin];
	open_database();
	add_group($paramv);
	close_database();
}

//listazza ki a letezo Group-okat
print("Existing Group Names : <br>");
?>
<table border="1">
  <tr> 
    <td height="23" bgcolor="#66FFFF"> <div align="center"><strong>gid</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Group name</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Full name</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>tname</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Comment</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Homepath</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Isadmin</strong></div></td>
  </tr>
<?php
open_database();
$sql_query="select isadmin,gid,name,gname,tname,comment,homepath from groups order by name asc";
$result = search_database($sql_query);
while ( $line = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		print("<tr>");
		print("<td>".$line[gid]."</td>");
		print("<td>".$line[gname]."</td>");
		print("<td>".$line[name]."</td>");
		print("<td>".$line[tname]."</td>");
		print("<td>".$line[comment]."</td>");
		print("<td>".$line[homepath]."</td>");
		print("<td>".$line[isadmin]."</td>");
	}
print("</table>");
close_database();
//kerdezzuk meg az uj group adatait : name, tname ,gid,comment,homepath
?>
<Form Name=getgroupinfo method=POST Action=add_admin_group.php target=_self>
Please input the new data : <br>
<input type=button onClick='checkfill()' name=submit_data class=greenbutton value="Register Group">
<table border=1>
	<tr><td>Group Name (requered unique): </td><td><input type=text name=t_gname class=fontos value=""></td></tr>
	<tr><td>tName (requred): </td><td><input type=text name=t_tname class=fontos value=""></td></tr>
	<tr><td>Homepath (requred): </td><td><input type=text name=t_homepath class=fontos value="<?=getct("homepath")?>"></td></tr>
	<tr><td>Group ID (autofill=unique): </td><td><input type=text name=t_gid class=autofill value="<?=find_mingid()?>"></td></tr>
	<tr><td>Full Name (autofill=gname): </td><td><input type=text name=t_name class=autofill value="<?=getct("noconfig")?>"></td></tr>
	<tr><td>Comment (autofill=noconfig): </td><td><input type=text name=t_comment class=autofill value="<?=getct("comment")?>"></td></tr>
	<tr><td>Isadmin (autofill=defined): </td><td><input type=text name=t_isadmin class=autofill value="1"></td></tr>
</table>
<input type=button onClick='checkfill()' name=submit_data class=greenbutton value="Register Group">
</form>
</body>
<script language="JavaScript1.2" type="text/JavaScript">
 function checkfill() 
  {
		var a = document.getgroupinfo;
		if (a.t_gname.value == "") { alert ("Please, choose a Group name !"); a.t_gname.focus(); return; }
		if (a.t_tname.value == "") { alert ("Please, choose a tname name !"); a.t_tname.focus(); return; }
		if (a.t_homepath.value == "") { alert ("Please, choose a homepath name !"); a.t_homepath.focus(); return; }
		a.submit();  }
</script>
