<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
print("<center><h2><strong>Lists users (to modify) that do not belong to any group at all</strong></h2></center><br>");
//include "fuggvenyek.php";
print("<form methode='post' target='_self' action='find_infans.php'>");
print("select a group to wich the selected infans shpuld be moved<br>");
print("<select name=\"s_group\" id=\"s_group\" class=fontos>");
//ki kell irassuk az oszes (admin nelkul) group nevet
open_database();
$query="select gname from groups where isadmin=\"0\" ORDER BY gname desc";
$result = search_database($query,"add_user.php : searching for group names $query");
while($line = mysql_fetch_array($result, MYSQL_ASSOC))
    print("<option value='$line[gname]'>$line[gname]</option>");
print("</select><br>List of infans : <br>");
//vegigmegyunk minden user-en es megnezzuk van-e 1 olyan group amelyben benne van ha nincs akkor infan
print("<table border=1");
print("<tr><td><font color=#0000EE><h3>Full Name</h3></font></td><td><font color=#0000EE><h3>User Name</h3></font></td><td><font color=#0000EE><h3>Select ?</h3></font></td></tr>");
//kerjuk le az osszes group nevet
$query="select gname from groups";
$result=search_database($query,"find_infans.php: kerjuk le az osszes group nevet : $query");
while ( $line = mysql_fetch_array($result, MYSQL_ASSOC))
	$groups[$line[gname]]=$line[gname];
//kerjuk le az osszes user id-jet
$query="select name,uname,uid from users";
$result=search_database($query,"find_infans.php: kerjuk le az osszes user id-jat : $query");
while ( $line = mysql_fetch_array($result, MYSQL_ASSOC))
{
	//sorraveszunk minden group-ot a listabol es megnezzuk valamelyikben regisztralva van-e ?
	$isregistered=0;
	foreach($groups as $value)
	{
		$query2="select uid from `".$value."` where uid=".$line[uid];
		$result2=search_database($query2,"find_infans.php: nezzuk meg sorra van-e registralva valamelyik group-ban : $query2");
		$line2 = mysql_fetch_array($result2, MYSQL_ASSOC);
		if($line2[uid]!="")$isregistered=1;
	}
	if($isregistered==0)
	{
		//ha masodszor van az oldal futtatva akkor nezzuk meg melyik infan-t kell group-ba tenni es tegyuk is be
		if(isset($$line[uname]) && $$line[uname]!="")
		{
			$query3="INSERT INTO `".$s_group."` (uid) VALUES (".$line[uid].")";
			$result3=search_database($query3,"find_infans.php: regisztraljuk a group-ban : $query3");
		}
			else 
			{
				print("<tr><td><a href='modify_user.php?uid=$line[uid]' title=\"".$line[name]."\" target='_self'>$line[name]</a></td>");
				print("<td><a href='modify_user.php?uid=$line[uid]' title=\"".$line[uname]."\" target='_self'>$line[uname]</a></td>");
				print("<td><input type=\"checkbox\" id=\"$line[uname]\" name=\"$line[uname]\" checked value=\"$line[uname]\" class=\"fontos\"></td></tr>");
			}
	}
}
print("</table>");
print("<input type=\"submit\" class=redbutton value=\"Move users\"><br>");
print("</form>");
close_database();
?>
</body>