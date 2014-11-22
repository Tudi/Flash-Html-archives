<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
print("<center><h2><strong>Create a new classroom : input data for students</strong></h2></center><br>");

//ez csak akkor hajtodik vegre ha masodszor fut
if(isset($_POST[t_nrs]))
{
	open_database();
	//kezdjuk regisztralni mindegyik tanulot
	for($i=0;$i<$_POST[t_nrs];$i++)
	{
		$paramv[name]=$_POST["t_name".$i];
		$paramv[uname]=$_POST["t_uname".$i];
		$paramv[uid]=$_POST["t_uid".$i];
		$paramv[gname]=$_POST[t_groups];
		$paramv[passw]=$_POST["t_passw".$i];
		$paramv[quota]=$_POST["t_q".$i];
		$paramv[quotaf]=$_POST["t_qf".$i];
		$paramv[p_min]=$_POST["t_p_min".$i];
		$paramv[p_max]=$_POST["t_p_max".$i];
		$paramv[inactive]=$_POST["t_inactive".$i];
		$paramv[expire]=$_POST["t_expire".$i];
		$paramv[forcepw]=$_POST["t_forcepw".$i];
		$paramv[email]=$_POST["t_email".$i];
		$paramv[samba]=$_POST["t_samba".$i];
		$paramv[skeletonpath]=$_POST["t_skeletonpath".$i];
		$paramv[shellpath]=$_POST["t_shellpath".$i];
		$paramv[comment]=$_POST["t_comment".$i];
		$paramv[homepath]=$_POST[t_homepath];
		add_user($paramv);
	}
	close_database();
}

//foglalkozzunk 1 kicsit a group-al
if(isset($_POST[t_classname]) && isset($_POST[t_tname]) && $_POST[t_tname]!="" && $_POST[t_classname]!="")
{
	$paramv[gname]=$_POST[t_classname];
	$paramv[tname]=$_POST[t_tname];
	$paramv[homepath]=$_POST[t_homepath];
	$paramv[gid]=$_POST[t_gid];
	$paramv[name]=$_POST[t_gfname];
	$paramv[comment]=$_POST[t_gcomment];
	open_database();
	$ok=add_group($paramv);
	close_database();
}

//aztan kulon minden tanuloval
if($ok==1)
{
	print("\n<Form Name=cdata method=POST Action='create_classroom2.php' target=_self>");
	print("\n<br><input type=\"hidden\" name=\"t_nrs\" id=\"t_nrs\" value=".$_POST[t_nrstudents].">");
	print("\n<br><input type=\"hidden\" name=\"t_groups\" id=\"t_groups\" value=".$_POST[t_classname].">");
	for($i=0;$i<$_POST[t_nrstudents];$i++)
	{
		print("<font color=#00FF00>This is the ".($i+1)."-th student</font>");
		buildblock($i);
	}
	print("<input type='button' onclick='checkfill()' class=greenbutton name=\"Submit values\" value=\"Submit values\">");
	print("</form>");
}

//aszerint hogy az ezelotti oldalon milyen informaciok voltak kitoltve felepit 1 kerdoivet
function buildblock($i)
{
	print("<table border='1'>");
	print("\n<tr><td>Full Name : </td><td><input type=\"text\" name='t_name".$i."' class=fontos id=\"t_name".$i."\"></td></tr>");
	if(!isset($_POST[c_uid]))
		print("\n<tr><td>User ID : </td><td><input type=text name=t_uid".$i." id=t_uid".$i."></td></tr>");

	if(!isset($_POST[c_uname]))
		print("\n<tr><td>User Name : </td><td><input type=text name=t_uname".$i." id=t_uname".$i."></td></tr>");
//	if(isset($_POST[c_uname]))
//		print("<input type=hidden name=t_uname".$i." id=t_uname".$i." value=''>");

	if(!isset($_POST[c_passw]))
		print("\n<tr><td>Password : </td><td><input type=\"text\" name=t_passw".$i." id=\"passw".$i."\"></td></tr>");
//	if(isset($_POST[c_passw]))
//		print("<input type=\"hidden\" name=t_passw".$i." id=\"passw".$i."\" value=''>");

	if(!isset($_POST[c_q]) and $_POST[t_q]=="")
		print("\n<tr><td>Quota(MB) : </td><td><input type=\"text\" name=t_q".$i." id=\"q".$i."\"></td></tr>");
	if(!isset($_POST[c_q]) and $_POST[t_q]!="")
		print("\n<input type=\"hidden\" name=t_q".$i." id=\"t_q".$i."\" value=$_POST[t_q]>");

	if(!isset($_POST[c_qf]) and $_POST[t_qf]=="")
		print("\n<tr><td>Quota Files : </td><td><input type=\"text\" name=\"t_qf".$i."\" id=\"t_qf".$i."\"></td></tr>");
	if(!isset($_POST[c_qf]) and $_POST[t_qf]!="")
		print("\n<input type=\"hidden\" name=\"t_qf".$i."\" id=\"t_qf".$i."\" value=$_POST[t_qf]>");

	if(!isset($_POST[c_p_min]) and $_POST[t_p_min]=="")
		print("\n<tr><td>Days till passw can be changed : </td><td><input type=\"text\" name=\"t_p_min".$i."\" id=\"p_min".$i."\"></td></tr>");
	if(!isset($_POST[c_p_min]) and $_POST[t_p_min]!="")
		print("\n<input type=\"hidden\" name=\"t_p_min".$i."\" id=\"t_p_min".$i."\" value=$_POST[t_p_min]>");

	if(!isset($_POST[c_p_max]) and $_POST[t_p_max]=="")
		print("\n<tr><td>Days before passw must change : </td><td><input type=\"text\" name=\"t_p_max".$i."\" id=\"p_max".$i."\"></td></tr>");
	if(!isset($_POST[c_p_max]) and $_POST[t_p_max]!="")
		print("\n<input type=\"hidden\" name=\"t_p_max".$i."\" id=\"t_p_max".$i."\" value=$_POST[t_p_max]>");

	if(!isset($_POST[c_inactive]) and $_POST[t_inactive]=="")
		print("\n<tr><td>Days before acount inactive </td><td><input type=\"text\" name=\"t_inactive".$i."\" id=\"t_inactive".$i."\"></td></tr>");
	if(!isset($_POST[c_inactive]) and $_POST[t_inactive]!="")
		print("\n<input type=\"hidden\" name=\"t_inactive".$i."\" id=\"t_inactive".$i."\" value=$_POST[t_inactive]>");

	if(!isset($_POST[c_expire]) and $_POST[t_expire]=="")
		print("\n<tr><td>Date when acount expires </td><td><input type=\"text\" name=\"t_expire".$i."\" id=\"t_expire".$i."\"></td></tr>");
	if(!isset($_POST[c_expire]) and $_POST[t_expire]!="")
		print("\n<input type=\"hidden\" name=\"t_expire".$i."\" id=\"t_expire".$i."\" value=$_POST[t_expire]>");

	if(!isset($_POST[c_forcepw]) and $_POST[t_forcepw]=="")
		print("\n<tr><td>Force user to change passw </td><td><input type=\"text\" name=\"t_forcepw".$i."\" id=\"t_forcepw".$i."\"></td></tr>");
	if(!isset($_POST[c_forcepw]) and $_POST[t_forcepw]!="")
		print("\n<input type=\"hidden\" name=\"t_forcepw".$i."\" id=\"t_forcepw".$i."\" value=$_POST[t_forcepw]>");

	if(!isset($_POST[c_email]) and $_POST[t_email]=="")
		print("\n<tr><td>Email </td><td><input type=\"text\" name=\"t_email".$i."\" id=\"t_email".$i."\"></td></tr>");
	if(!isset($_POST[c_email]) and $_POST[t_email]!="")
		print("\n<input type=\"hidden\" name=\"t_email".$i."\" id=\"t_email".$i."\" value=$_POST[t_email]>");

	if(!isset($_POST[c_samba]) and $_POST[t_samba]=="")
		print("\n<tr><td>Samba </td><td><input type=\"text\" name=\"t_samba".$i."\" id=\"t_samba".$i."\"></td></tr>");
	if(!isset($_POST[c_samba]) and $_POST[t_samba]!="")
		print("\n<input type=\"hidden\" name=\"t_samba".$i."\" id=\"t_samba".$i."\" value=$_POST[t_samba]>");

	if(!isset($_POST[c_skeletonpath]) and $_POST[t_skeletonpath]=="")
		print("\n<tr><td>Skeleton path </td><td><input type=\"text\" name=\"t_skeletonpath".$i."\" id=\"t_skeletonpath".$i."\"></td></tr>");
	if(!isset($_POST[c_skeletonpath]) and $_POST[t_skeletonpath]!="")
		print("\n<input type=\"hidden\" name=\"t_skeletonpath".$i."\" id=\"t_skeletonpath".$i."\" value=$_POST[t_skeletonpath]>");

	if(!isset($_POST[c_shellpath]) and $_POST[t_shellpath]=="")
		print("\n<tr><td>Shell Path </td><td><input type=\"text\" name=\"t_shellpath".$i."\" id=\"t_shellpath".$i."\"></td></tr>");
	if(!isset($_POST[c_shellpath]) and $_POST[t_shellpath]!="")
		print("\n<input type=\"hidden\" name=\"t_shellpath".$i."\" id=\"t_shellpath".$i."\" value=$_POST[t_shellpath]>");

	if(!isset($_POST[c_comment]) and $_POST[t_comment]=="")
		print("\n<tr><td>Comment </td><td><input type=\"text\" name=\"t_comment".$i."\" id=\"t_comment".$i."\"></td></tr>");
	if(!isset($_POST[c_comment]) and $_POST[t_comment]!="")
		print("\n<input type=\"hidden\" name=\"t_comment".$i."\" id=\"t_comment".$i."\" value=$_POST[t_comment]>");

	print("</table>");
}
?>

<script language="JavaScript1.2" type="text/JavaScript">
 function checkfill() 
  {
		var a = document.cdata;
		for(i=0;i<eval(a.t_nrs.value);i++)
			 if(eval("a.t_name"+i+".value")=="")
			  { 
			   alert ("Please, input the "+(i+1)+" th student Full Name !"); 
			   eval("a.t_name"+i+".focus()");
			   return; 
			  }
		a.submit();  }
</script>