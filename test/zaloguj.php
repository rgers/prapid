<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0
Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
transitional.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html;
charset=utf-8" />
<title>Zaloguj</title>
<link href="css/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include 'menu.php';?>
    
<div align="center">
<form action="login.php"
method="POST">
<table>
<tr>
<td>E-Mail:</td><td><input name="login" type="text" /></td></tr>
<tr>
<td>Hasło:</td><td><input name="password" type="password" /></td></tr>
</table>
<input type="submit" value="Zaloguj" />
</form>
</div>
    
</body>
</html>
