<?php
 include 'database.inc.php';
 $query = "SELECT * FROM users WHERE login='".$_POST["login"]."'";
 $result = mysql_query($query);
 $nr = mysql_numrows($result);
 if($nr>0)
 {
    echo ":-)";
 }else{
     echo "Użytkownik ".$_POST["login"]." nie istnieje.";
 }
?>
