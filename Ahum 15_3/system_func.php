<?php

/**********************************************************************************************/
//ez a fuggveny vegzi majd a user modositasokat a renszerben
function system_mod_user($paramvect)
{

}

/**********************************************************************************************/
//ez a fuggveny vegzi majd a group modositasokat a renszerben
//aszem nem is kell csinaljon semmit de meggondolasbol be van teve
function system_mod_group($paramvect)
{
}

/**********************************************************************************************/
//a user kitorlodik a megadott group-bol. User identify by uid, group by gname
function system_remfrom_group($paramv)
{
	
}

/**********************************************************************************************/
//a user resze lessz a megadott group-nak. User identify by uid, group by gname
function system_addto_group($paramv)
{
}

/**********************************************************************************************/
//registralja a usert a rendszerben
function system_add_user($paramv)
{
}

/**********************************************************************************************/
//registralja a usert a rendszerben
function system_add_group($paramv)
{
}

/**********************************************************************************************/
//kitorli a usert a rendszerbol
function system_delete_user($uid)
{
}

/**********************************************************************************************/
//kitorli a groupot a rendszerbol
function system_delete_group($paramv)
{
}

/**********************************************************************************************/
//megkeresi a kovetkezo szabad de legkisebb gid-et a rendszerben mint mingid
function system_get_next_free_gid($mingid)
{
	return("");
}

/**********************************************************************************************/
//megkeresi a kovetkezo szabad de legkisebb uid-et a rendszerben mint mingid
function system_get_next_free_uid($minuid)
{
	return("");
}

/**********************************************************************************************/
//checks if the group name is registered in the system
function system_is_gname_registerd($gname)
{
	return(0);
}

/**********************************************************************************************/
//checks if the group name is registered in the system
function system_is_uname_registerd($uname)
{
	return(0);
}

/**********************************************************************************************/
//returns all the group names registered in the system(maybe not all of them) and gid
function system_get_all_gnames()
{
//	$retv[id1]=100;
//	$retv[gname1]="tt";
	return($retv);
}

/**********************************************************************************************/
//returns all the group names registered in the system(maybe not all of them) and gid
function system_get_all_unames()
{
	$retv[id1]=100;
	$retv[uname1]="tt";
	return($retv);
}
?>