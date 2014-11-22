<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
print("<center><h2><strong>Displaying a users information to modify</strong></h2></center><br>");
// ha az ertekek valtoztak akkor modositsuk meg az adatbazisban is (az azelotti page ertekei)
if(isset($_POST[name]))
{
	open_database();
	modify_user($user_id,$_POST);
	close_database();
	print("<h2>Changes have been made , displaying new data </h2>");
}

//szimplan az adatbazis ertekei szerint irasuk ki az ertekeket - ezt a reszt mindig megcsinalja
open_database();
$fieldlist="uid,name,uname,passw,quota,quotaf,p_min,p_max,expire,inactive,forcepw,email,comment,".
					"skeletonpath,shellpath,samba,homepath";
$query="select ".$fieldlist." from users where uid=$user_id";
$result = search_database($query,"mod_user.php : displaying user atributes ");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
close_database();
print("<Form Name=getuserinfo method=POST Action=modify_admin_user.php?user_id=$user_id target=_self>");
print("<table border=1");
print("<tr><td>Full Name : </td><td><input type='text' name='name' value=\"".$line[name]."\"></td></tr>");
print("<tr><td>User Name(unique) : </td><td><input type='text' name='uname' value=\"".$line[uname]."\"></td></tr>");
print("<tr><td>user id(unique) : </td><td><input type='text' class='fontos' name='uid' value=\"".$line[uid]."\"></td></tr>");
print("<tr><td>Password : </td><td><input type='text' name='passw' id='passw' value=\"".$line[passw]."\"></td></tr>");
print("<tr><td>Days till passw can be changed : </td><td><input type='text' name='p_min' value=\"".$line[p_min]."\"></td></tr>");
print("<tr><td>Days before passw must change : </td><td><input type='text' name='p_max' value=\"".$line[p_max]."\"></td></tr>");
print("<tr><td>Days before acount inactive : </td><td><input type='text' name='inactive' value=\"".$line[inactive]."\"></td></tr>");
print("<tr><td>Date when acount expires : </td><td><input type='text' name='expire' value=\"".$line[expire]."\"></td></tr>");
print("<tr><td>Force user to change password : </td><td><input type='text' name='forcepw' value=\"".$line[forcepw]."\"></td></tr>");
print("<tr><td>Quota (MB): </td><td><input type='text' name='quota' value=\"".$line[quota]."\"></td></tr>");
print("<tr><td>Quota files : </td><td><input type='text' name='quotaf' value=\"".$line[quotaf]."\"></td></tr>");
print("<tr><td>Email : </td><td><input type='text' name='email' value=\"".$line[email]."\"></td></tr>");
print("<tr><td>Samba : </td><td><input type='text' name='samba' value=\"".$line[samba]."\"></td></tr>");
print("<tr><td>Skeleton path : </td><td><input type='text' name='skeletonpath' value=\"".$line[skeletonpath]."\"></td></tr>");
print("<tr><td>Shell Path : </td><td><input type='text' name='shellpath' value=\"".$line[shellpath]."\"></td></tr>");
print("<tr><td>Home Path : </td><td><input type='text' name='homepath' value=\"".$line[homepath]."\"></td></tr>");
print("<tr><td>Comment : </td><td><input type='text' name='comment' value=\"".$line[comment]."\"></td></tr>");
//megkeresi a user melyik group-okban van a user
$t=searchgroup($user_id,"uid");
$t2="";
for($i=1;$i<$t[0];$i++)	$t2.=$t[$i]." ";
$t2=substr($t2,0,strlen($t2)-1);
print("<tr><td>Part of Groups (separeted by space) : </td><td><input type='text' name='group' value=\"".$t2."\"></td></tr>");
//print("<input type='hidden' name='old_group' value=\"".$t2."\">");
print("</table>");
print("<input type=submit name=submit_change class=bluebutton value=\"submit change\">");
print("</form>");
//phpinfo();
?>
</body>