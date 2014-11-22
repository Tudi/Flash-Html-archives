<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
print("<center><h2><strong>Groups that are registered only in system</strong></h2></center><br>");
//include "fuggvenyek.php";
//ask the system to return us the group names
$groups=system_get_all_gnames();
print("<table border=1");
print("<tr><td><font color=#0000EE><h3>Register Group Name ?</h3></font></td></tr>");
open_database();
//separate id's from group names
$ik=0;
foreach($groups as $key => $value)
{
	if($key[0]=='i' && $key[1]=='d')$ids[$ik]=$value;
	if($key[0]=='g' && $key[1]=='n')
	{
		$gnames[$ik]=$value;
		$ik++;
	}
}
foreach($gnames as $key => $value)
	if($value!="")
	{
		//if it's not registered in database then print it
		$query="select gname from groups where gname=\"$value\"";
		$result=search_database($query,"get_system_groups.php : is this group registered : $query");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		if($line[gname]=="")print("<tr><td><a href='add_group_database.php?gname=".$value."&gid=$ids[$key]' title=\"".$value."\" target='_self'>".$value."</a></td></tr>");
	}
close_database();
print("</table>");
?>
</body>