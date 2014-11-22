<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
print("<center><h2><strong>Select a User from the groups to delete it (removes it from all groups)</strong></h2></center><br>");

print("Registered groups list (selsect one or more to search in them)");
//ahany group van annyit kell aktivalni
print("<form methode='post' target='_self' action='delete_user.php'>");
open_database();
$query="select gname from groups where isadmin=\"0\" order by name asc";
$result = search_database($query);
$ik=0;
$selected[]="";
print("<table border=0 cellpadding='5' cellspacing='5' >");
//print("<table border=0>");
while ( $line = mysql_fetch_array($result, MYSQL_ASSOC)) {
  foreach ($line as $col_value)
	{
		$ik++;
		$temp="ch".$ik;
		if($ik%6 ==0)print("<tr>");
  		//ha a page-et most tolti be eloszor akkor bifalja(avgy nem) mindegyiket
		//masodszor megnezi melyik volt mar bebifalva es azt ugy hagyja
		if(!isset($_REQUEST[secondrun]))print("<td><input type=\"checkbox\" id=\"$temp\" name=\"$temp\" value=\"$temp\">".$col_value."</td>");
			elseif($_REQUEST[$temp]==$temp)
			{
				print("<td><input type=\"checkbox\" id=\"$temp\" name=\"$temp\" checked value=\"$temp\">".$col_value."</td>");
				$selected[$ik]=$col_value;
			}
				else print("<td><input type=\"checkbox\" id=\"$temp\" name=\"$temp\" value=\"$temp\">".$col_value."</td>");
		if($ik%5 ==0)print("</tr>");
	}
    }
print("</table>");	
print("<input type=\"hidden\" id=\"secondrun\" name=\"secondrun\" value=\"secondrun\">");
print("<input type=\"submit\" class=bluebutton value=\"select\"><br>");
print("Search by user name (ex:jo)<br>");
print("<input type=\"text\" name='search_name' id='search_name' value=\"\"><br>");
print("<input type=\"submit\" class=bluebutton value=\"find users\"><br>");


//a kiszelektalt group-okbol(checkboxes) kikeresi a user-eket
//tuzijatek nelkul toroljuk le a kiszelektalt usereket
foreach($selected as $selected_group)
 if(isset($selected_group) && $selected_group!="")
{
	//keressuk ki ezeket az elemeket
	$sql_query="select name,uname,users.uid from users,`".$selected_group."` where users.uid=`".$selected_group."`.uid and name like \"".$search_name."%\" order by name asc";
	$result = search_database($sql_query,"delete_user : delete all users from group the selected group");
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$varname="ch_".$line[uid];
		//ha kivan szelektalva akkor le is torolhetjuk
		if(isset($$varname)) delete_user($line[uid]);
	}
}

print("<table border=1>");
print("<tr><td><font color=#0000EE><h3>D?</h3></font></td><td><font color=#0000EE><h3>Full Name</h3></font></td><td><font color=#0000EE><h3>User Name</h3></font></td></tr>");
foreach($selected as $selected_group)
 if(isset($selected_group) && $selected_group!="")
{
	print("<tr bgcolor=#AACCFF><td></td><td > New group </td><td>".$selected_group."</td></tr>");
	//keressuk ki ezeket az elemeket
	$sql_query="select name,uname,users.uid from users,`".$selected_group."` where users.uid=`".$selected_group."`.uid and name like \"".$search_name."%\" order by name asc";
	$result = search_database($sql_query,"delete_user : list all users from group");
	while ( $line = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		//ez jelenik meg a page-en : checkbox,name,username
		print("<tr>");
		$varname="ch_".$line[uid];
		print("<td><input name=\"$varname\" type=\"checkbox\" class=fontos value=\"\"></td>");
		print("<td>".$line[name]."</td>");
		print("<td>".$line[uname]."</td></tr>");
	}
}
print("</table>");
if(isset($secondrun))print("<input type=\"submit\" class=fontos value=\"Delete selected\">");
print("</form>");
close_database();
?>
</body>