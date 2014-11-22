<?php
//hatha egyes helyeken nem menti le az oldalt es a security novekszik
//header("Cache-Control: no-store, no-cache, must-revalidate");
//header("Cache-Control: post-check=1, pre-check=1", false);
include "initpage.php";
//php-be van megcsinalva mert itt tobb frame is lehet 1 frame-set ben
print("<frameset rows=\"*\" cols=\"85,*\" framespacing=\"0\" frameborder=\"Yes\" border=\"1\">");
//print("<frameset rows=\"*\" cols=\"120,60%,*\" framespacing=\"0\" frameborder=\"Yes\" border=\"1\">");
print("<frame src=\"main_left.php\" name=\"leftFrame\" scrolling=\"NO\" noresize>");
print("<frame src=\"main_midle.php\" name=\"midleFrame\" scrolling=\"yes\">");
//print("<frame src=\"main_right.php\" name=\"rightFrame\" scrolling=\"yes\">");
//print("</frameset>");
//<iframe src="main_left.php" name="leftFrame" scrolling="NO" noresize height="100%" width="120px" framespacing="0" frameborder="Yes" border="1"></iframe>
?>


