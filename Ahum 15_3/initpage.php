<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=1, pre-check=1", false);

session_start();
if(!isset($_SESSION[s_user]) || ($_SESSION[s_user]!=$_POST[s_user] && isset($_POST[s_user])))$_SESSION[s_user]=$_POST[s_user];
if(!isset($_SESSION[s_passw]) || ($_SESSION[s_passw]!=$_POST[s_passw] && isset($_POST[s_user])))$_SESSION[s_passw]=$_POST[s_passw];

include "fuggvenyek.php";

open_database();
$user_acces=acces_code($_SESSION[s_user],$_SESSION[s_passw]);
close_database();

//ha lejart az oldal ideje vagy egyebb okbol tobbet nincs meg a user es passw 
//akkor visszakuld a login page-re
if($user_acces!=getct(admin_acces))
{
	?>
	<script>
	alert("Incorect user or password or not enough acces : <?=$user_acces?>\n\n Please log in again.")
	document.location="index.html" 
	</script>
	<?php
	exit;
}

?>
