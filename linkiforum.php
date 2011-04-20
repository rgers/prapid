<?php
echo '
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
';


include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
include 'menu.php';

$checkfiles = $_POST['checkfiles'];
echo "Linki do wybranych plików:<br /><center>";
foreach($checkfiles  as  $value)  {
$checkarr = explode("_",$value);
$fileid = $checkarr[0];
$filename = $checkarr[1];
echo "http://".$domain."/".$fileid."/".$filename."<br />";
} //foreach close
echo '
</center></body></html>
';
?>