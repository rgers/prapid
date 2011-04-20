<?php
set_time_limit(0);

include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';

if ($handle = opendir('../myupload')) {
    echo "Directory handle: $handle\n";
    echo "Files:\n";

    /* This is the correct way to loop over the directory. */
    while (false !== ($file = readdir($handle))) {
        echo "$file\n";
if($file!="." && $file!="..")
{
$plik_tmp = "../myupload/".$file;
$plik_nazwa = $file;
$plik_rozmiar = filesize($plik_tmp);

$fid=md5_file($plik_tmp);
$id=time().mt_rand(100,999);
$sec=$fid.mt_rand(1000,9999);
$query = "INSERT INTO files VALUES ('".$id."','$fid', '$plik_nazwa','".$plik_rozmiar."','$sec','$uid','0', '".time()."', '0')";
mysql_query($query);
if($uid!=0)
{
$ppoints=round($ppoints + $plik_rozmiar/(1024*1024),0);
$query = "UPDATE users SET premiumpoints='$ppoints' WHERE uid='$uid'";
mysql_query($query);
}
$query = "SELECT * FROM files WHERE hash='".$fid."'";
$result = mysql_query($query);

if (mysql_numrows($result)>1) {
unlink($plik_tmp);
}else{
rename($plik_tmp,$storagepath.$fid);}

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
    }

    closedir($handle);
    mysql_close($mysql_db_link);
}

?> 
