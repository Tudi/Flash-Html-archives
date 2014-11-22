<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
print("<center><h2><strong>Displaying a class information to modify</strong></h2></center><br>");

$old_gid=$_REQUEST[old_gid];

//ha masodszor fut akkor vegezzuk el a modositasokat
if(isset($_POST[secondrun]))
{
	print("<h1><center>Changes have been made !!</center></h1>");
	//vegezzuk el a modositasokat a group-al kapcsolatban ami be volt check-elve
	if(isset($_POST[c_gid])) $paramv[gid]=$_POST[t_gid];
	$paramv[gname]=$_POST[t_gname];
	if(isset($_POST[c_name])) $paramv[name]=$_POST[t_name];
	if(isset($_POST[c_tname])) $paramv[tname]=$_POST[t_tname];
	if(isset($_POST[c_comm])) $paramv[comment]=$_POST[t_comment];
	if(isset($_POST[c_homepath])) $paramv[homepath]=$_POST[r_homepath];
	open_database();
	mod_group($old_gid,$paramv);
	//vegezzuk el a modositasokat minden usernek kulon
	if(isset($_POST[c_groups])) $paramv2[gname]=$_POST[t_groups];
	if(isset($_POST[c_home])) $paramv2[homepath]=$_POST[t_home];
	if(isset($_POST[c_passw])) $paramv2[passw]=$_POST[t_passw];
	if(isset($_POST[c_q])) $paramv2[quota]=$_POST[t_q];
	if(isset($_POST[c_qf])) $paramv2[quotaf]=$_POST[t_qf];
	if(isset($_POST[c_p_min])) $paramv2[p_min]=$_POST[t_p_min];
	if(isset($_POST[c_p_max])) $paramv2[p_max]=$_POST[t_p_max];
	if(isset($_POST[c_inactive])) $paramv2[inactive]=$_POST[t_inactive];
	if(isset($_POST[c_expire])) $paramv2[expire]=$_POST[t_expire];
	if(isset($_POST[c_fpassw])) $paramv2[forcepw]=$_POST[t_fpassw];
	if(isset($_POST[c_samba])) $paramv2[samba]=$_POST[t_samba];
	if(isset($_POST[c_skel])) $paramv2[skeletonpath]=$_POST[t_skel];
	if(isset($_POST[c_shel])) $paramv2[shellpath]=$_POST[t_shel];
	if(isset($_POST[c_comm])) $paramv2[comment]=$_POST[t_comm];
	$query="select uid from`".$_POST[t_gname]."`";
	$result = search_database($query,"mod_class.php : kerjuk le az osszes user id-t hogy modositsuk meg oket $query");
//	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	while ( $line = mysql_fetch_array($result, MYSQL_ASSOC))
	{
 	  modify_user($line[uid],$paramv2);
	}
	close_database();
}

//keressuk ki az adatbazisbol a group adatait
open_database();
$fieldlist="gid,name,tname,gname,comment,homepath";
$query="select ".$fieldlist." from groups where groups.gid='".$old_gid."'";
$result = search_database($query,"modify_class.php : keresuk ki a group adatait");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
close_database();

print("<Form Name=getdata method=POST Action=modify_class.php target=_self>");
print("<input type=hidden name=old_gid id=old_gid value=$old_gid>");
print("<input type=hidden name=secondrun id=secondrun value=1>");
//itt egy group es user osszes altalanos tulajdonsaga fel kene legyen sorakoztatva
print("<br><h2><center><strong>Change at your own risk</center></strong></h2>");
print("<br><strong>Properties of the group = Class </strong><br><br>");
print("<table border=1");
print("<tr><td>Group Name </td><td><input type=text name=t_gname value=\"".$line[gname]."\"></td></tr>");
print("<tr><td>tName </td><td> <input name=\"c_tname\" type=\"checkbox\" id=\"c_tname\" value=\"checkbox\"> <input type=text name=t_tname value=\"".$line[tname]."\"></td></tr>");
print("<tr><td>Homepath </td><td> <input name=\"c_homepath\" type=\"checkbox\" id=\"c_homepath\" value=\"checkbox\"> <input type=text name=t_homepath value=\"".$line[homepath]."\"></td></tr>");
print("<tr><td>Group ID </td><td> <input name=\"c_gid\" type=\"checkbox\" id=\"c_gid\" value=\"checkbox\"> <input type=text name=t_gid value=\"".$line[gid]."\"></td></tr>");
print("<tr><td>Full Name </td><td> <input name=\"c_name\" type=\"checkbox\" id=\"c_name\" value=\"checkbox\"> <input type=text name=t_name value=\"".$line[name]."\"></td></tr>");
print("<tr><td>Comment </td><td> <input name=\"c_comm\" type=\"checkbox\" id=\"c_comm\" value=\"checkbox\"> <input type=text name=t_comment value=\"".$line[comment]."\"></td></tr>");
print("</table>");

//keressuk ki az adatbazisbol a user adatait (egyet a sok kozul)
open_database();
$query="select gname from groups where groups.gid='".$old_gid."'";
$result = search_database($query,"modify_class.php : keresuk ki a user adatait (1 user id-t) : $query");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$query="select uid from `".$line[gname]."` limit 0,1";
$result = search_database($query,"modify_class.php : keresuk ki a user id-jat (az elso user adatai) : $query");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
//ha nincs user hat akkor ures a group es ez adna 1 sql error-t
if($line[uid]!="")
{
	$t=searchgroup($line[uid],"uid");
	$t2="";
	for($i=1;$i<$t[0];$i++)	$t2.=$t[$i]." ";
	$groups=substr($t2,0,strlen($t2)-1);
	$query="select homepath,passw,quota,quotaf,p_min,p_max,expire,inactive,forcepw,email,".
		"samba,comment,skeletonpath,shellpath from users where uid=".$line[uid];
	$result = search_database($query,"modify_class.php : Efective kerjuk le a kivalasztott user adatait $query");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
}
close_database();
?>

<br>
<strong>Properties of users = students (displaying one of them, others may differ)</strong>
<br>
<strong>!!WARNING : changes will afect all students in group</strong>
<br>
<strong>!!WARNING : DO NOT change at the same time "group name" and "part of groups"</strong>
<br>
<strong>To change a value you must check the checkbox.Blank fields won't be changed</strong> <br>
<strong></strong><br>

  <table border="1">
    <tr> 
      <td bgcolor="#CCFFFF">Part of Groups </td>
      <td> <input name="c_groups" type="checkbox" id="c_groups" value="checkbox">
	  <input type="text"  name="t_groups" value="<?php print("$groups") ?>" </td>
    </tr>
    <tr>
      <td bgcolor="#CCFFFF">Home Path </td>
      <td ><input name="c_home" type="checkbox" id="c_home" value="checkbox">
	  <input type="text"  name="t_home" value="<?php print("$line[homepath]") ?>"</td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Unencrypted Password </td>
      <td><input name="c_passw" type="checkbox" id="c_passw" value="checkbox">        
      <input name="t_passw" type="text"  maxlength="50" value=""</td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Quota MB (autofill=20=ct_qouta) :</td>
      <td><input name="c_q" type="checkbox" id="c_q" value="checkbox">        
      <input name="t_q" type="text" size="5"  maxlength="5" value="<?php print("$line[quota]") ?>"</td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Quota Files (autofill=1000=ct_quotaf) :</td>
      <td><input name="c_qf" type="checkbox" id="c_qf" value="checkbox">        
      <input type="text"  name="t_qf" value="<?php print("$line[quotaf]") ?>"</td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Days till passw can be changed (auto=ct_noconfig) 
        :</td>
      <td><input name="c_p_min" type="checkbox" id="c_p_min" value="checkbox">
	  <input type="text"  name="t_p_min" value="<?php print("$line[p_min]") ?>"</td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Days before passw must change (auto=ct_noconfig) : 
      </td>
      <td><input name="c_p_max" type="checkbox" id="c_p_max" value="checkbox">
	  <input type="text"  name="t_p_max" value="<?php print("$line[p_max]") ?>"</td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Days before acount inactive (auto=ct_noconfig) : </td>
      <td><input name="c_inactive" type="checkbox" id="c_inactive" value="checkbox">
	  <input type="text"  name="t_inactive" value="<?php print("$line[inactive]") ?>"</td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Date when acount expires (auto=ct_noconfig) : </td>
      <td><input name="c_expire" type="checkbox" id="c_expire" value="checkbox">
	  <input type="text"  name="t_expire" value="<?php print("$line[expire]") ?>"</td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Force user to change passw (auto=ct_noconfig) : </td>
      <td><input name="c_f_passw" type="checkbox" id="c_f_passw" value="checkbox">
	  <input type="text"  name="t_fpassw" value="<?php print("$line[forcepw]") ?>"</td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Email (auto=ct_enable) :</td>
      <td><input name="c_email" type="checkbox" id="c_email" value="checkbox">
	  <input type="text"  name="t_email" value="<?php print("$line[email]") ?>"</td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Samba (auto=ct_enable) : </td>
      <td><input name="c_samba" type="checkbox" id="c_samba" value="checkbox">
	  <input type="text"  name="t_samba" value="<?php print("$line[samba]") ?>"</td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Skeleton path (auto=ct_noconfig) :</td>
      <td><input name="c_skel" type="checkbox" id="c_skel" value="checkbox">
	  <input type="text"  name="t_skel" value="<?php print("$line[skeletonpath]") ?>"</td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Shell Path (auto=ct_noconfig) : </td>
      <td><input name="c_shel" type="checkbox" id="c_shel" value="checkbox">
	  <input type="text"  name="t_shel" value="<?php print("$line[shellpath]") ?>"</td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Comment (auto=ct_noconfig) : </td>
      <td><input name="c_comm" type="checkbox" id="c_comm" value="checkbox">
	  <input type="text"  name="t_comm" value="<?php print("$line[comment]") ?>"</td>
    </tr>
  </table>
  <input type=submit name=b_submit value="make changes" class=fontos >
</form>