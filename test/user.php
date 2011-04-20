<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-type" content="text/html;
charset=utf-8" />
<title>Profil Użytkownika</title>
<link href="css/default.css" rel="stylesheet" type="text/css" />
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
</head>
<body>
<?php

include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
include 'menu.php';
?>
    <div id="content">
<?php
if ($zalogowany) {

echo "Witaj ".$ulogin."!<br /><br />";
if (isset($_GET['delmsg']))
    {
if ($_GET['delmsg']=="ok")
{
echo "Files deleted.<br /><br />";
}elseif ($_GET['delmsg']=="fail")
{
echo "Files NOT deleted. Error encountered.<br /><br />";
}
    }
echo "Dostępny transfer premium: ".$bw."MB  <a href='sciagajszybko.php'>Dokup transfer premium.</a><br />Zdobyte punkty premium: ".$ppoints."<br /><a href=up.php>Wyślij nowe pliki</a><br />";
echo "Twoje pliki:<br />";
$query = "SELECT * FROM files WHERE uid='".$uid."'";
$result=mysql_query($query);
$num=mysql_numrows($result);
if ($num>0) {
$numpages = $num/$filesonpage;
$numpages = intval($numpages);
if ($num % $filesonpage > 0) {
$numpages++;
}
if (isset($_GET['page']))
    {$page = $_GET['page'];}else{$page=0;}
$currentpage = ($page/$filesonpage)+1;
if ($num>$page+$filesonpage) {

$num=$page+$filesonpage;
}
    

echo "<center>Strona ";
for ($a=1;$a<$numpages+1;$a++)
{
if ($a!=$currentpage) {
echo "<a href='user.php?page=".(($a-1)*$filesonpage)."'>".$a."</a> ";
}else{
echo $a." ";
}
} //end for
echo "</center><br />";
echo "<form name='f1' action='del.php?type=checked' method='post'><table cellspacing='0'>";
for ($a=$page;$a<$num;$a++)
{
$fsize = mysql_result($result, $a, 'size');
if ($fsize>1048576)
{
$fsize=round(($fsize/1048576),2)."MB";
}elseif($fsize>1024)
{
$fsize=round(($fsize/1024),2)."kB";
}else{
$fsize=$fsize."B";
}
echo "<tr><td><input type='checkbox' name='checkfiles[]' value='".mysql_result($result,$a,'id')."_".mysql_result($result,$a,'securityhash')."'>".($a+1).".</td><td><a href=download.php?plik=".mysql_result($result,$a,'id').">".mysql_result($result,$a,'name')."</a></td><td style='padding-left:5px'>http://".$domain."/download.php?plik=".mysql_result($result,$a,'id')."</td><td style='padding-left:50px'>".$fsize."</td><td><a href=del.php?plik=".mysql_result($result,$a,'id')."&security=".mysql_result($result,$a,'securityhash')."&a=b>USUŃ</a></td></tr>";
}
echo "</table>";
}
?>
    Zaznaczone: <input type='submit' name='formSubmit' value='Usuń' /><input type='submit' value='Linki na forum' onclick="f1.action='linkiforum.php';return true;" /></form>
<?php
echo "Dostępny transfer premium: ".$bw."MB  <a href='sciagajszybko.php'>Dokup transfer premium.</a><br />Zdobyte punkty premium: ".$ppoints."<br /><a href=up.php>Wyślij nowe pliki</a>";
}
mysql_close($mysql_db_link);?>
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
