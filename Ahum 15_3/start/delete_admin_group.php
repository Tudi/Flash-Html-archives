<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
print("<center><h2><strong>Select a group from the list to delete it</strong></h2></center><br>");

//listazza ki a letezo Group-okat es toroljuk a kiszelektaltakat
?>
<Form Name=getgroup method=POST Action=delete_admin_group.php target=_self>
<input name="del_content" type="checkbox" class=fontos value="" checked>  Delete users from the group ?(Also deletes users from other groups to) <br>
<table border="1">
  <tr> 
    <td height="23" bgcolor="#66FFFF"> <div align="center"><strong>D?</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Gid</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Group name</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Full name</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>tname</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Comment</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Homepath</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Isadmin</strong></div></td>
  </tr>
<?php
open_database();
$sql_query="select gid,name,gname,tname,comment,homepath,isadmin from groups order by name asc";
$result = search_database($sql_query);
while ( $line = mysql_fetch_array($result, MYSQL_ASSOC))
  {
	//ez csak akkor hajtodik vegra mitan megnyomtuk a "delete selected gombot es volt valami kiszelektalva
	if(isset(${$line[gname]}))
	//szoval ez a group ki volt szelektalva es le kell torolni
		delete_group($line[gid],$line[gname],$_POST[del_content]);
	else 
	{
		print("<tr>");
		print("<td><input name=\"$line[gname]\" type=\"checkbox\" class=fontos value=\"\"></td>");
		print("<td>".$line[gid]."</td>");
		print("<td>".$line[gname]."</td>");
		print("<td>".$line[name]."</td>");
		print("<td>".$line[tname]."</td>");
		print("<td>".$line[comment]."</td>");
		print("<td>".$line[homepath]."</td>");
		print("<td>".$line[isadmin]."</td>");
	}
  }
print("</table>");
print("<br>");
print("<input type=\"submit\" class=fontos value=\"Delete selected\"><br>");
close_database();
?>
</body>