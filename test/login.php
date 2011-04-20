<?php
include 'database.inc.php';
include 'vars.inc.php'; 
$ulogin = $_POST["login"];
$upassword = $_POST["password"];
$frompage = $_GET["frompage"];
$query = "SELECT * FROM users WHERE login='$ulogin'";
$result=mysql_query($query);
$passindb=mysql_result($result,0,"password");
if (md5($upassword)==$passindb) {
$newsid = md5(time().$upassword.$ulogin);
setcookie("polskirapid",$newsid, mktime(1,1,1,1,1,2020),"/",".polskirapid.pl");
$query = "UPDATE users SET sid='".$newsid."' WHERE login='".$ulogin."'";
mysql_query($query);
if ($frompage=="sciagajszybko")
    {
    header( 'Location: http://'.$domain.'/kuptransfer.php?plik='.$_GET['plik'] ) ;
}else{
header( 'Location: http://'.$domain.'/user.php' ) ;
}
}else{echo "BAD PASS";}
mysql_close($mysql_db_link);
?>
