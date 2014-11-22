<?php
include "config.php";
include "fuggvenyek.php";
open_database();
//keresuk ki a msg-et es annak minden informaciojat
$query="select msg,mid,uid,m_time,type from msgs where msgs.mid=".$_GET[msg_id];
$result=search_database($query,"msg_info.php : a msg adatait probalja lekerni : $query");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$query="select uid,nick_style,u_acces,u_group,u_nick,u_name,u_email,u_comment,u_refrt,show_nr_msgs,kuld_style,kapott_style from users where users.uid=".$_GET[uid];
$result2=search_database($query,"msg_info.php : a user adatait probalja lekerni : $query");
$line2 = mysql_fetch_array($result2, MYSQL_ASSOC);
print("A user teljes neve : ".$line2[u_name]."<br>");
print("A user acces-je : ".$line2[u_acces]."<br>");
print("A msg mikor volt irva : ".$line[m_time]."<br>");
print("Maga a msg : ".$line[msg]."<br>");
print("A msg id-je : ".$line[mid]."<br>");
print("A user group-ja : ".$line2[u_group]."<br>");
print("A user email-je : ".$line2[u_email]."<br>");
print("A user refresh-je : ".$line2[u_refrt]."<br>");
print("Hany msg-et lat a user : ".$line2[show_nr_msgs]."<br>");
close_database();
?>