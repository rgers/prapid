<?php
include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-type" content="text/html;
charset=utf-8" />
<title>Ściągnij plik</title>
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
include 'menu.php';
echo '<div align="center">';
echo '<img src="img.php?plik='.$_GET['plik'].'">';
echo '<br />Link na forum: [URL="http://'.$domain.'/showimg.php?plik='.$_GET['plik'].'"][IMG]http://'.$domain.'/img.php?plik='.$_GET['plik'].'&thumb=yes[/IMG][/URL]';
?>
 <script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-329354-6");
pageTracker._trackPageview();
} catch(err) {}</script>
