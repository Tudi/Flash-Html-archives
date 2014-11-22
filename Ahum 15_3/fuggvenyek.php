<?php

include "const.php";
include "system_func.php";
//alakitsunk at minden GET vagy POST variable-t szimpla variable-a
foreach($_REQUEST as $key => $val) ${$key}=$val;
  

/************************************************************************************************/
//check if username and password exists in database , returns acces code
function acces_code($user,$passw)
{
	$user_acces=getct(no_acces);
	//user exists and it's part of a group that has admin acces
	$query="select uid from users where users.uname=\"$user\" and users.passw=\"$passw\"";
	$result = search_database($query,"get acces code : is the user registred with this password ? : $query");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$uid=$line[uid];
	if(isset($uid) && $uid!="")
	{
		$user_acces=getct(user_acces);
		$query="select gname from groups where isadmin=\"1\"";
		$result= search_database($query,"get acces code : search groups to see if the user has admin acces ? : $query");
		while ( $line = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$query2="select uid from ".$line[gname]." where uid=\"$uid\"";
			$result2 = search_database($query2,"get acces code : is the user in an admin group registred ? : $query");
			$line2 = mysql_fetch_array($result2, MYSQL_ASSOC);
			if(isset($line2[uid]) && $line2[uid]!="")$user_acces=getct(admin_acces);
		}
	}

	//ez kulonleges/kiveteles behatolasi mod de ki kene venni security hole miatt
	if($user==ahum_root_name && $passw==ahum_root_passw)
		$user_acces=getct(root_acces);
	return("$user_acces");
}

/************************************************************************************************/
//kinyitja az addatbazist,hogy lekerje a user-eket es ellenorizze a bejelentkezest
function open_database()
{
	global $link;
    $link = mysql_connect(sql_hostname, sql_username, sql_password) or die("Could not connect : " . mysql_error());
    mysql_select_db(sql_database) or die("Could not select database");
	return($link);
}

/**********************************************************************************************/
//becsukja az adatbazist
function close_database()
{
	global $rezult;
	global $link;
    if (isset($result)) mysql_free_result($result);
    if (isset($link)) mysql_close($link);
}


/**********************************************************************************************/
//keres az adatbazisban
function search_database($sql_query,$err_no="")
{
	global $link;
	$rez = mysql_query($sql_query, $link) or die("Query failed : " . mysql_error()."<br>Local er no : ".$err_no);
	return($rez);
}

/**********************************************************************************************/
//teoretic kiirja az osszes erteket az sql bufferbol (csak teszteknek)
function print_buffer()
{
    print "<table>\n";
    while ( $line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        print "\t<tr>\n";
        foreach ($line as $col_value) {
            print "\t\t<td>$col_value</td>\n";
#		print "\t\t<td>$a</td><td>$b</td>";
        }
        print "\t</tr>\n";
    }
    print "</table>\n";
}

/**********************************************************************************************/
//ezt a flashben hasznaltam es csak a megszokas kedveert van
//1 string-et hasznal mint valtozo nev es visszadja az erteket
function evalv($valtozonev)
{
	print($valtozonev." ".$ch1."<br>");
	return(${$valtozonev});
}


/**********************************************************************************************/
//kicsit funky a neve de a lenyeg hogy megkeresi hogy 1 user melyik groupokban van es visszaad 1 listat
function searchgroup($what,$criteria)
{
	$ik=1;
	open_database();
	$query="select gname from groups order by name asc";
	$result = search_database($query);
	while ( $line = mysql_fetch_array($result, MYSQL_ASSOC)) 
	  foreach ($line as $sgroup)
		{
		$sql_query="select \"".$what."\" from `".$sgroup."` where $criteria=$what";
		$result2 = search_database($sql_query);
		while ( $line2 = mysql_fetch_array($result2, MYSQL_ASSOC))
		  foreach ($line2 as $group)
			{
			$ret[$ik]=$sgroup;
			$ik++;
			}
		}
	$ret[0]=$ik;
//	close_database();
	return($ret);
}

/**********************************************************************************************/
//kikeresi az adatbazisbol a legnagyobb user uid-t
function find_minuid()
{
	//kerdezzuk meg a rendszert mit hasznaljunk
	$ret=system_get_next_free_uid(getct(min_uid));
	//ha meg nincs implementalva a fuggveny akkor 0-t fog visszaadni
	if($ret=="")
	{
		open_database();
		$query="select uid from users order by uid desc limit 0,1";
		$result = search_database($query);
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$ret=$line[uid]+1;
		close_database();
	}
	return($ret);
}

/**********************************************************************************************/
//kikeresi az adatbazisbol a legnagyobb user gid-t
function find_mingid()
{
	//kerdezzuk meg a rendszert mit hasznaljunk
	$ret=system_get_next_free_gid(getct(min_gid));
	//ha meg nincs implementalva a fuggveny akkor 0-t fog visszaadni
	if($ret=="")
	{
		open_database();
		$query="select gid from groups order by gid desc limit 0,1";
		$result = search_database($query,"find_mingid : keressuk ki a legnagyobb registralt gid-et : $query");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$ret=$line[gid]+1;
		close_database();
	}
	return($ret);
}

/**********************************************************************************************/
//general 1 minnel rovidebb egyedi user nevet
function find_minuname($full)
{
	//probaljuk generalni a standard formatumban
	strtolower($full);
	$pieces = explode(" ", $full);
	//a csalad neve
	$uname=$pieces[0];
	//a masodik neve elso betuje
	$t=$pieces[1];
	$uname.=$t[0];
	if($t[0]=="c" || $t[1]=="s")
		$uname.=$t[1];
	if($t[0]=="g" || $t[1]=="y")
		$uname.=$t[1];
	if($t[0]=="l" || $t[1]=="y")
		$uname.=$t[1];
	if($t[0]=="n" || $t[1]=="y")
		$uname.=$t[1];
	if($t[0]=="s" || $t[1]=="z")
		$uname.=$t[1];
	if($t[0]=="t" || $t[1]=="y")
		$uname.=$t[1];
	if($t[0]=="z" || $t[1]=="s")
		$uname.=$t[1];
	//nezzuk meg a username van-e regisztralva az adatbazisban aztan a rendszerben
	$line[uname]="";
	open_database();
	$query="select uname from users where uname='".$uname."'";
	$result = search_database($query);
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	//amig letezik ilyen user name addig toldjuk
/*
	//ezzel a metodussal addig egeszitsuk ki amig mar nincs egyforma hosszu (NINCS BEFEJEZVE)
	$ik=strlen($uname);
	while($line[uname]!="" && $ik<=strlen($full))
	{
		//space nem lehet a username-ben
		while($full[$ik]==" ")$ik++;
		//hozzatoldjuk a kovetkezo karaktert
		$uname.=$full[$ik];
		$ik++;
		//megint megnezzuk letezik-e ilyen
		open_database();
		$query="select uname from users where uname='".$uname."'";
		$result = search_database($query);
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
	}
	//ha elfogyott az osszes lehetseges karakter akkor probaljuk szamokkal
*/
	$i=1;
	while($line[uname]!="")
	{
		//megint megnezzuk letezik-e ilyen
		open_database();
		$query="select uname from users where uname='".$uname.$i."'";
		$result = search_database($query);
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		//ha nem letezik akkor jegyezzuk meg az eredmenyt
		if($line[uname]=="")
		{
			//ha nincs az adatbazisban akkor nezzuk meg a rendszerben van-e regisztralva
			if(system_is_uname_registered($uname)==0) $uname.=$i;
				else $line[uname]="insystem";
		}
		$i++;
	}
	return($uname);
}

/**********************************************************************************************/
// ez mindent elvegez ahoz,hogy 1 uj user keruljon a rendszerbe
//fontos ,hogy a parameter vektor index neve ugyanaz legyen mint az adatbazisban a field nevek
//uid, name, uname, passw, quota, quotaf, p_min, p_max, expire, inactive, forcepw, email, comment, reserved_text, reserved_int, skeletonpath, shellpath, samba, homepath
function add_user($paramv)
{
	//ha nem adtunk akkor ki kell kerese a legkisebb szabad user id-t
	if(isset($paramv[uid]) && $paramv[uid]!="")$l_p[uid]=$paramv[uid];
		else $l_p[uid]=find_minuid();
	//this is requered so we don't need to check it
	$l_p[name]=$paramv[name];
	//keresse ki a legmegfelelobb szabad user user nevet
	if(isset($paramv[uname]) && $paramv[uname]!="")$l_p[uname]=$paramv[uname];
		else $l_p[uname]=find_minuname($paramv[name]);
	//masolja le a username-et password-nak
	if(isset($paramv[passw]) && $paramv[passw]!="")$l_p[passw]=$paramv[passw];
		else $l_p[passw]=$l_p[uname];
	//quota
	if(isset($paramv[quota]) && $paramv[quota]!="")$l_p[quota]=$paramv[quota];
		else $l_p[quota]=getct(quota);
	//quota files
	if(isset($paramv[quotaf]) && $paramv[quotaf]!="")$l_p[quotaf]=$paramv[quotaf];
		else $l_p[quotaf]=getct(quotaf);
	//p_min
	if(isset($paramv[p_min]) && $paramv[p_min]!="")$l_p[p_min]=$paramv[p_min];
		else $l_p[p_min]=getct(p_min);
	//p_max
	if(isset($paramv[p_max]) && $paramv[p_max]!="")$l_p[p_max]=$paramv[p_max];
		else $l_p[p_max]=getct(p_max);
	//inactive
	if(isset($paramv[inactive]) && $paramv[inactive]!="")$l_p[inactive]=$paramv[inactive];
		else $l_p[inactive]=getct(inactive);
	//expire
	if(isset($paramv[expire]) && $paramv[expire]!="")$l_p[expire]=$paramv[expire];
		else $l_p[expire]=getct(expire);
	//fpassw
	if(isset($paramv[forcepw]) && $paramv[forcepw]!="")$l_p[forcepw]=$paramv[forcepw];
		else $l_p[forcepw]=getct(forcepw);
	//email
	if(isset($paramv[email]) && $paramv[email]!="")$l_p[email]=$paramv[email];
		else $l_p[email]=getct(email);
	//samba
	if(isset($paramv[samba]) && $paramv[samba]!="")$l_p[samba]=$paramv[samba];
		else $l_p[samba]=getct(samba);
	//skel
	if(isset($paramv[skeletonpath]) && $paramv[skeletonpath]!="")$l_p[skeletonpath]=$paramv[skeletonpath];
		else $l_p[skeletonpath]=getct(skeletonpath);
	//shel
	if(isset($paramv[shellpath]) && $paramv[shellpath]!="")$l_p[shellpath]=$paramv[shellpath];
		else $l_p[shellpath]=getct(shellpath);
	//comm
	if(isset($paramv[comment]) && $paramv[comment]!="")$l_p[comment]=$paramv[comment];
		else $l_p[comment]=getct(comment);
	//home ,ha nem kuldtek home direktori-t akkor a group-tol lekerdezzuk (feltetelezzuk csak 1 van)
	if(isset($paramv[homepath]) && $paramv[homepath]!="")$l_p[homepath]=$paramv[homepath];
		else 
			{
				$query="SELECT homepath FROM groups where gname=\"$paramv[gname]\"";
				$rez = search_database($query,"add_user : copy homepath from group $query");
				$line = mysql_fetch_array($rez, MYSQL_ASSOC);
				$l_p[homepath]=$line[homepath];
			}
//!!! erre nincs szukseg mert az uj szabaly szerint a user-t csak 1 group-al lehet regisztralni
	//a group problema
	//tordeljuk fel a string-et
//	$pieces=explode(" ",$paramv[group]);
	//mindegyik group-ba rakjuk be a uid-t
//	foreach($pieces as $gname)
//	{
//		$query="INSERT INTO `$gname` (uid) VALUES ($l_p[uid])";
//print("$query<br>");
//		$rez=search_database($query,"a group-ba teszi az uj user-t");
		//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! system call!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		//nincs erre szukseg mert a usert mindig 1 group-al egyutt kell a system-ben regisztralni
//		system_addto_group($l_p[uid],$gname);
//	}
	//rakjuk a uid-t abba a table-be amelynek a neve a user primary group-neve
	$query="INSERT INTO `$paramv[gname]` (uid) VALUES ($l_p[uid])";
	$rez=search_database($query,"add_user : a group-ba teszi az uj user-t : $query");
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
	//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! system call!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
	//add user to the system
	$l_p[gname]=$paramv[gname];
	system_add_user($l_p);
	//csinaljunk neki user info-t is
	$query="INSERT INTO user_info (uid, BI_seria, BI_numar, adresa1, tel1, tel2, comment, CNP, adresa2, ispublic, email1, email2, fax) VALUES ($l_p[uid], NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL)";
	$rez=search_database($query,"a userinfo-t letrehozza a usernek listaba teszi az uj usert : $query");
	//	close_database();
}

/**********************************************************************************************/
// ez mindent elvegez ahoz,hogy 1 user adatai megvaltozzanak mindenutt
function modify_user($old_uid,$paramv)
{
	//nezzuk meg sorra hogy mi valtozott es mit kell update-elni
	//elobb kerdezzuk le a regi ertekeket
//	open_database();
	$fieldlist="uid,name,uname,passw,quota,quotaf,p_min,p_max,expire,inactive,forcepw,email,comment,".
					"skeletonpath,shellpath,samba,homepath";
	$query="select ".$fieldlist." from users where users.uid=$old_uid";
	$result = search_database($query,"mod_user : kerjuk le a regi ertekeket $query");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	//aztan egyenkent hasonlitjuk,hogy dinamikus queryt es system call-t
		//inicializalasok, tobb mint bizonyos nincs szukseg rajuk de nem akarunk tevedni
		$set="";
		//biztos ami biztos uresitsuk ki a syst vektort
		if(isset($syst))foreach ($syst as $i => $value) unset($syst[$i]);
	//most nezzuk meg melyik valtozott ha valtozott akkor felepitjuk a valtozasokat vektorkent es query tipusban
	foreach($paramv as $key => $val)
		if($paramv[$key]!=$line[$key] && isset($line[$key]))
		//if data is considered wrong then we do not use it
		    if((canbenull($key)=="0" && ($paramv[$key]!="" )) || (canbenull($key)=="1"))
			{
				//itt felepit 1 dinamikus query-t , ami megvaltozott azt berakja a query-be
				$set.=$key."=\"".$paramv[$key]."\",";
				$syst[$key]=$paramv[$key];
			}
	if(strlen($set)>1)
	{
		//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! itten modositja a systemben az adatokat
		//csak azok vannak elkuldve amiket tenyleg kell modositani
		$syst[old_uid]=$old_uid;
		system_mod_user($syst);
		//itten modositja az adatbazisban az adatikat
		//az utolso karakterre nincs szuksegunk
		$set=substr($set, 0, strlen($set)-1);
		$query="UPDATE users SET ".$set." WHERE uid=$old_uid";
		$result = search_database($query,"mod_user : vegezzuk el a modositasokat $query");
	}
	//ha valtozott a uid akkor minden group-ban meg kell valtoztatni
	if($old_uid!=$paramv[uid])
	{
		$query="select gname from groups";
		$result=search_database($query,"modify_user : request all the group names : $query");
		while($line=mysql_fetch_array($result, MYSQL_ASSOC))
		{
			//volt registralva ebben a groupban ? (ha nem volt regisztralva akkor nem lehet update-elni
			$query2="UPDATE `$line[gname]` SET uid=$paramv[uid] WHERE uid=$old_uid";
			$result2=search_database($query2,"modify_user : change uid if necesary ? : $query2");
			//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!SYSTEM CALL
			//remove that user from the system and ad as the new one (is it necesary ?)
			//$pt=$syst;
			//$t[gname]=$line[gname];
			//$pt[uid]=$old_uid;
			//system_remfrom_group($pt);
			//$pt[uid]=$paramv[uid];
			//system_addto_group($pt);
		}
		
	}
	//1 kulon problema megnezni a user kerult-e mas group-ba
	$t=searchgroup($old_uid,"uid");
	$t2="";
	for($i=1;$i<$t[0];$i++)	$t2.=$t[$i]." ";
	$t2=substr($t2,0,strlen($t2)-1);
	//nezzuk meg valtozott-e a group lista
	if($paramv[gname]!=$t2) 
	{
		//tavolitsuk el a regi group-bol
		for($i=1;$i<$t[0];$i++)
		{
			$query="DELETE FROM ".$t[$i]." WHERE uid=$old_uid";
			$result = search_database($query,"mod_user : a regi group-bol vegyuk ki $query");
			//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1itt kiszedunk 1 usert a rendszer groupjabol
			//$pt=$syst;
			//$pt[gname]=$t[$i];
			//$pt[uid]=$old_uid;
			//system_remfrom_group($pt);
		}
		//rakjuk be az uj groupokba
		$t3=explode(" ",$paramv[group]);
		foreach($t3 as $key => $value)
		{
			$query="INSERT INTO ".$t3[$key]." (uid) VALUES (".$old_uid.")";
			$result=search_database($query,"mod_user : a uj group-ba rakjuk be $query");
			//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!itt regisztralunk a rendszer groupban 1 usert
			//$pt=$syst;
			//$pt[gname]=$t3[$key];
			//system_addto_group($pt);
		}
	}
//	close_database();
}


/**********************************************************************************************/
// ez mindent elvegez ahoz,hogy 1 user teljesen kitoroljon mindenunen
function delete_user($uid)
{
	//toroljuk ki a rendszerbol
	//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!11system call!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	system_delete_user($uid);
	//toroljuk ki az sql adatbazisbol mint user
	open_database();
	$query="DELETE FROM users WHERE uid=$uid";
	$rez=search_database($query,"delete_user : remove user from user list");
	//toroljuk ki minden group-bol
	$t=searchgroup($uid,"uid");
	for($i=1;$i<$t[0];$i++)
	{
		$query="DELETE FROM `$t[$i]` WHERE uid=$uid";
		$rez=search_database($query,"delete_user : remove user from groups $t[$i]");
		//toroljuk le a user info-jat is
		$query="DELETE FROM user_info WHERE uid=$uid";
		$rez=search_database($query,"delete_user : delete userinfo : $query");
		//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!11system call!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		system_remfrom_group($user,$t[$i]);
	}
//	close_database();
}

/**********************************************************************************************/
// ez mindent elvegez ahoz,hogy 1 uj group letrejojjon mindenutt
function add_group($paramv)
{
//	open_database();
	//nezuk meg, hogy meg 1 ilyen nevu group van-e
	$van=0;
	$sql_query="select gname from groups where gname=\"".$paramv[gname]."\"";
	$result = search_database($sql_query,"add_group: is the group name registered in the database ? : $query");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	if($line[gname]!="")$van=1;
		else 
		{
			//if gname is not registered in database let's see if is registered in the system
			$van=system_is_gname_registerd($paramv[gname]);
		}
	if($van==1)
	{
		popup("GROUP NAME ALREADY REGISTERED !!!!");
		return(0);
	}
	if($van==0)
	{
		//keresuk ki neki a legkisebb gid ha nincs megadva
		if(isset($paramv[gid]) && $paramv[gid]!="")$l_p[gid]=$paramv[gid];
			else $l_p[gid]=find_mingid();
		//name
		if(isset($paramv[name]) && $paramv[name]!="")$l_p[name]=$paramv[name];
			else $l_p[name]=$paramv[gname];
		//comment
		if(isset($paramv[comment]) && $paramv[comment]!="")$l_p[comment]=$paramv[comment];
			else $l_p[comment]=getct(noconfig);
		//homepath
		if(isset($paramv[homepath]) && $paramv[homepath]!="")$l_p[homepath]=$paramv[homepath];
			else $l_p[homepath]=getct(homepath);
		//homepath
		if(isset($paramv[isadmin]) && $paramv[isadmin]!="")$l_p[isadmin]=$paramv[isadmin];
			else $l_p[isadmin]=getct(isadmin);
		//tname , ez kotelezo ugyhogy helyesnek vesszuk
		$l_p[tname]=$paramv[tname];
		//gname , ez kotelezo ugyhogy helyesnek vesszuk
		$l_p[gname]=$paramv[gname];
		$miket="gid,name,comment,homepath,tname,gname,isadmin";
		$values=$l_p[gid].",\"".$l_p[name]."\",\"".$l_p[comment]."\",\"".$l_p[homepath]."\",\"".$l_p[tname]."\",\"".$l_p[gname]."\",\"".$l_p[isadmin]."\"";
		$sql_query="INSERT INTO groups (".$miket.") VALUES (".$values.")";
		$result = search_database($sql_query);
		$sql_query="create table `".$l_p[gname]."` (uid int primary key)";
		$result = search_database($sql_query);
		/////////////////////////////////////////////// SYSTEM CALLL////////////////////////
		//itten a rendszerben regisztralja a group-ot
		system_add_group($l_p);
	}
//	close_database();
  return(1);
}

/**********************************************************************************************/
// ez mindent elvegez ahoz,hogy 1 group letorlodjon mindenunnen
function delete_group($gid,$gname,$del_content)
{
//	open_database();
	//toroljuk ki a group listabol
	$sql_query="DELETE FROM groups WHERE gid=$gid";
	$result = search_database($sql_query,"delete_group : delete the group from the group list : $query");
	//in order to delte a group from the sistem it must not contain any user
    $sql_query="select uid from `".$gname."`";
	$result=search_database($sql_query,"delete_group : remove every user from the group in system: $query");
	while ( $line = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$paramv[uid]=$line[uid];
		$paramv[gname]=$gname;
		$paramv[gid]=$gid;
		/////////////////////////////////////////////// SYSTEM CALLL////////////////////////
		//remove a user from a group
		 system_remfrom_group($paramv);
	}
	//ha a benne levo osszes usert ki kell torolni
	if(isset($del_content))
	{
	   $sql_query="select uid from `".$gname."`";
	   $result=search_database($sql_query,"delete_group : delete every user from the group : $query");
	   while ( $line = mysql_fetch_array($result, MYSQL_ASSOC))
		 delete_user($line[uid]);
	}
	//toroljuk ki a tablazatot is
	$sql_query="DROP TABLE `".$gname."`";
	$result = search_database($sql_query,"delete_group : delete the table with the group name : $query");
//	close_database();	
	/////////////////////////////////////////////// SYSTEM CALLL////////////////////////
	//toroljuk ki  aredszerbol is
	$paramv[gid]=$gid;
	$paramv[gname]=$gname;
	system_delete_group($paramv);
}

/**********************************************************************************************/
//ez a fuggveny vegzi majd a group modositasokat mindenutt
function mod_group($old_gid,$paramv)
{
	//nezzuk meg mi valtozott es modositsuk meg 
//	open_database();
	$fieldlist="gid,name,tname,gname,comment,homepath,isadmin";
	$query="select ".$fieldlist." from groups where groups.gid='".$old_gid."'";
	$result = search_database($query,"mod_group : get old values $query");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	//aztan egyenkent osszehasonlitjuk a regi ertekekkel. Csinalunk 1 dinamikus queryt es system call-t
		//inicializalasok, tobb mint bizonyos nincs szukseg rajuk de nem akarunk tevedni
		$set="";
		//biztos ami biztos uresitsuk ki a syst vektort
		if(isset($syst))foreach ($syst as $i => $value) unset($syst[$i]);
	//most nezzuk meg melyik valtozott ha valtozott akkor felepitjuk a valtozasokat vektorkent + qeury tipusban
	//a lenyeg benne ,hogy megnezze helyes lessze a query : letezo tipusok es ertekeik
	foreach($paramv as $key => $val)
		if($paramv[$key]!=$line[$key] && isset($line[$key]))
		//if data is considered wrong then we do not use it
		    if((canbenull($key)=="0" && ($paramv[$key]!="" )) || (canbenull($key)=="1"))
		{
			//itt felepit 1 dinamikus query-t , ami megvaltozott azt berakja a query-be
			$set.=$key."=\"".$paramv[$key]."\",";
			$syst[$key]=$paramv[$key];
		}
	if(strlen($set)>1)
	{
		$syst[old_gid]=$old_gid;
		//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! itten modositja a systemben az adatokat
		system_mod_group($syst);
		//itten modositja az adatbazisban az adatikat
		//az utolso karakterre nincs szuksegunk
		$set=substr($set, 0, strlen($set)-1);
		$query="UPDATE groups SET ".$set." WHERE groups.gid='".$old_gid."'";
		$result = search_database($query,"mod_user : modify in the group list $query");
		//ha megvaltozott a gname akkor a table nevet is valtoztassuk meg
		if($paramv[gname]!=$line[gname] && $paramv[gname]!="")
		{
			$query="ALTER TABLE `".$line[gname]."` RENAME `".$paramv[gname]."`";
			$result = search_database($query,"mod_user : modify table names $query");
		}
	}
//	close_database();
}

/**********************************************************************************************/
//kinyit 1 uj ablakot amiben megjelenik valami szoveg(a szovegben nem szabad legyen ")
function popup($par)
{
	?>
	<script language="JavaScript" type="text/JavaScript">
		alert("<?=$par?>");
	</script>
	<?php
}


/**********************************************************************************************/
//lekeri az adatbazisbol 1 constans erteket
function getct($ctname)
{
	open_database();
	$query="select value from autofill where autofill.name=\"$ctname\"";
	$result=search_database($query,"getct : get the constant's value for constant name : $query");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	return($line[value]);
	close_database();
}


/**********************************************************************************************/
//megnezi hogy 1 tulajdonsag lehet-e null
function canbenull($ctname)
{
	open_database();
	$query="select value from canbenull where canbenull.name=\"$ctname\"";
	$result=search_database($query,"canbenull : get info if atr can be null : $query");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	return($line[value]);
	close_database();
}
?>