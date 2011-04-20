<?php
include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
if ($auth) {
$fileid = $_GET['plik']; // file to be send to the client
$speed = 50; // 8,5 kb/s download rate limit

$query = "SELECT * FROM files WHERE id='".$fileid."'";
$result = mysql_query($query);
$num=mysql_numrows($result);
if ($num==0) {
die("File not found.");
}
$filehash = mysql_result($result,0,"hash");
$filename = mysql_result($result,0,"name");
$filedowns = mysql_result($result,0,"downs");
$fileuid = mysql_result($result,0,"uid");
$filesize = mysql_result($result,0,"size");
$fileabuse = mysql_result($result,0,"abuse");
$query = "SELECT * FROM clients WHERE ip='".$down_ip_addr."'";
$result = mysql_query($query);
$num=mysql_numrows($result);
if ($num>0) {
if ($zalogowany==false) {
$lasttime = mysql_result($result,0,"time");
$diff = time() - $lasttime;
if ($diff<10) {
die("WAIT!".time());
}
$query = "UPDATE clients SET time='".time()."', fid='$fileid', filesize='$filesize' WHERE ip='$down_ip_addr'";
mysql_query($query);
}}else{
$query = "INSERT INTO clients VALUES ('".$down_ip_addr."','".time()."','".$fileid."', '', '$filesize')";
mysql_query($query);}
$filedowns++;
$query = "UPDATE files SET downs='".$filedowns."', lastdown='".time()."' WHERE id='".$fileid."'";
mysql_query($query);

if (!class_exists('S3'))require_once('S3.php');

//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJIOABZNYPODUHRIA');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

//instantiate the class  
$s3 = new S3(awsAccessKey, awsSecretKey);
 $fp = fopen($storagepath.$filehash, "wb");
$s3->getObject("cdn.gers.pl", $filehash, $fp);

$file = $storagepath.$filehash;
//If ($zalogowany==false) {
//mysql_close($mysql_db_link);}

if(file_exists($file) && is_file($file)) {

   header("Cache-control: private");
   header("Content-Type: application/octet-stream"); 
  // header("Content-Length: ".filesize($file));
   header("Content-Disposition: filename=$filename");

    header("Accept-Ranges: bytes");
    $range = 0;
    $size = filesize($file);

    if(isset($_SERVER['HTTP_RANGE'])) {
        list($a, $range)=explode("=",$_SERVER['HTTP_RANGE']);
        str_replace($range, "-", $range);
        $size2=$size-1;
        $new_length=$size-$range;
        header("HTTP/1.1 206 Partial Content");
        header("Content-Length: $new_length");
        header("Content-Range: bytes $range$size2/$size");
    } else {
        $size2=$size-1;
        header("Content-Range: bytes 0-$size2/$size");
        header("Content-Length: ".$size);
    }
 if ($size == 0 ) { die('Zero byte file! Aborting download');}
   flush();

   $fd = fopen($file, "r");
   fseek($fd,$range);
if ($zalogowany==true & $bw>0) {
while(!feof($fd)) {
         echo fread($fd, round(1024*1024));
       flush();
--$bw;
++$ppoints;
++$ppoints;

//sleep(1);
       }
       $query = "UPDATE users SET bandwidth='".$bw."', premiumpoints='".$ppoints."' WHERE uid='$uid'";
mysql_query($query); // jeśli będą problemy z wydajnością to całość załatwić z góry lub po
//if ($bw<0) {
//$bw=0;
//}
//$query = "UPDATE users SET bandwidth='".$bw."', premiumpoints='".$ppoints."' WHERE uid='$uid'";
//mysql_query($query);
if($fileuid!=0 && $fileuid!=$uid)
{
$query = "SELECT premiumpoints FROM users WHERE uid='$fileuid'";
$result = mysql_query($query);
$num = mysql_numrows($result);
if($num>0)
{
$uploaderppoints=mysql_result($result,0,"premiumpoints");
$uploaderppoints=$uploaderppoints+(round($filesize/(1024*1024)))*2;
$query = "UPDATE users SET premiumpoints='$uploaderppoints' WHERE uid='$fileuid'";
mysql_query($query);
$uploaderppoints=mysql_result($result,0,"superpremium");
$uploaderppoints=$uploaderppoints+(round($filesize/(1024*1024)));
$query = "UPDATE users SET superpremium='$uploaderppoints' WHERE uid='$fileuid'";
mysql_query($query);
}
}
mysql_close($mysql_db_link);
}else{
   

  while(!feof($fd)) {
         echo fread($fd, round($speed*1024));
       flush();
       sleep(1);
}
 if($fileuid!=0 && $fileuid!=$uid)
{
$query = "SELECT premiumpoints FROM users WHERE uid='$fileuid'";
$result = mysql_query($query);
$num = mysql_numrows($result);
if($num>0)
{
$uploaderppoints=mysql_result($result,0,"premiumpoints");
$uploaderppoints=$uploaderppoints+round($filesize/(1024*1024));
$query = "UPDATE users SET premiumpoints='$uploaderppoints' WHERE uid='$fileuid'";
mysql_query($query);
}
}
mysql_close($mysql_db_link);
}
   fclose ($fd);
   unlink ($file);

}}else{ header( 'Location: http://'.$domain.'/download.php?plik='.$_GET['plik'] ) ;}

?> 
