<?php
$yoursite = "polskirapid.pl"; //Your site url without http://
$yoursite2 = "www.polskirapid.pl"; //Type your domain with www. this time
$thumb = $_GET['thumb'];
$referer = $_SERVER['HTTP_REFERER'];

//Check if browser sends referrer url or not
if ($referer == "") { //If not, set referrer as your domain
$domain = $yoursite;
} else {
$domain = parse_url($referer); //If yes, parse referrer
}

if($domain['host'] == $yoursite || $domain['host'] == $yoursite2 || $thumb=="yes") {

include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
$fileid = $_GET['plik'];
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
$filedowns++;
$query = "UPDATE files SET downs='".$filedowns."', lastdown='".time()."' WHERE id='".$fileid."'";
mysql_query($query);
$file = $storagepath.$filehash;
if($thumb=="yes")
    {

    if(!file_exists($file."_thumb"))
            {
        $src_img=imagecreatefromjpeg($file);
        $new_w=200;
        $new_h=200;
        $old_x=imageSX($src_img);
$old_y=imageSY($src_img);
if ($old_x > $old_y) {
	$thumb_w=$new_w;
	$thumb_h=$old_y*($new_h/$old_x);
}
if ($old_x < $old_y) {
	$thumb_w=$old_x*($new_w/$old_y);
	$thumb_h=$new_h;
}
if ($old_x == $old_y) {
	$thumb_w=$new_w;
	$thumb_h=$new_h;
}
$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
        imagejpeg($dst_img,$file."_thumb");
        imagedestroy($dst_img);
imagedestroy($src_img);
    }
    $file=$file."_thumb";
}
if(file_exists($file) && is_file($file)) {

   header("Cache-control: private");
   header("Content-Type: image/jpeg");
   header("Content-Length: ".filesize($file));
   header("Content-Disposition: filename=$filename");
    $fd = fopen($file, "r");
    while(!feof($fd)) {
         echo fread($fd, round(1024*1024));
       flush();
    }
    fclose ($fd);
    mysql_close($mysql_db_link);

}

} else {

//The referrer is not your site, we redirect to your home page
header("Location: http://www.polskirapid.pl/showimg.php?plik=".$fileid);
exit(); //Stop running the script

}

?>