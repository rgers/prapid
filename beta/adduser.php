<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0
Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
transitional.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html;
charset=utf-8" />
<title>Nowe Konto</title>
<link href="css/default.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php
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

<form id="regform" action="newuser.php"
method="POST">
<table>
<tr>
<td>E-Mail: </td><td><input name="login" type="text" OnChange='emailvrfy()'/></td><td id="bumbum"></td>
</tr><tr>
<td>Nick: </td><td><input name="nick" type="text" /></td>
</tr><tr>
<td>Hasło: </td><td><input name="password" type="password" /></td>
</tr>
</table>
<input type="submit" value="Załóż Konto" />
</form>
</body>
</html>

