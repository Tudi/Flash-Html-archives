<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
print("<center><h2><strong>Displaying a groups information to modify</strong></h2></center><br>");

//nezuk meg masodikszor fut-e a page ha igen akkor vegezzuk el a modositasokat
if(isset($_POST[gid]))
{
	//keszitsuk elo a protokol szerint a parametereket
	$paramv[gid]=$_POST[gid];
	$paramv[gname]=$_POST[gname];
	$paramv[name]=$_POST[name];
	$paramv[tname]=$_POST[tname];
	$paramv[comment]=$_POST[comment];
	$paramv[homepath]=$_POST[homepath];
	$paramv[isadmin]=$_POST[isadmin];
	open_database();
	mod_group($old_gid,$paramv);
	close_database();
	print("<h2> Modifications have been made , displaying new values : <h2>");
}

//listazza ki a letezo Group-okat

open_database();
if(isset($_GET[old_gid]) && $_GET[old_gid]!="")$old_gid2=$_GET[old_gid];
  else $old_gid2=$_POST[gid];
$sql_query="select isadmin,gid,name,gname,tname,comment,homepath from groups where groups.gid=".$old_gid2;
$result = search_database($sql_query,"mod_group.php : list all the groups $old_gid2");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
close_database();
?>
<form action="modify_admin_group.php" method="post" name="get_group_data" target="_self">
  <input name="old_gid" type="hidden" id="old_gid" value="<?=$old_gid2?>">
  <table border="1">
    <tr> 
      <td>Gid</td>
      <td><input name="gid" type="text" id="gid" class="fontos" value="<?=$line[gid]?>"></td>
    </tr>
    <tr> 
      <td>Group Name</td>
      <td><input name="gname" type="text" id="gname" value="<?=$line[gname]?>"></td>
    </tr>
    <tr> 
      <td>Full Name</td>
      <td><input name="name" type="text" id="name" value="<?=$line[name]?>"></td>
    </tr>
    <tr> 
      <td>tName</td>
      <td><input name="tname" type="text" id="tname" value="<?=$line[tname]?>"></td>
    </tr>
    <tr>
      <td>Homepath</td>
      <td><input name="homepath" type="text" id="homepath" value="<?=$line[homepath]?>"></td>
    </tr>
    <tr> 
      <td>Comment</td>
      <td><input name="comment" type="text" id="comment" value="<?=$line[comment]?>"></td>
    </tr>
    <tr> 
      <td>Isadmin</td>
      <td><input name="isadmin" type="text" id="isadmin" value="<?=$line[isadmin]?>"></td>
    </tr>
  </table>
  <input name="Modify Group" type="submit" value="Modify group" class=bluebutton>
</form>
</body>