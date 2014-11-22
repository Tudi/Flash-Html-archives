<?php
define(sql_hostname,"localhost");
define(sql_database,"chat");
define(sql_username,"root");
define(sql_password,"");

define(acces_html,500);
define(msg_maxlen,255);
define(max_msgs_can_show,500);
//masodpercekben megadva amikor frisiti a kepernyot ez standard de mindig felulirodik a user adataival
$refreshtime=5;

$smiley[0]="::all::";
$smiley_r[0]=":):D:(;):P]):X:L:-8):aua:R)";
$smiley[1]=":)";
$smiley_r[1]="<input type=image src=./smile/smile.gif >";
$smiley[2]=":(";
$smiley_r[2]="<input type=image src=./smile/sad.gif >";
$smiley[3]=";)";
$smiley_r[3]="<input type=image src=./smile/wink.gif >";
$smiley[4]=":D";
$smiley_r[4]="<input type=image src=./smile/biggrin.gif >";
$smiley[5]=":P";
$smiley_r[5]="<input type=image src=./smile/tongue.gif >";
$smiley[6]="])";
$smiley_r[6]="<input type=image src=./smile/devil.gif >";
$smiley[7]=":X";
$smiley_r[7]="<input type=image src=./smile/dead.gif >";
$smiley[8]=":L";
$smiley_r[8]="<input type=image src=./smile/smokin.gif >";
$smiley[9]=":-";
$smiley_r[9]="<input type=image src=./smile/pukey.gif >";
$smiley[10]="8)";
$smiley_r[10]="<input type=image src=./smile/cool.gif >";
$smiley[11]=":aua:";
$smiley_r[11]="<input type=image src=./smile/aua.gif >";
$smiley[12]="R)";
$smiley_r[12]="<input type=image src=./smile/rotfl.gif >";
//session_uid
//session_trusted
//session_nick
//session_full_name
//session_max_msgs
?>