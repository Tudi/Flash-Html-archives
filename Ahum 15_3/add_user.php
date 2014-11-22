<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
print("<center><h2><strong>Create a new user : input data</strong></h2></center><br>");

//!!! szukseges parameterek ,hogy ezt a page-et meg lehessen hivni = t_name,t_groups
// ha veletlenul nincs megadva a t_home akkor a t_groups -ban csak 1 group name szabad legyen

//nezuk meg masodszor van-e futtatva az oldal
if(isset($_POST[t_name]) && isset($_POST[s_group]))
{
	//epitsuk fel a parameter vektort
	$paramv[name]=$_POST[t_name];
	$paramv[uname]=$_POST[t_uname];
	$paramv[uid]=$_POST[t_uid];
	$paramv[gname]=$_POST[s_group];
	$paramv[passw]=$_POST[t_passw];
	$paramv[quota]=$_POST[t_q];
	$paramv[quotaf]=$_POST[t_qf];
	$paramv[p_min]=$_POST[t_p_min];
	$paramv[p_max]=$_POST[t_p_max];
	$paramv[inactive]=$_POST[t_inactive];
	$paramv[expire]=$_POST[t_expire];
	$paramv[homepath]=$_POST[t_home];
	$paramv[forcepw]=$_POST[t_fpassw];
	$paramv[email]=$_POST[t_email];
	$paramv[samba]=$_POST[t_samba];
	$paramv[skeletonpath]=$_POST[t_skel];
	$paramv[shellpath]=$_POST[t_shel];
	$paramv[comment]=$_POST[t_comm];
	//inditsuk el a user registralast
	open_database();
	add_user($paramv);
	close_database();
}
?>

<form name="getuserinfo" method="post" action="add_user.php" target="_self">
  <input name="b_add_user" type="button" onClick='checkfill()' class=greenbutton value="Create user">
  <table border="1">
    <tr> 
      <td bgcolor="#CCFFFF">Full Name (!!<strong>Requered</strong>) </td>
      <td bgcolor="#990000"> <input name="t_name" type="text" class=fontos maxlength="50"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Part of Groups (!!<strong>Requered</strong>) : </td>
	  <td>
			<select name="s_group" class=fontos>
				<?php
//			      <td bgcolor="#990000"> <input type="text" class=fontos name="t_groups"> </td>
				 //ki kell irassuk az oszes (admin nelkul) group nevet
				 open_database();
				 $query="select gname from groups where isadmin=\"0\" ORDER BY gname desc";
			 	 $result = search_database($query,"add_user.php : searching for group names $query");
			 	 while($line = mysql_fetch_array($result, MYSQL_ASSOC))
				    print("<option value='$line[gname]'>$line[gname]</option>");
				 close_database();
				?>
			</select>
    </tr>
    <tr>
      <td bgcolor="#CCFFFF">Home Path (auto=inherit from group) :</td>
      <td ><input type="text" class=autofill name="t_home"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">user id (autofil=unique) :</td>
      <td><input name="t_uid" class=autofill type="text" size="5" maxlength="5" value="<?=find_minuid()?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">User Name (autofill=generate unique from name) : </td>
      <td><input name="t_uname" type="text" class=autofill maxlength="50"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Unencrypted Password (autofill=uname) :</td>
      <td><input name="t_passw" type="text" class=autofill maxlength="50"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Quota MB (autofill=defined) :</td>
      <td><input name="t_q" type="text" size="5" class=autofill maxlength="5" value="<?=getct(quota)?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Quota Files (autofill=defined) :</td>
      <td><input type="text" class=autofill name="t_qf" value="<?=getct(quotaf)?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Days till passw can be changed (auto=defined) 
        :</td>
      <td><input type="text" class=autofill name="t_p_min" value="<?=getct(p_min)?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Days before passw must change (auto=defined) : 
      </td>
      <td><input type="text" class=autofill name="t_p_max" value="<?=getct(p_max)?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Days before acount inactive (auto=defined) : </td>
      <td><input type="text" class=autofill name="t_inactive" value="<?=getct(inactive)?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Date when acount expires (auto=defined) : </td>
      <td><input type="text" class=autofill name="t_expire" value="<?=getct(expire)?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Force user to change passw (auto=defined) : </td>
      <td><input type="text" class=autofill name="t_fpassw" value="<?=getct(forcepw)?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Email (auto=defined) :</td>
      <td><input type="text" class=autofill name="t_email" value="<?=getct(email)?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Samba (auto=defined) : </td>
      <td><input type="text" class=autofill name="t_samba" value="<?=getct(samba)?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Skeleton path (auto=defined) :</td>
      <td><input type="text" class=autofill name="t_skel" value="<?=getct(skeletonpath)?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Shell Path (auto=defined) : </td>
      <td><input type="text" class=autofill name="t_shel" value="<?=getct(shellpath)?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#CCFFFF">Comment (auto=defined) : </td>
      <td><input type="text" class=autofill name="t_comm" value="<?=getct(comment)?>"></td>
    </tr>
  </table>
  <input name="b_add_user" type="button" onClick='checkfill()' class=greenbutton value="Create user">
</form>
</body>

<script language="JavaScript1.2" type="text/JavaScript">
 function checkfill() 
  {
		var a = document.getuserinfo;
		if (a.t_name.value == "") { alert ("Please, input a full name !"); a.t_name.focus(); return; }
		if (a.s_group.value == "") { alert ("Please, select a group name(register first if nonexists) !"); a.s_group.focus(); return; }
		a.submit();  }
</script>
