<?php

include 'database.inc.php';
include 'vars.inc.php';
if ($_GET['type']=="checked") {
$checkfiles = $_POST['checkfiles'];
foreach($checkfiles  as  $value)  {
$checkarr = explode("_",$value);
$fileid = $checkarr[0];
$sec = $checkarr[1];
$query = "SELECT * FROM files WHERE id='".$fileid."'";
$result = mysql_query($query);
$num=mysql_numrows($result);
if ($num==0) {
header( 'Location: http://'.$domain.'/user.php?delmsg=fail' );
}
$filehash = mysql_result($result,0,"hash");
$sechash = mysql_result($result,0,"securityhash");
$filename = mysql_result($result,0,"name");
if ($sechash==$sec) {
$query = "SELECT * FROM files WHERE hash='".$filehash."'";
$result = mysql_query($query);
$num=mysql_numrows($result);
if ($num==1) {
unlink($storagepath.$filehash);}
$query="DELETE FROM files WHERE id='".$fileid."'";
mysql_query($query);
}
} //end foreach
header( 'Location: http://'.$domain.'/user.php?delmsg=ok' );
}else{
$fileid = $_GET['plik']; // file to be send to the client
$sec = $_GET['security'];

$query = "SELECT * FROM files WHERE id='".$fileid."'";
$result = mysql_query($query);
$num=mysql_numrows($result);
if ($num==0) {
if ($_GET['a']=="b")
{
header( 'Location: http://'.$domain.'/user.php?delmsg=fail' );
}else{
header( 'location: http://'.$domain.'/up.php?delmsg=fail' );
}
}
$filehash = mysql_result($result,0,"hash");
$sechash = mysql_result($result,0,"securityhash");
$filename = mysql_result($result,0,"name");
if ($sechash==$sec) {
$query = "SELECT * FROM files WHERE hash='".$filehash."'";
$result = mysql_query($query);
$num=mysql_numrows($result);
if ($num==1) {
unlink($storagepath.$filehash);}
$query="DELETE FROM files WHERE id='".$fileid."'";
mysql_query($query);
if ($_GET['a']=="b")
{
header( 'Location: http://'.$domain.'/user.php?delmsg=ok' );
}else{
header( 'location: http://'.$domain.'/up.php?delmsg=ok' );
}
}
} //end if checked
mysql_close($mysql_db_link);

?> 
