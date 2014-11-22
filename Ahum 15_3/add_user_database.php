<?php
include "initpage.php";
open_database();
$l_p[uid]=$uid;
$l_p[name]=$uname;
$l_p[uname]=$uname;
$l_p[passw]=$uname;
$l_p[quota]=getct(quota);
$l_p[quotaf]=getct(quotaf);
$l_p[p_min]=getct(p_min);
$l_p[p_max]=getct(p_max);
$l_p[inactive]=getct(inactive);
$l_p[expire]=getct(expire);
$l_p[forcepw]=getct(forcepw);
$l_p[email]=getct(email);
$l_p[samba]=getct(samba);
$l_p[skeletonpath]=getct(skeletonpath);
$l_p[shellpath]=getct(shellpath);
$l_p[comment]=getct(comment);
$l_p[homepath]=getct(homepath);
//most pedig a user tobbi adatjat is rogzitsuk
//az oszes erteket belerakjuk 1 valtozoba, hogy ne legyen 2km hosszu a sor
//fontos ,hogy a parameter vektor index neve ugyanaz legyen mint az adatbazisban a field nevek
$values="";
$keynames="";
foreach($l_p as $key => $val)
{
	$values.="\"".$l_p[$key]."\",";
	$keynames.=$key.",";
}
$values=substr($values, 0, strlen($values)-1);
$keynames=substr($keynames, 0, strlen($keynames)-1);
//es most tenyleg modositsuk meg
$query="INSERT INTO users (".$keynames.") VALUES (".$values.")";
$rez=search_database($query,"a user listaba teszi az uj usert : $query");
//csinaljunk neki user info-t is
$query="INSERT INTO user_info (uid, BI_seria, BI_numar, adresa1, tel1, tel2, comment, CNP, adresa2, ispublic, email1, email2, fax) VALUES ($l_p[uid], NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL)";
$rez=search_database($query,"a userinfo-t letrehozza a usernek listaba teszi az uj usert : $query");
close_database();
?>