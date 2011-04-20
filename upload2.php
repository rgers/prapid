<?php
set_time_limit(0);

include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';

$plik_tmp = $_FILES['Filedata']['tmp_name'];
$plik_nazwa = $_FILES['Filedata']['name'];
$plik_rozmiar = $_FILES['Filedata']['size'];
if(is_uploaded_file($plik_tmp)) {
move_uploaded_file($plik_tmp, $uploadpath.$plik_nazwa);
$fid=md5_file($uploadpath.$plik_nazwa);
$id=time().mt_rand(100,999);
$sec=$fid.mt_rand(1000,9999);
$query = "INSERT INTO files VALUES ('".$id."','$fid', '$plik_nazwa','".filesize($uploadpath.$plik_nazwa)."','$sec','$uid','0', '".time()."', '0')";
mysql_query($query);
if($uid!=0)
{
$ppoints=round($ppoints + $plik_rozmiar/(1024*1024),0);
$query = "UPDATE users SET premiumpoints='$ppoints' WHERE uid='$uid'";
mysql_query($query);
}
$query = "SELECT * FROM files WHERE hash='".$fid."'";
$result = mysql_query($query);
mysql_close($mysql_db_link);
if (mysql_numrows($result)>1) {
unlink($uploadpath.$plik_nazwa);
}else{
//rename($uploadpath.$plik_nazwa,$storagepath.$fid);
//cloud time :-)
    if (!class_exists('S3'))require_once('S3.php');

//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJIOABZNYPODUHRIA');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

//instantiate the class  
$s3 = new S3(awsAccessKey, awsSecretKey);
  //create a new bucket
$s3->putBucket("cdn.gers.pl", S3::ACL_PRIVATE);

//move the file
if ($s3->putObjectFile($uploadpath.$plik_nazwa, "cdn.gers.pl", $fid, S3::ACL_PUBLIC_READ)) {
    echo "<bt />Wysy³anie powiod³o siê.";
}else{
    echo "<br />Przykro nam, niestety wysy³anie nie powiod³o siê.";
}
unlink($uploadpath.$plik_nazwa);


}

echo '<br /><table border=1 width=100><tr>';
echo '<td>Plik:</td><td>';
echo "$plik_nazwa</td></tr>";
if($uid!=0)
{
echo "<tr><td>Punkty premium: </td><td>".round($plik_rozmiar/(1024*1024),0)."</td></tr>";
}
echo "<tr><td>Link do Å›ciÄ…gniÄ™cia:</td><td><a href=http://".$domain."/download.php?plik=".$id.">http://".$domain."/".$id."/".$plik_nazwa."</a></td></tr>";
echo '</table>';
}
?> 
