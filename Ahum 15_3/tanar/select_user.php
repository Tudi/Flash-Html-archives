<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
print("<center><h2><strong>Display's selected user's information</strong></h2></center><br>");
//include "fuggvenyek.php";

print("Registered groups list (selsect one or more to search in them)");
//ahany group van annyit kell aktivalni
print("<form methode='post' target='_self' action='select_user.php'>");
open_database();
$query="select gname from groups where isadmin=\"0\" order by name asc";
$result = search_database($query);
$ik=0;
print("<table border=0 cellpadding='5' cellspacing='5' >");
//print("<table border=0>");
while ( $line = mysql_fetch_array($result, MYSQL_ASSOC)) {
  foreach ($line as $col_value)
	{
		$ik++;
		$temp="ch".$ik;
		if($ik%6 ==0)print("<tr>");
		//az adminok meg egymast se kell latjak
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
print("</form>");


//a kiszelektalt group-okbol(checkboxes) kikeresi a user-eket
print("<table border=1");
//print("<tr><td><font color=#0000EE><h3>Full Name</h3></font></td><td><font color=#0000EE><h3>User Name</h3></font></td></tr>");
print("<tr><td><center><font color=#0000EE><h3>Full Name</center></font></h3></td>".
	   "<td><center><font color=#0000EE><h3>username</center></font></h3></td>".
	   "<td><center><font color=#0000EE><h3>passw</center></font></h3></td>".
	   "</tr>");
$selected[]="";
foreach($selected as $selected_group)
 if($selected_group!="")
{
	print("<tr bgcolor=#AACCFF><td > New group </td><td>".$selected_group."</td><td></td></tr>");
	//keressuk ki ezeket az elemeket
	$sql_query="select passw,name,uname,users.uid from users,`".$selected_group."` where users.uid=`".$selected_group."`.uid and name like \"".$search_name."%\" order by name asc";
	$result = search_database($sql_query,"select_user.php : get the user's informations ? : $query");
	while ( $line = mysql_fetch_array($result, MYSQL_ASSOC))
		print("<tr><td><strong>".$line[name]."</td><td><strong>".$line[uname]."</td><td><strong>".$line[passw]."</td><td></tr>");
}
print("</table>");
close_database();
?>
</body>