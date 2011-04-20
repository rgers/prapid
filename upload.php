<?php
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0
Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
transitional.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html;
charset=utf-8" />
<title>Upload</title>
</head>
<body>
<?php
$csid = $_COOKIE['polskirapid'];
$user="uploaduser";
$password="uploaduser";
$database="upload";
mysql_connect(localhost,$user,$password);
@mysql_select_db($database) or die("Unable to select db.");
$query = "SELECT * FROM users WHERE sid='".$csid."'";
$result=mysql_query($query);
$num=mysql_numrows($result);
if ($num>0) {
$ulogin=mysql_result($result,0,'login');
$uid=mysql_result($result,0,'uid');
$zalogowany=true;
echo "Uzytkownik zalogowany jako ".$ulogin;
}
?>
<div>
<form enctype="multipart/form-data" action="upload.php"
method="POST">
<input name="plik" type="file" />
<input type="submit" value="Wyślij plik" />
</form>
</div>

<?php
$plik_tmp = $_FILES['plik']['tmp_name'];
$plik_nazwa = $_FILES['plik']['name'];
$plik_rozmiar = $_FILES['plik']['size'];
if(is_uploaded_file($plik_tmp)) {
set_time_limit(0);
//$user="uploaduser";
//$password="uploaduser";
//$database="upload";
//mysql_connect(localhost,$user,$password);
//@mysql_select_db($database) or die("Unable to select db.");
move_uploaded_file($plik_tmp, "upload/$plik_nazwa");
$fid=md5_file("upload/$plik_nazwa");
$id=time().mt_rand(100,999);
$sec=$fid.mt_rand(1000,9999);
$query = "INSERT INTO files VALUES ('".$id."','$fid', '$plik_nazwa','".filesize("upload/$plik_nazwa")."','$sec','$uid')";
mysql_query($query);
mysql_close();
rename("upload/$plik_nazwa","upload/".$fid);

echo 'Plik: <a href="dl.php?plik='.$id.'">';
echo "$plik_nazwa</a>";
echo "<br />Link: http://127.0.0.1/upload/".$fid;
echo '<br />Delete Link: <a href="del.php?plik='.$id.'&security='.$sec.'">DELETE</a>';
}
?> 
</body>
</html>
