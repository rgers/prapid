<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-type" content="text/html;
charset=utf-8" />
<title>Konkurs</title>
<!--<link href="css/default.css" rel="stylesheet" type="text/css" />-->
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



include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
include 'menu.php';
echo '
    <center><h1>Ściągaj, wysyłaj i wygrywaj nagrody!</h1><br />
    Zestaw nagród na Kwiecień 2010:<br />
    <img src="images/nagroda1.png"><img src="images/nagroda2.png"><img src="images/nagroda3.png"><br />
    <div style="font-size:18px; with:800px; margin-left:auto; margin-right:auto; text-align:left">Co miesiąc najaktywniejsi użytkownicy dostają od nas nagrody. W tym miesiącu do wygrania:<ul><li>Odtwarzacz MP3 <b style="color:red">Apple iPod Nano 8GB</b> (miejsce 1.),</li>
    <li><b style="color:red">Pendrive Kingston Datatraveler DT100 8GB</b> (miejsce 2.)</li><li>oraz pakiety transferu premium <b style="color:red">200GB</b> (miejsce 3.),</li><li><b style="color:red">100GB</b> (miejsce 4.),</li><li><b style="color:red">50GB</b> (miejsce 5.),</li><li><b style="color:red">10GB</b> (miejsce 6.)</li><li>i <b style="color:red">5GB</b> (miejsce 7.)</li></ul> Nagrody są przyznawane o północy ostatniego dnia każdego miesiąca.<br /><br />
    Co zrobić, aby wygrać?<br />
    Wystarczy się zarejestrować (rejestracja jest darmowa) i aktywnie korzystać z serwisu polskirapid.pl. Za każdy wysłany megabajt dostajesz 1Pp (punkt premium). Jeśli ktoś ściąga za darmo plik wysłany przez Ciebie to za każdy ściągnięty megabajt również
    dostajesz 1Pp. Jeśli ktoś ściąga Twoje dane używając płatnego transferu premium to za każdy ściągnięty megabajt dostajesz 2Pp. Jeśli sam ściągasz korzystając z transferu
    premium to również dostajesz 2Pp za każdy megabajt. To takie proste. Nagrody są rozdawane wg klasyfikacji dokładnie o północy
    ostatniego dnia każdego miesiąca. Wtedy też punkty zostają wyzerowana, aby w każdym miesiącu każdy miał równe szanse. <a href="rules.php#konkurs">Regulamin konkursu</a>.
</div>
    ';
$query = "SELECT uid,nick, premiumpoints FROM users ORDER BY premiumpoints DESC";
$result = mysql_query($query);
$num=mysql_numrows($result);
if ($num>0) {
    echo "Wyniki (aktualizowane na bieżąco, pierwsze 20 miejsc):<br />";
echo "<table id='testtab'>";
echo "<tr><td>Miejsce</td><td>Nick</td><td>Liczba Punktów</td><td style='text-align:right'>Ilość własnych plików</td></tr>";
if ($num>20)
{$num=20;}
for($a=0; $a<$num; $a++)
{
$query = "SELECT * FROM files WHERE uid='".mysql_result($result,$a,'uid')."'";
$numres = mysql_query($query);
    echo "<tr><td>Miejsce ".($a+1).".</td><td>".mysql_result($result,$a,'nick')."</td><td>".mysql_result($result,$a,'premiumpoints')."</td><td style='text-align:right'>".mysql_numrows($numres)."</td></tr>";
} //close for
echo "</table>";
} //close if
mysql_close($mysql_db_link);
?>
</center>
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
