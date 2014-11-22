<?php
session_start();
include "config.php";
include "fuggvenyek.php";

//keressuk ki az utolso kiirtol a tenyleg utolso msg-ig
$last_mid=$_SESSION[last_msg_id];
//nezzuk meg ,hogy a timer hivta-e meg a page-et vagy a user kuldott valamit?
if(isset($_POST[kapott]) && $_POST[kapott]!="" && strlen($_POST[kapott])<msg_maxlen)
 {
	 //ha igen akkor kezeljuk
	//vagjuk ki belole a szpecialis karaktereket "enter" "esc" "home" ..
	$to_write=$_POST[kapott];
	$t="";
	for($i=0;$i<=strlen($to_write);$i++)
		if(ord($to_write[$i])!=0 && ord($to_write[$i])!=10 && ord($to_write[$i])!=13)
		   $t.=$to_write[$i];
	$to_write=$t;
	//vagjuk le a vegerol a " "-eket
	$to_write=rtrim($to_write);
	 //az elejerol a rakas " "-et
	 $to_write=ltrim($to_write);
	if($to_write!="")
	 {
		// keressuk ki a user id-szerint a user adatait
		$session_uid=$_SESSION[uid];
		open_database();
		$query="select uid,nick_style,u_acces,u_group,u_nick,u_name from users where users.uid=".$session_uid;
		$result=search_database($query,"Refresh.php : a user adatait probalja lekerni aki a msg-et kuldi :'$query'");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		//a szoveget ertelmezzuk ahany felekeppen csak kell/lehet kivetel ha "" kozt van
		//ha nincs acces-je htm-ben irni akkor modositjuk ugy ,hogy kiirja majd karakterenkent
		if($line[u_acces]<acces_html || ($to_write[1]=="\"" && $to_write[strlen($to_write)-1]=="\"")) $to_write=htmlentities($to_write);
		 else if($to_write[1]!="\"" && $to_write[strlen($to_write)-1]!="\"")
		 {
			//a smiley-kat helyetesitsuk be
			foreach($smiley as $key => $value)
				 $to_write=str_replace($value,$smiley_r[$key],$to_write);
		 }
		//keresuk ki az utolso msg id-jat
		$query="select mid from msgs order by mid desc limit 0,1";
 		$result2=search_database($query,"Refresh.php : megkeresi az utolso msg-id-t : $query");
		$line2 = mysql_fetch_array($result2, MYSQL_ASSOC);
		//ragaszuk az elejere kitol van (nick)
		$to_write="<a href=\"msg_info.php?uid=".$line[uid]."&msg_id=".($line2[mid]+1)."\" target=\"_blank\" style=\"".$line[nick_style]."\">".$line[u_nick]."</a> : ".$to_write;
		//lementsuk mikor kuldte a msg-et
		$today=getdate();
		if(strlen($today[mon])<2)$today[mon]="0".$today[mon];
		if(strlen($today[mday])<2)$today[mday]="0".$today[mday];
		if(strlen($today[hours])<2)$today[hours]="0".$today[hours];
		if(strlen($today[minutes])<2)$today[minutes]="0".$today[minutes];
		if(strlen($today[seconds])<2)$today[seconds]="0".$today[seconds];
		$t_date=$today[year]."-".$today[mon]."-".$today[mday]."-".$today[hours]."-".$today[minutes]."-".$today[seconds];
		//a szoveget igy irassa ki ahogy van
		$to_write=htmlentities($to_write, ENT_QUOTES);
		$query="INSERT INTO msgs (msg, uid, mid, m_time) VALUES ('".$to_write."',".$session_uid.",NULL,'".$t_date."')";
		$result=search_database($query,"Refresh.php : probalja a kuldott msg-et eltarolni : $query");
		close_database();
	 }
 }


$to_write="";
open_database();
$query="select msg,mid from msgs where msgs.mid>".$last_mid." order by mid asc";
$result=search_database($query,"Refresh.php : probalja az uj messageket kikeresni");
while($line = mysql_fetch_array($result, MYSQL_ASSOC))
{
	//a msg-ek mar ertelmezve vannak mi csak ki kell irjuk
	 $to_write=$to_write.$line[msg]."<br>";
	 $last_mid=$line[mid];
}
$_SESSION[last_msg_id]=$last_mid;
print("<form action=\"refresh.php\" method=\"post\" name=\"form_refr\" target=\"_self\"> <br>\n");
print("<input type=hidden name=kapott id=kapott value='' >");
print("</form>");
//ez nem kell form-ba keruljon mert senkit se erdekel
//ezt ki lehetne szedni ha lenne megoldas hogyan adkunk at 1 barmilyen string-et javascript-nek
print("<input type=\"hidden\" name=\"kiirni\" id=\"kiirni\" value=\"".$to_write."\" >");

//kerdezzuk le a user refresh-time-jat
$query="select u_refrt from users where uid=".$_SESSION[uid];
$result=search_database($query,"Refresh.php : lekeri a user refresh time-jat");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$refreshtime=$line[u_refrt];
close_database();
?>
<script language='JavaScript'>
window.setTimeout("refresh_tartalom(1)", 1000*<?=$refreshtime ?>);
</script>
<script  src='refresh.js' language='JavaScript' type='text/JavaScript'>
</script>
<script language='JavaScript'>
  parent.frame_kuldott.document.form_kuld.mit_kuld.focus();
</script>
