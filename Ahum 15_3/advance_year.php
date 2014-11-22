<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
print("<center><h2><strong>Lists 4 groups to chage content between each other</strong></h2></center><br>");
//include "fuggvenyek.php";
print("<form methode='post' target='_self' action='advance_year.php'>");
print("select source and destination group (!! be carfull at the last class, you shoul start wiht the last class)<br>");
open_database();
//ha az oldal masodszor fut akkor nezzuk meg mit kell csinalni
for($i=1;$i<16;$i++)
{
	$ch="ch".$i;
	$ga="sa_group".$i;
	$gb="sb_group".$i;
	if(${$ch}!="")
	{
		//vegyuk az 1-es group-bol mindegyik usert es rakjukl at a 2-esbe
		$query="select uid from `".$$ga."`";
		$result = search_database($query,"advance_year.php : getting uid-s from group : $query");
		while($line = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			//mindegyik usert atrakjuk a masik group-ba
			//ha user mas group-okban is benne volt akkor ottan fog maradni
			$query2="INSERT INTO `".$$gb."` (uid) VALUES (".$line[uid].")";
			$result2 = search_database($query2,"advance_year.php : adding uid-s to group : $query2");
			$query2="DELETE FROM `".$$ga."` WHERE uid=".$line[uid];
			$result2 = search_database($query2,"advance_year.php : deleting uid-s from group : $query2");
			//a rendszerben 1-szer hozzadjuk az uj group-hoz aztan kivesszuk a regibol
			////////////////////////////SYSTEM CALLL///////////////////////////////////////////////
			$paramv[uid]=$line[uid];
			$paramv[gname]=$$gb;
			system_addto_group($paramv);
			$paramv[gname]=$$ga;
			system_remfrom_group($paramv);
		}
	}
}
print("<table border=1");
print("<tr><td><font color=#0000EE><h3>Select?</h3></font></td><td><font color=#0000EE><h3>Curent year</h3></font></td><td><font color=#0000EE><h3>After advance</h3></font></td></tr>");
//egyelore csak 4 kombinaciot iratunk ki
for($i=1;$i<16;$i++)
{
	$ch="ch".$i;
	$ga="sa_group".$i;
	$gb="sb_group".$i;
	print("<td><input type=\"checkbox\" id=\"".$ch."\" name=\"".$ch."\" value=\"".$ch."\" class=\"fontos\"></td>");
	print("<td><select name=\"".$ga."\" id=\"".$ga."\" class=bluebutton>");
	//ki kell irassuk az oszes (admin nelkul) group nevet
	$query="select gname from groups where isadmin=\"0\" ORDER BY gname desc";
	$result = search_database($query,"advance_year.php : searching for group names $query");
	while($line = mysql_fetch_array($result, MYSQL_ASSOC))
		print("<option value='$line[gname]'>$line[gname]</option>");
	print("</select></td>");
	print("<td><select name=\"".$gb."\" id=\"".$gb."\" class=bluebutton>");
	//ki kell irassuk az oszes (admin nelkul) group nevet
	$query="select gname from groups where isadmin=\"0\" ORDER BY gname desc";
	$result = search_database($query,"advance_year.php : searching for group names $query");
	while($line = mysql_fetch_array($result, MYSQL_ASSOC))
		print("<option value='$line[gname]'>$line[gname]</option>");
	print("</select></td></tr>");
}

print("</table>");
print("<input type=\"submit\" class=redbutton value=\"Advace years\"><br>");
print("</form>");
close_database();
?>
</body>