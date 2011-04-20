<?php
include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
$ulogin = $_POST['login'];
$upassword = $_POST['password'];
$nick = $_POST['nick'];
$frompage = $_GET['frompage'];
$query = "SELECT * FROM users WHERE login='$ulogin'";
$result = mysql_query($query);
$num = mysql_numrows($result);
$query = "SELECT * FROM users WHERE nick='$nick'";
$result = mysql_query($query);
$num2 = mysql_numrows($result);
if($num==0 && $num2==0)
{
$uid = time().mt_rand(1,999);
$newsid = md5(time().$upassword.$ulogin);
setcookie("polskirapid",$newsid, mktime(1,1,1,1,1,2020),"/",".polskirapid.pl");
$query = "INSERT INTO users VALUES ('".$uid."','$ulogin', '$nick', '".md5($upassword)."','".$ulogin."','$newsid','0','0','0')";
mysql_query($query);
mysql_close();
if ($frompage=="sciagajszybko")
    {
 header( 'Location: http://'.$domain.'/kuptransfer.php?plik='.$_GET['plik']);
}else{
header( 'Location: http://'.$domain.'/user.php' );
}
}else{

if($num2==0)
{
header( 'Location: http://'.$domain.'/adduser.php?msg=existsemail' );
}else{
header('Location: http://'.$domain.'/adduser.php?msg=existsnick' );
}
}
?>
