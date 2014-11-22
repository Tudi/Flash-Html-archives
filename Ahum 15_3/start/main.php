<?php include "initpage.php"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-size: 24px}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>
<body>
 <div align="center" class="style1">
   <p>Use this page only if = When you install on a new computer or you want to add a new admin </p>
   <form name="form1" method="post" action="">
     <p>
       <input name="b_add_group" type="button" id="b_add_group" onClick="MM_goToURL('parent','add_admin_group');return document.MM_returnValue" value="Add new admin group">
</p>
     <p>
       <input name="b_modify_group" type="button" id="b_modify_group" onClick="MM_goToURL('parent','select_admin_group.php');return document.MM_returnValue" value="Modify admin group"> 
     </p>
     <p>
       <input name="b_delete_group" type="button" id="b_delete_group" onClick="MM_goToURL('parent','delete_admin_group.php');return document.MM_returnValue" value="Delete admin group"> 
     </p>
     <p>&nbsp;</p>
     <p>
       <input name="b_add_admin_user" type="button" id="b_add_admin_user" onClick="MM_goToURL('parent','add_admin_user.php');return document.MM_returnValue" value="Add admin user"> 
     </p>
     <p>
       <input name="b_modify_admin_user" type="button" id="b_modify_admin_user" onClick="MM_goToURL('parent','select_admin_user.php');return document.MM_returnValue" value="Modify admin user"> 
     </p>
     <p>
       <input name="b_delete_admin_user" type="button" id="b_delete_admin_user" onClick="MM_goToURL('parent','delete_admin_user.php');return document.MM_returnValue" value="Delete admin user"> 
       </p>
   </form>
   <p>&nbsp; </p>
 </div>
</body>
</html>
