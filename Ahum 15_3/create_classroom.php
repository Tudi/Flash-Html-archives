<?php
include "initpage.php";
print("<body bgcolor=\"#ccffff\">");
?>


<Form Name=getclassdata method=POST Action=create_classroom2.php target=_self>
  <font size="+2"><strong><center>Create a new classroom (define input form style)</center></strong></font> <br><br>
  <table width="71%" border="1">
    <tr> 
      <td width="59%">Classroom Name (=Group name, <strong>UNIQUE </strong>)</td>
      <td width="41%"><input name="t_classname" type="text" class="fontos" id="t_classname"></td>
    </tr>
    <tr> 
      <td>Number of Students in class</td>
      <td><input name="t_nrstudents" type="text" class="fontos" id="t_nrstudents"></td>
    </tr>
    <tr> 
      <td>tName (requred): </td>
      <td><input name="t_tname" type="text" class="fontos" id="t_tname"></td>
    </tr>
    <tr> 
      <td>Home Path</td>
      <td><input name="t_homepath" type="text" class="fontos" id="t_homepath" value="<?=getct(homepath)?>"></td>
    </tr>
  </table>
  <input name="submit_data_1" type="button" class="greenbutton" onClick="checkfill()" value="Next Page">
  <p>What should be auto filled (uncheck checkboxes and empty filds to imput separated values)? :<br>
	 Displaying defined values in fields</p>
  <table width="71%" border="1">
    <tr> 
      <td>Group ID (autofill=unique):</td>
      <td><input name="c_gid" type="checkbox" id="c_gid" value="checkbox" checked>
        or define :
<input name="t_gid" type="text" class="autofill" id="t_gid"></td>
    </tr>
    <tr> 
      <td>Full Group Name (autofill=gname): </td>
      <td><input name="c_gfname" type="checkbox" id="c_gfname" value="checkbox" checked>
        or define :
<input name="t_gfname" type="text" class="autofill" id="t_gfname"></td>
    </tr>
    <tr>
      <td>Comment for group (autofill=ct_noconfig)</td>
      <td><input name="c_gcomment" type="checkbox" id="c_gcomment" value="checkbox" checked>
        or define :
<input name="t_gcomment" type="text" class="autofill" id="t_gcomment" value="<?=getct(comment)?>"></td>
    </tr>
    <tr> 
      <td width="59%">User id (autofil=unique) </td>
      <td width="41%"><input name="c_uid" type="checkbox" id="c_uid" value="checkbox" checked></td>
    </tr>
    <tr> 
      <td>User Name (autofill=unique from name) </td>
      <td><input name="c_uname" type="checkbox" id="c_uname" value="checkbox" checked></td>
    </tr>
    <tr> 
      <td>Unencrypted Password (autofill=uname) </td>
      <td><input name="c_passw" type="checkbox" id="c_passw" value="checkbox" checked>
      </td>
    </tr>
    <tr> 
      <td>Quota MB (autofill=defined)</td>
      <td><input name="c_q" type="checkbox" id="c_q" value="checkbox" checked>
        or define : 
        <input name="t_q" type="text" class="autofill" id="t_q" value="<?=getct(quota)?>" ></td>
    </tr>
    <tr> 
      <td>Quota Files (autofill=defined)</td>
      <td><input name="c_qf" type="checkbox" id="c_qf" value="checkbox" checked>
        or define : 
        <input name="t_qf" type="text" class="autofill" id="t_qf" value="<?=getct(quotaf)?>" ></td>
    </tr>
    <tr> 
      <td>Days till passw can be changed (auto=defined)</td>
      <td><input name="c_p_min" type="checkbox" id="c_p_min" value="checkbox" checked>
        or define : 
        <input name="t_p_min" type="text" class="autofill" id="t_p_min" value="<?=getct(p_min)?>"></td>
    </tr>
    <tr> 
      <td>Days before passw must change (auto=defined)</td>
      <td><input name="c_p_max" type="checkbox" id="c_p_max" value="checkbox" checked>
        or define : 
        <input name="t_p_max" type="text" class="autofill" id="t_p_max" value="<?=getct(p_max)?>"></td>
    </tr>
    <tr> 
      <td>Days before acount inactive (auto=defined)</td>
      <td><input name="c_inactive" type="checkbox" id="c_inactive" value="checkbox" checked>
        or define : 
        <input name="t_inactive" type="text" class="autofill" id="t_inactive" value="<?=getct(inactive)?>"></td>
    </tr>
    <tr> 
      <td>Date when acount expires (auto=defined)</td>
      <td><input name="c_expire" type="checkbox" id="c_expire" value="checkbox" checked>
        or define : 
        <input name="t_expire" type="text" class="autofill" id="t_expire" value="<?=getct(expire)?>"></td>
    </tr>
    <tr> 
      <td>Force user to change passw (auto=defined)</td>
      <td><input name="c_forcepw" type="checkbox" id="c_forcepw" value="checkbox" checked>
        or define : 
        <input name="t_forcepw" type="text" class="autofill" id="t_forcepw" value="<?=getct(forcepw)?>"></td>
    </tr>
    <tr> 
      <td>Email (auto=defined)</td>
      <td><input name="c_email" type="checkbox" id="c_email" value="checkbox" checked>
        or define : 
        <input name="t_email" type="text" class="autofill" id="t_email" value="<?=getct(email)?>"></td>
    </tr>
    <tr> 
      <td>Samba (auto=defined)</td>
      <td><input name="c_samba" type="checkbox" id="c_samba" value="checkbox" checked>
        or define : 
        <input name="t_samba" type="text" class="autofill" id="t_samba" value="<?=getct(samba)?>"></td>
    </tr>
    <tr> 
      <td>Skeleton path (auto=defined)</td>
      <td><input name="c_skeletonpath" type="checkbox" id="c_skeletonpath" value="checkbox" checked>
        or define : 
        <input name="t_skeletonpath" type="text" class="autofill" id="t_skeletonpath" value="<?=getct(skeletonpath)?>"></td>
    </tr>
    <tr> 
      <td>Shell Path (auto=defined)</td>
      <td><input name="c_shellpath" type="checkbox" id="c_shellpath" value="checkbox" checked>
        or define : 
        <input name="t_shellpath" type="text" class="autofill" id="t_shellpath" value="<?=getct(shelpath)?>"></td>
    </tr>
    <tr> 
      <td>Comment (auto=defined)</td>
      <td><input name="c_comment" type="checkbox" id="c_comment" value="checkbox" checked>
        or define : 
        <input name="t_comment" type="text" class="autofill" id="t_comment" value="<?=getct(comment)?>"></td>
    </tr>
  </table>
  <input name="submit_data" type="button" class="greenbutton" onClick="checkfill()" value="Next Page">
</form>

<script language="JavaScript1.2" type="text/JavaScript">
 function checkfill() 
  {
		var a = document.getclassdata;
		if (a.t_classname.value == "") { alert ("Please, choose a Class name !"); a.t_classname.focus(); 
return; }
		if (a.t_nrstudents.value == "") { alert ("Please, specify the number of students !"); a.t_nrstudents.focus(); 
return; }
		if (a.t_tname.value == "") { alert ("Please, specify a tname !"); a.t_tname.focus(); 
return; }
		if (a.t_homepath.value == "") { alert ("Please, choose a homepath name !"); 
a.t_homepath.focus(); return; }
		a.submit();  }
</script>