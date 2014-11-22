<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
print("<center><h2><strong>Users that are registered only in system</strong></h2></center><br>");
print("After registration user will be an infan and he's setting will not match with the system settings<br>");
//ask the system to return us the user names
$users=system_get_all_unames();
print("<table border=1");
print("<tr><td><font color=#0000EE><h3>Register User Name ?</h3></font></td></tr>");
open_database();
//separate id's from group names
$ik=0;
foreach($users as $key => $value)
{
	if($key[0]=='i' && $key[1]=='d')$ids[$ik]=$value;
	if($key[0]=='u' && $key[1]=='n')
	{
		$unames[$ik]=$value;
		$ik++;
	}
}
foreach($unames as $key => $value)
	if($value!="")
	{
		//if it's not registered in database then print it
		$query="select uname from users where uname=\"$value\"";
		$result=search_database($query,"get_system_users.php : is this user registered : $query");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		if($line[gname]=="")print("<tr><td><a href='add_user_database.php?uname=".$value."&uid=$ids[$key]' title=\"".$value."\" target='_self'>".$value."</a></td></tr>");
	}
close_database();
print("</table>");
?>
</body>