<?php

include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
$fid=$_GET['plik'];
$query = "SELECT * FROM files WHERE id='$fid'";
$result = mysql_query($query);
$num=mysql_numrows($result);
if ($num>0) {
$filename = mysql_result($result,0,"name");
$filesize = mysql_result($result,0,"size");
$filedowns = mysql_result($result,0,"downs");
$abuse = mysql_result($result,0,"abuse");
}
if ($bw>0 && $abuse==0)
{
header( 'Location: http://'.$domain.'/dl.php?plik='.$_GET['plik'] ) ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-type" content="text/html;
charset=utf-8" />
<title>Ściągnij plik</title>
<link href="css/default.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery.fancybox-1.3.0.css" type="text/css" media="screen" />
	<style type="text/css">
		 table td {
			width: 250px;
			white-space: nowrap;
			padding-right: 0px;
		}
		 table tr:nth-child(2n+1) {
			background-color: #EEEEEE;
		}
		 table td:first-child {
			font-weight: bold;
		}

table td:nth-child(2) {
			font-weight: bold;
}
		 table td:nth-child(3) {
			text-align: right;
			font-family: monospaced;
		}

	</style>
   <?php include 'jsfuncs.php'; ?>
</head>
<body>
    <?php
 
include 'menu.php';
?>
    <div align="center">
<?php

$authkey=md5(time().$down_ip_addr."bongobongo");
if ($num>0)
    {
$dllink="dl.php?plik=".$_GET['plik']."&authkey=".$authkey;
echo "<table><tr>";
echo "<td>Plik: </td><td>".$filename."</td></tr><tr>";
echo "<td>Rozmiar: </td><td>".$filesize." bajtów.</td></tr><tr>";
echo "<td colspan=2>Plik został ściągnięty już ".$filedowns." razy.</td></tr></table>";
if ($abuse==1) {
    echo "Zostało zgłoszone naruszenie regulaminu. Plik zostanie zanalizowany w ciągu 48 godzin. Do tego czasu plik jest niedostępny.";
die();}
echo "<a href='abuse.php?plik=".$_GET['plik']."'>Zgłoś naruszenie regulaminu</a><br /><br />";
}else{
  
die("Plik nie znaleziony.");}
$query = "SELECT * FROM clients WHERE ip='".$down_ip_addr."'";
$result = mysql_query($query);
$num=mysql_numrows($result);
if ($num>0) {
$lasttime = mysql_result($result,0,"time");
$diff = time() - $lasttime;
if ($diff<$filesize/500000) {
    echo 'Niedawno ściągałeś plik. Po raz kolejny będziesz mógł ściągnąć plik za ';
    echo round(($filesize/500000)-$diff,2);
    echo " sekund. Jeśli nie chcesz czekać wykup transfer Premium, już od 10gr za 1GB!<br /><br />";
    $dllink = "download.php?plik=".$_GET['plik'];
}

$query = "UPDATE clients SET fid='$fileid', authkey='$authkey', filesize='$filesize' WHERE ip='$down_ip_addr'";
mysql_query($query);
}else{
$query = "INSERT INTO clients VALUES ('".$down_ip_addr."','0','".$fileid."', '".$authkey."', '".$filesize."')";
mysql_query($query);
}

?> 
    
<!--<form action="dl.php"
method="GET">
<input name="plik" type="hidden" value="<?php echo $_GET['plik'];?>" /><br />
<input name="authkey" type="hidden" value="<?php echo $authkey;?>" /><br />
<input type="submit" value="Ściągnij Plik" />
</form>
-->
<script type="text/javascript"><!--
google_ad_client = "pub-7163326837927031";
/* 300x250, utworzono 10-01-28 */
google_ad_slot = "2534086355";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<!--<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>-->
<img src="images/kasa150px.gif" style="float: none;"/><img src="images/zarobek.gif"/><br /><span style="font-size: large;">Umieszczaj pliki, dziel się nimi i zarabiaj!<br />Dostaniesz pieniądze
        za każdy megabajt ściągnięty z Twojego konta korzystając z transferu premium. Jeśli ktoś ściągnie 1GB (np. 1 film) dostaniesz za to 20gr. Jeśli ściągnie go 100 osób
        dostaniesz za to aż 20zł!</span><br />
<table border="0" cellpadding="0" cellspacing="0" width="757">
 <tr>
   <td colspan="5"><img name="tabela_porownawcza_r1_c1" src="images/tabela_porownawcza_r1_c1.png" width="757" height="474" border="0" id="tabela_porownawcza_r1_c1" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2"><img name="tabela_porownawcza_r2_c1" src="images/tabela_porownawcza_r2_c1.png" width="240" height="62" border="0" id="tabela_porownawcza_r2_c1" alt="" /></td>
   <td><a href="<?php echo $dllink;?>" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('tabela_porownawcza_r2_c2','','images/tabela_porownawcza_r2_c2_f2.png',1);"><img name="tabela_porownawcza_r2_c2" src="images/tabela_porownawcza_r2_c2.png" width="151" height="42" border="0" id="tabela_porownawcza_r2_c2" alt="" /></a></td>
   <td rowspan="2"><img name="tabela_porownawcza_r2_c3" src="images/tabela_porownawcza_r2_c3.png" width="53" height="62" border="0" id="tabela_porownawcza_r2_c3" alt="" /></td>
   <td><a href="sciagajszybko.php?plik=<?php echo $_GET['plik'];?>" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('tabela_porownawcza_r2_c4','','images/tabela_porownawcza_r2_c4_f2.png',1);"><img name="tabela_porownawcza_r2_c4" src="images/tabela_porownawcza_r2_c4.png" width="150" height="42" border="0" id="tabela_porownawcza_r2_c4" alt="" /></a></td>
   <td rowspan="2"><img name="tabela_porownawcza_r2_c5" src="images/tabela_porownawcza_r2_c5.png" width="163" height="62" border="0" id="tabela_porownawcza_r2_c5" alt="" /></td>
  </tr>
  <tr>
   <td><img name="tabela_porownawcza_r3_c2" src="images/tabela_porownawcza_r3_c2.png" width="151" height="20" border="0" id="tabela_porownawcza_r3_c2" alt="" /></td>
   <td><img name="tabela_porownawcza_r3_c4" src="images/tabela_porownawcza_r3_c4.png" width="150" height="20" border="0" id="tabela_porownawcza_r3_c4" alt="" /></td>
  </tr>
</table>


    </div>
  <script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-329354-6");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>

