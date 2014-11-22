<?php
include "fuggvenyek.php";
//eseleg ha maradtak userek akik nincsnek 1 group-ba beleteve azokat listazza ki
print("A list of all user that don't belong to any of the groups : ");
print("<form method=\"post\" target=\"midleFrame\" action=\"detect_errors.php?param=infan\">");
print("	<input type=\"submit\" value=\"Infans\">");
print("</form>");
// ha vannak userek akik tobb group-ban megvannak azokat listazza ki
print("A list of the users who belong to more than one group : <br> ");
print("<form method=\"post\" target=\"midleFrame\" action=\"detect_errors.php?param=multi\">");
print("	<input type=\"submit\" value=\" Multi \">");
print("</form>");

//attol fuggoen mit valasztasz azt fogja megkeresni

//infan : mindegyik usert sorra veszi aztan megnezi melyik grouphoz tartozik
//ha egyikhez sem akkor infan
if(isset($param) and $param=="infan")
{
	open_database();
	$sql_query="select id,name,uname from users order by users.name asc";
	$result = mysql_query($sql_query) or die("Query failed : " . mysql_error());
	print("<table width=100% border=0 bordercolor=#000000 bgcolor=#CCffFF>");
	print("<tr><td><font color=#0000EE><h3>Full Name</h3></font></td><td><font color=#0000EE><h3>User Name</h3></font></td></tr>");
	while ( $line = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$t=searchgroup($line[id],"id");
		if($t[0]<=1)
		{
			print("<tr><td><a href='user_info.php?user_id=$line[id]' title=\"".$line[name]."\" target='rightFrame'>$line[name]</a></td>");
			print("<td><a href='user_info.php?user_id=$line[id]' title=\"".$lien[uname]."\" target='rightFrame'>$line[uname]</a></td></tr>");
		}
	}
	print("</table>");
//	close_database();
}

//multi : mindegyik usert sorra veszi aztan megnezi melyik grouphoz tartozik ha tobbhoz akkor erornak veszi
//(jelenleg egyaltalan nincs szukseg,hogy tobb groupban reszt vegyen 1 user)
if(isset($param) and $param=="multi")
{
	open_database();
	$sql_query="select id,name,uname from users order by users.name asc";
	$result = mysql_query($sql_query) or die("Query failed : " . mysql_error());
	print("<table width=100% border=0 bordercolor=#000000 bgcolor=#CCffFF>");
	print("<tr><td><font color=#0000EE><h3>Full Name</h3></font></td><td><font color=#0000EE><h3>User Name</h3></font></td></tr>");
	while ( $line = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$t=searchgroup($line[id],"id");
		if($t[0]>2)
		{
			print("<tr><td><a href='user_info.php?user_id=$line[id]' title=\"".$line[name]."\" target='rightFrame'>$line[name]</a></td>");
			print("<td><a href='user_info.php?user_id=$line[id]' title=\"".$lien[uname]."\" target='rightFrame'>$line[uname]</a></td></tr>");
		}
	}
	print("</table>");
//	close_database();
}
?>