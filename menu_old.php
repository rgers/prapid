<center>
<?php
if ($zalogowany)
{
echo '<a href="logout.php">Wyloguj</a>';
echo ' | <a href="user.php">Moje Konto</a>';
}else{
echo '<a href="zaloguj.php">Zaloguj się</a>';
echo ' | <a href="adduser.php">Rejestracja</a>';
}
?>
 | <a href="up.php">Wyślij Pliki</a>
 | <a href="konkurs.php">Konkurs</a>
 | <a href="rules.php">Regulamin</a>
 | <a href="contact.php">Kontakt</a>
</center>
