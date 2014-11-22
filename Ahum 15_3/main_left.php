<?php
include "initpage.php";
//print("<body bgcolor=\"#ccffff\">");
?>
<style>
/* CoolMenus 4 - default styles - do not edit */
.clCMEvent{position:absolute; width:99%; height:99%; clip:rect(0,100%,100%,0); left:0; top:0; visibility:visible}
.clCMAbs{position:absolute; visibility:hidden; left:0; top:0}
/* CoolMenus 4 - default styles - end */
  
/*Styles standard*/
.clLevel0,.clLevel0over{position:absolute; padding:2px; font-family:tahoma,arial,helvetica; font-size:16px; font-weight:bold}
.clLevel0{background-color:Navy; layer-background-color:Navy; color:white;text-align: center;}
.clLevel0over{background-color:#336699; layer-background-color:#336699; color:Yellow; cursor:pointer; cursor:hand; }
.clLevel0border{position:absolute; visibility:hidden; background-color:#006699; layer-background-color:#006699}
/*Styles red*/
.clred,.clredover{position:absolute; padding:2px; font-family:tahoma,arial,helvetica; font-size:16px; font-weight:bold}
.clred{background-color:#990000; layer-background-color:#990000; color:white;}
.clredover{background-color:#bb0000; layer-background-color:#bb0000; color:Yellow; cursor:pointer; cursor:hand; }
.clredborder{position:absolute; visibility:hidden; background-color:#cc0033; layer-background-color:#cc0033}
/*Styles green*/
.clgreen,.clgreenover{position:absolute; padding:2px; font-family:tahoma,arial,helvetica; font-size:16px; font-weight:bold}
.clgreen{background-color:#006633; layer-background-color:#006633; color:white;}
.clgreenover{background-color:#008844; layer-background-color:#008844; color:Yellow; cursor:pointer; cursor:hand; }
.clgreenborder{position:absolute; visibility:hidden; background-color:#339966; layer-background-color:#339966}
/*Styles blue*/
.clblue,.clblueover{position:absolute; padding:2px; font-family:tahoma,arial,helvetica; font-size:16px; font-weight:bold}
.clblue{background-color:#003399; layer-background-color:#003399; color:white;}
.clblueover{background-color:#0055bb; layer-background-color:#0055bb; color:Yellow; cursor:pointer; cursor:hand; }
.clblueborder{position:absolute; visibility:hidden; background-color:#33ccff; layer-background-color:#33ccff}

</style>
<script language="JavaScript1.2" src="coolmenus4.js"></script>
<script language="JavaScript1.2" src="cm_addins.js"></script>
</head>
<body bgcolor="#ccffff">
<script>
AhumMenu=new makeCM("AhumMenu")

AhumMenu.pxBetween=65
AhumMenu.fromLeft=0
AhumMenu.onresize="AhumMenu.fromLeft=0"
AhumMenu.fromTop=0  
AhumMenu.rows=0
AhumMenu.menuPlacement=0
AhumMenu.offlineRoot="" 
AhumMenu.onlineRoot="" 
AhumMenu.resizeCheck=1 
AhumMenu.wait=100
AhumMenu.fillImg=""
AhumMenu.zIndex=100

//cm_makeLevel(width,height,regClass,overClass,borderX,borderY,borderClass,rows,align,offsetX,offsetY,arrow,arrowWidth,arrowHeight)
AhumMenu.level[0]=new cm_makeLevel()
AhumMenu.level[0].width=60
AhumMenu.level[0].height=20 
AhumMenu.level[0].regClass="clLevel0"
AhumMenu.level[0].overClass="clLevel0over"
AhumMenu.level[0].borderX=1
AhumMenu.level[0].borderY=1
AhumMenu.level[0].borderClass="clLevel0border"
AhumMenu.level[0].offsetX=0
AhumMenu.level[0].offsetY=0
AhumMenu.level[0].rows=0
AhumMenu.level[0].arrow=0
AhumMenu.level[0].arrowWidth=0
AhumMenu.level[0].arrowHeight=0
AhumMenu.level[0].align="bottom"
AhumMenu.level[0].filter="progid:DXImageTransform.Microsoft.Fade(duration=0.5)" 
//AhumMenu.level[0].slidepx=10
//AhumMenu.level[0].clippx=10

//myCoolMenu.makeMenu(name, parent_name, text, link, target, width, height, regImage, overImage, regClass, overClass , align, rows, nolink, onclick, onmouseover, onmouseout) 
AhumMenu.makeMenu('user','','User','','','85','25')
	AhumMenu.makeMenu('user_add','user','Add','add_user.php','midleFrame','','','','','clgreen','clgreenover')
	AhumMenu.makeMenu('user_mod','user','Modify','select_user.php','midleFrame','','','','','clblue','clblueover')
	AhumMenu.makeMenu('user_del','user','Delete','delete_user.php','midleFrame','','','','','clred','clredover')
AhumMenu.makeMenu('group','','Group','','','85','25')
	AhumMenu.makeMenu('group_add','group','Add','add_group.php','midleFrame','','','','','clgreen','clgreenover')
	AhumMenu.makeMenu('group_mod','group','Modify','select_group.php','midleFrame','','','','','clblue','clblueover')
	AhumMenu.makeMenu('group_del','group','Delete','delete_group.php','midleFrame','','','','','clred','clredover')
AhumMenu.makeMenu('class','','Class','','','85','25')
	AhumMenu.makeMenu('class_add','class','Add','create_classroom.php','midleFrame','','','','','clgreen','clgreenover')
	AhumMenu.makeMenu('class_mod','class','Modify','select_class.php','midleFrame','','','','','clblue','clblueover')
	AhumMenu.makeMenu('class_del','class','Delete','delete_group.php','midleFrame','','','','','clred','clredover')
AhumMenu.makeMenu('utils','','Utils','','','85','25')
	AhumMenu.makeMenu('advance year','utils','Advance','advance_year.php','midleFrame','','','','','clblue','clblueover')
	AhumMenu.makeMenu('find_infans','utils','Infans','find_infans.php','midleFrame','','','','','clblue','clblueover')
	AhumMenu.makeMenu('get_system_groups','utils','Sysgroup','get_system_groups.php','midleFrame','','','','','clblue','clblueover')
	AhumMenu.makeMenu('get_system_users','utils','Sysuser','get_system_users.php','midleFrame','','','','','clblue','clblueover')

AhumMenu.construct()
</script>
</body>
