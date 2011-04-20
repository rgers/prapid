<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0
Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
transitional.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html;
charset=utf-8" />
<title>Nowe Konto</title>
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
$msg=$_GET['msg'];
if(isset($msg))
{
if($msg=="existsemail")
{
echo "Ten adres e-mail już jest zarejestrowany. Wybierz inny.<br />";
}
if($msg=="existsnick")
{
echo "Ten nick już jest zarejestrowany. Wybierz inny.<br />";
}
}
?>

<div align="center">
<form action="newuser.php"
method="POST">
<table>
<tr>
<td>E-Mail: </td><td><input name="login" type="text" /></td>
</tr><tr>
<td>Nick: </td><td><input name="nick" type="text" /></td>
</tr><tr>
<td>Password: </td><td><input name="password" type="password" /></td>
</tr>
</table>
<input type="submit" value="Załóż Konto" />
</form>
</div>
