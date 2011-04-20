<?php
$user="uploaduser";
$password="uploaduser";
$database="upload";
$mysql_db_link=mysql_connect("127.0.0.1",$user,$password);
@mysql_select_db($database) or die("Unable to select db.");
?>
