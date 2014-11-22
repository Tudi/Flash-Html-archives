<?php
include "initpage.php";
open_database();
//keresuk ki neki a legkisebb gid ha nincs megadva
$l_p[gid]=$gid;
//name
$l_p[name]=$gname;
//comment
$l_p[comment]=getct(noconfig);
//homepath
$l_p[homepath]=getct(homepath);
//homepath
$l_p[isadmin]=getct(isadmin);
//tname , ez kotelezo ugyhogy helyesnek vesszuk
$l_p[tname]=getct(tname);
//gname , ez kotelezo ugyhogy helyesnek vesszuk
$l_p[gname]=$gname;
$miket="gid,name,comment,homepath,tname,gname,isadmin";
$values=$l_p[gid].",\"".$l_p[name]."\",\"".$l_p[comment]."\",\"".$l_p[homepath]."\",\"".$l_p[tname]."\",\"".$l_p[gname]."\",\"".$l_p[isadmin]."\"";
$sql_query="INSERT INTO groups (".$miket.") VALUES (".$values.")";
$result = search_database($sql_query,"add_group.php : insert group name in groups table : $sql_query");
$sql_query="create table `".$l_p[gname]."` (uid int primary key)";
$result = search_database($sql_query,"add_group.php : insert group table: $sql_query");
close_database();
?>