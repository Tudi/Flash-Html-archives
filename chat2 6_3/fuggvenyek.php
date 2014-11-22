<?php

function alert($par)
{
	?>
	<script language="JavaScript" type="text/JavaScript">
		alert("<?=$par?>");
	</script>
	<?php
}
function open_database()
{
	global $link;
    $link = mysql_connect(sql_hostname, sql_username, sql_password) or die("Could not connect : " . mysql_error());
    mysql_select_db(sql_database) or die("Could not select database");
	return($link);
}
function close_database()
{
	global $rezult;
	global $link;
    if (isset($result)) mysql_free_result($result);
    if (isset($link)) mysql_close($link);
}
function search_database($sql_query,$err="")
{
	global $link;
	$rez = mysql_query($sql_query, $link) or die("Query failed : " . mysql_error()."<br>Local error : ".$err);
	return($rez);
}
?>