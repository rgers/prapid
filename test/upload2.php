<?php
set_time_limit(0);
if (isset($_POST["PHPSESSID"])) {
		session_id($_POST["PHPSESSID"]);
	}
	session_start();
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
rename($uploadpath.$plik_nazwa,$storagepath.$fid);}

echo '<table><tr>';
echo '<td>Plik:</td><td>';
echo "$plik_nazwa</td></tr>";
if($uid!=0)
{
echo "<tr><td>Punkty premium: </td><td>".round($plik_rozmiar/(1024*1024),0)."</td></tr>";
}
echo "<tr><td>Link do ściągnięcia:</td><td><a href=download.php?plik=".$id.">http://".$domain."/download.php?plik=".$id."</a></td></tr>";
echo '<tr><td>Link do usunięcia:</td><td><a href="del.php?plik='.$id.'&security='.$sec.'">http://'.$domain.'/del.php?plik='.$id.'&security='.$sec.'</a></td></tr></table>';
}
?> 
