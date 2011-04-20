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
 <?php
    if ($_GET["q"]=="1")
    {
        echo "Hasło nieprawidłowe. Spróbuj jeszcze raz.<br />";
    }
      if ($_GET["q"]=="2")
    {
        echo "Użytkownik nie istnieje. Spróbuj jeszcze raz.<br />";
    }
    ?>
<form id="loginform" action="login.php"
method="POST">
<table>
<tr>
<td>E-Mail:</td><td><input name="login" type="text" OnChange='emailchg()' onkeypress="return event.keyCode!=13"/></td><td id="tere"></td></tr>
<tr>
<td>Hasło:</td><td><input name="password" type="password" onkeypress="return event.keyCode!=13"/></td></tr>
</table>
<input type="button" value="Zaloguj" OnClick="loginchk()"/>
</form>
  
</body>
</html>
