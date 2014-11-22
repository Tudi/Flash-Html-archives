<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
print("<center><h2><strong>Select a Class from the list to view or modify it</strong></h2></center><br>");

//listazza ki a letezo Group-okat es toroljuk a kiszelektaltakat
?>
<Form Name=getgroup method=POST target=_self>
<table border="1">
  <tr> 
    <td height="23" bgcolor="#66FFFF"> <div align="center"><strong>Gid</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Group name</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Full name</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>tname</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Comment</strong></div></td>
    <td bgcolor="#66FFFF"> <div align="center"><strong>Homepath</strong></div></td>
  </tr>
<?php
open_database();
$sql_query="select gid,name,gname,tname,comment,homepath,isadmin from groups where isadmin=\"0\" order by name asc";
$result = search_database($sql_query,"select_group.php : Get all groups and their data : $query");
while ( $line = mysql_fetch_array($result, MYSQL_ASSOC))
	{
			print("<tr>");
			print("<td  align=center><a href='modify_class.php?old_gid=$line[gid]' target='_self'>$line[gid]</a></td>");
			print("<td  align=center><a href='modify_class.php?old_gid=$line[gid]' target='_self'>$line[gname]</a></td>");
			print("<td  align=center><a href='modify_class.php?old_gid=$line[gid]' target='_self'>$line[name]</a></td>");
			print("<td  align=center><a href='modify_class.php?old_gid=$line[gid]' target='_self'>$line[tname]</a></td>");
			print("<td  align=center><a href='modify_class.php?old_gid=$line[gid]' target='_self'>$line[comment]</a></td>");
			print("<td  align=center><a href='modify_class.php?old_gid=$line[gid]' target='_self'>$line[homepath]</a></td>");
			print("</tr>");
	}
print("</table>");
close_database();
?>
</body>