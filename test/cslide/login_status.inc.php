<?php
$zalogowany=false;
$auth=false;
$csid = 123;
if (isset($_COOKIE['polskirapid'])) {$csid = $_COOKIE['polskirapid'];}
if (isset($_POST['polskirapid'])) {$csid = $_POST['polskirapid'];}
$down_ip_addr=$_SERVER['REMOTE_ADDR'];
$query = "SELECT * FROM users WHERE sid='".$csid."'";
$result=mysql_query($query);
$num=mysql_numrows($result);
if ($num>0) {
$ulogin=mysql_result($result,0,'login');
$uid=mysql_result($result,0,'uid');
$bw=mysql_result($result,0,'bandwidth');
$ppoints=mysql_result($result,0,'premiumpoints');
$zalogowany=true;
if ($bw>0) {
$auth=true;}
}

if ($auth==false) {
$query = "SELECT * FROM clients WHERE ip='".$down_ip_addr."'";
$result=mysql_query($query);
$num=mysql_numrows($result);
if ($num>0) {
$authkey=mysql_result($result,0,'authkey');
if ($authkey==$_GET['authkey']) {
$auth=true;}
}}
?>
